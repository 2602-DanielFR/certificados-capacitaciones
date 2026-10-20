@extends('layouts.public')

@section('title', 'Estado de mi certificado')

@section('content')

<div class="card" style="margin: 35px 0;">
    <h1>Estado de tu inscripción</h1>

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
        <strong>Estado:</strong>

        @if ($registration->status === 'attended')
            Asistencia confirmada
        @elseif ($registration->status === 'absent')
            No se registró asistencia
        @else
            Inscripción registrada; asistencia pendiente
        @endif
    </p>

    @if ($registration->status === 'attended')
        <div class="alert success">
            Tu participación ha sido confirmada y tu certificado
            está disponible.
        </div>

        <p>
            <strong>Código del certificado:</strong>
            {{ $registration->certificate_code }}
        </p>

        <a
            class="btn"
            href="{{ route(
                'certificates.download',
                $registration->lookup_token
            ) }}"
        >
            Descargar certificado PDF
        </a>

    @elseif ($registration->status === 'absent')
        <div class="alert error">
            No se puede emitir el certificado porque la asistencia
            está registrada como no asistida.
        </div>

    @else
        <div class="alert">
            Tu inscripción está registrada. Cuando el administrador
            confirme tu asistencia, podrás descargar tu certificado
            desde este mismo enlace.
        </div>
    @endif

    <p class="muted" style="margin-top: 25px;">
        Guarda este enlace para volver a consultar tu certificado.
    </p>

    <a href="{{ route('home') }}">Volver a las capacitaciones</a>
</div>

@endsection