@extends('layouts.public')

@section('title', 'Capacitaciones disponibles')

@section('content')

<section class="hero">
    <h1>Aprende, participa y obtén tu certificado</h1>

    <p>
        Descubre nuestras capacitaciones, inscríbete en la que
        te interese y accede a tu certificado digital una vez
        que tu participación haya sido validada.
    </p>

    <a class="btn" href="#capacitaciones">
        Explorar capacitaciones
    </a>
</section>

<section id="capacitaciones">
    <h2 class="section-title">
        Próximas capacitaciones
    </h2>

    <p class="muted">
        Consulta la información de cada actividad antes de inscribirte.
    </p>

    <div class="grid">
        @forelse ($courses as $course)
            <article class="card">
                <h3>{{ $course->title }}</h3>

                <p class="muted">
                    {{ \Illuminate\Support\Str::limit(
                        $course->description ?? 'Capacitación disponible.',
                        150
                    ) }}
                </p>

                <p>
                    <strong>Fecha:</strong>
                    {{ $course->start_date->format('d/m/Y') }}
                </p>

                <p>
                    <strong>Modalidad:</strong>
                    {{ ucfirst($course->modality) }}
                </p>

                @if ($course->location)
                    <p>
                        <strong>Lugar:</strong>
                        {{ $course->location }}
                    </p>
                @endif

                <a
                    class="btn"
                    href="{{ route('courses.show', $course) }}"
                >
                    Ver e inscribirme
                </a>
            </article>
        @empty
            <div class="card">
                <h3>Próximamente tendremos nuevas capacitaciones</h3>

                <p class="muted">
                    En este momento no hay capacitaciones publicadas.
                    Vuelve a visitarnos pronto.
                </p>
            </div>
        @endforelse
    </div>
</section>

@endsection