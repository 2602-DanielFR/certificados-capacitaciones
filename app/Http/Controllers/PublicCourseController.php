<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Registration;
use Barryvdh\DomPDF\Facade\Pdf;

class PublicCourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::query()
            ->where('is_published', true)
            ->orderBy('start_date')
            ->get();

        return view('courses.index', compact('courses'));
    }

    public function show(Course $course): View
    {
        abort_unless($course->is_published, 404);

        return view('courses.show', compact('course'));
    }

    public function store(
        Request $request,
        Course $course
    ): RedirectResponse {
        abort_unless($course->is_published, 404);

        if (
            $course->registration_deadline &&
            today()->gt($course->registration_deadline)
        ) {
            return back()->withInput()->withErrors([
                'registration' =>
                    'El plazo de inscripción para esta capacitación ha terminado.',
            ]);
        }

        if ($course->start_date->lt(today())) {
            return back()->withInput()->withErrors([
                'registration' =>
                    'Esta capacitación ya ha comenzado y no admite nuevas inscripciones.',
            ]);
        }

        if (
            $course->capacity !== null &&
            $course->registrations()->count() >= $course->capacity
        ) {
            return back()->withInput()->withErrors([
                'registration' =>
                    'Se han completado los cupos disponibles.',
            ]);
        }

        $data = $request->validate([
            'full_name' => [
                'required',
                'string',
                'max:255',
            ],
            'dni' => [
                'required',
                'string',
                'max:20',
                Rule::unique('registrations', 'dni')
                    ->where(
                        fn($query) => $query->where(
                            'course_id',
                            $course->id
                        )
                    ),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],
        ], [
            'full_name.required' =>
                'Ingresa tus nombres y apellidos.',
            'dni.required' =>
                'Ingresa tu número de documento.',
            'dni.unique' =>
                'Ya existe una inscripción con ese documento para esta capacitación.',
            'email.required' =>
                'Ingresa tu correo electrónico.',
            'email.email' =>
                'Ingresa un correo electrónico válido.',
        ]);

        $registration = $course->registrations()->create($data);

        return redirect()->route(
            'certificates.status',
            $registration->lookup_token
        );
    }
    public function certificateStatus(string $lookupToken): \Illuminate\View\View
    {
        $registration = Registration::with('course')
            ->where('lookup_token', $lookupToken)
            ->firstOrFail();

        return view('certificates.status', compact('registration'));
    }

    public function downloadCertificate(string $lookupToken)
    {
        $registration = Registration::with('course')
            ->where('lookup_token', $lookupToken)
            ->firstOrFail();

        // Solo los participantes con asistencia confirmada
        // pueden descargar su certificado.
        if (
            $registration->status !== 'attended' ||
            blank($registration->certificate_code)
        ) {
            return redirect()
                ->route('certificates.status', $lookupToken)
                ->withErrors([
                    'certificate' =>
                        'Tu certificado todavía no está disponible. '
                        . 'El administrador debe confirmar tu asistencia.',
                ]);
        }

        $pdf = Pdf::loadView(
            'certificates.pdf',
            compact('registration')
        )->setPaper('a4', 'landscape');

        return $pdf->download(
            'certificado-' . $registration->certificate_code . '.pdf'
        );
    }
    public function verificationForm(): \Illuminate\View\View
    {
        return view('certificates.verify');
    }

    public function verifyCertificate(
        \Illuminate\Http\Request $request
    ): \Illuminate\View\View {
        $validated = $request->validate([
            'certificate_code' => [
                'required',
                'string',
                'max:100',
            ],
        ]);

        $code = strtoupper(trim($validated['certificate_code']));

        $registration = \App\Models\Registration::with('course')
            ->where('certificate_code', $code)
            ->where('status', 'attended')
            ->whereNotNull('certificate_issued_at')
            ->first();

        return view('certificates.verify-result', [
            'registration' => $registration,
            'searchedCode' => $code,
        ]);
    }
}