<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Capacitaciones y Certificados')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f4f7fb;
            color: #1f2937;
            font-family: Arial, Helvetica, sans-serif;
        }

        header {
            background: #102b55;
            color: white;
            padding: 20px 0;
        }

        .container {
            width: min(1100px, 92%);
            margin: auto;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .brand {
            color: white;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
        }

        .nav a:last-child {
            color: white;
            text-decoration: none;
        }

        .hero {
            margin: 30px 0;
            padding: 42px 32px;
            background: linear-gradient(120deg, #102b55, #1765a8);
            border-radius: 18px;
            color: white;
        }

        .hero h1 {
            margin-top: 0;
            font-size: clamp(28px, 5vw, 42px);
        }

        .hero p {
            max-width: 650px;
            line-height: 1.7;
        }

        .section-title {
            margin-top: 36px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(
                auto-fit,
                minmax(250px, 1fr)
            );
            gap: 22px;
            margin: 24px 0 45px;
        }

        .card {
            padding: 24px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 5px 20px #102b5508;
        }

        .card h3 {
            color: #102b55;
        }

        .muted {
            color: #64748b;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            border: 0;
            border-radius: 8px;
            padding: 12px 18px;
            background: #1765a8;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 15px;
        }

        .btn:hover {
            background: #102b55;
        }

        .form-group {
            margin-bottom: 17px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
        }

        .alert {
            margin: 20px 0;
            padding: 15px;
            border-radius: 8px;
            line-height: 1.5;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        footer {
            padding: 26px 0;
            background: #102b55;
            color: #e2e8f0;
            text-align: center;
        }

        @media (max-width: 600px) {
            .hero {
                padding: 28px 20px;
            }

            .nav {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container nav">
            <a class="brand" href="{{ route('home') }}">
                CAPACITA+
            </a>

            <a href="{{ route('home') }}">
                Ver capacitaciones
            </a>
        </div>
    </header>

    <main class="container">
        @if (session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                <strong>Revisa lo siguiente:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="container">
            Capacitaciones y Certificados Digitales
        </div>
    </footer>
</body>
</html>