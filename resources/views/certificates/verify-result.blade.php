@extends('layouts.public')

@section('title', 'Resultado de verificación')

@section('content')
<div class="card" style="margin: 35px 0;">
    <h1>Resultado de verificación</h1>

    <p>
        <strong>Código consultado:</strong>
        {{ $searchedCode }}
    </p>

    @if ($registration)
        <div class="alert success">
            CERTIFICADO VÁLIDO
        </div>

        <p>
            <strong>Participante:</strong>
            {{ $registration->full_name }}
        </p>

        <p>
            <strong>Capacitación:</strong>
            {{ $registration->course->title }}
        </p>

        <p>
            <strong>Fecha de inicio:</strong>
            {{ $registration->course->start_date->format('d/m/Y') }}
        </p>

        <p>
            <strong>Fecha de emisión:</strong>
            {{ $registration->certificate_issued_at->format('d/m/Y') }}
        </p>

        <p>
            El sistema reconoce este certificado como válido
            y registra la asistencia confirmada.
        </p>
    @else
        <div class="alert error">
            CERTIFICADO NO VÁLIDO
        </div>

        <p>
            No se encontró un certificado vigente con ese código.
            Comprueba que lo hayas escrito correctamente.
        </p>
    @endif

    <a
        href="{{ route('certificates.verify.form') }}"
        class="btn"
    >
        Verificar otro certificado
    </a>
</div>
@endsection