<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <style>
        @page {
            margin: 18mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1e293b;
            text-align: center;
        }

        .certificate {
            border: 5px double #183b65;
            padding: 35px 25px;
            min-height: 390px;
        }

        .organization {
            color: #183b65;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        h1 {
            color: #183b65;
            font-size: 34px;
            margin: 25px 0 12px;
        }

        .subtitle {
            font-size: 18px;
        }

        .participant {
            font-size: 28px;
            font-weight: bold;
            margin: 25px 0;
        }

        .course {
            color: #183b65;
            font-size: 23px;
            font-weight: bold;
            margin: 20px 0;
        }

        .details {
            font-size: 12px;
            color: #475569;
            margin-top: 30px;
        }

        .code {
            margin-top: 25px;
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <div class="organization">
            Capacitaciones y Certificados Digitales
        </div>

        <h1>Certificado de Participación</h1>

        <p class="subtitle">
            Se certifica que
        </p>

        <div class="participant">
            {{ $registration->full_name }}
        </div>

        <p>
            ha participado en la capacitación
        </p>

        <div class="course">
            {{ $registration->course->title }}
        </div>

        <p>
            realizada el
            {{ $registration->course->start_date->format('d/m/Y') }}

            @if ($registration->course->end_date)
                al
                {{ $registration->course->end_date->format('d/m/Y') }}
            @endif
        </p>

        <div class="details">
            Emisión:
            {{ $registration->certificate_issued_at->format('d/m/Y') }}
        </div>

        <div class="code">
            Código de certificado:
            {{ $registration->certificate_code }}
        </div>
    </div>
</body>
</html>