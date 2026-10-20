@extends('layouts.public')

@section('title', $course->title)

@section('content')

<section class="hero">
    <h1>{{ $course->title }}</h1>

    <p>
        {{ $course->description ?? 'Conoce los detalles de esta capacitación.' }}
    </p>
</section>

<div class="grid">
    <section class="card">
        <h2>Información de la capacitación</h2>

        <p>
            <strong>Inicio:</strong>
            {{ $course->start_date->format('d/m/Y') }}
        </p>

        @if ($course->end_date)
            <p>
                <strong>Finalización:</strong>
                {{ $course->end_date->format('d/m/Y') }}
            </p>
        @endif

        <p>
            <strong>Modalidad:</strong>
            {{ ucfirst($course->modality) }}
        </p>

        @if ($course->instructor)
            <p>
                <strong>Instructor:</strong>
                {{ $course->instructor }}
            </p>
        @endif

        @if ($course->location)
            <p>
                <strong>Lugar:</strong>
                {{ $course->location }}
            </p>
        @endif

        @if ($course->capacity !== null)
            <p>
                <strong>Cupos:</strong>
                {{ max(
                    0,
                    $course->capacity - $course->registrations()->count()
                ) }}
                disponibles
            </p>
        @endif
    </section>

    <section class="card">
        <h2>Formulario de inscripción</h2>

        <p class="muted">
            Completa tus datos. Verifica que tu documento y
            correo electrónico sean correctos.
        </p>

        <form
            method="POST"
            action="{{ route('courses.register', $course) }}"
        >
            @csrf

            <div class="form-group">
                <label for="full_name">
                    Nombres y apellidos *
                </label>

                <input
                    id="full_name"
                    name="full_name"
                    value="{{ old('full_name') }}"
                    maxlength="255"
                    autocomplete="name"
                    required
                >
            </div>

            <div class="form-group">
                <label for="dni">
                    DNI o documento de identidad *
                </label>

                <input
                    id="dni"
                    name="dni"
                    value="{{ old('dni') }}"
                    maxlength="20"
                    autocomplete="off"
                    required
                >
            </div>

            <div class="form-group">
                <label for="email">
                    Correo electrónico *
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    maxlength="255"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="phone">
                    Teléfono
                </label>

                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    value="{{ old('phone') }}"
                    maxlength="30"
                    autocomplete="tel"
                >
            </div>

            <button class="btn" type="submit">
                Confirmar inscripción
            </button>
        </form>
    </section>
</div>

@endsection