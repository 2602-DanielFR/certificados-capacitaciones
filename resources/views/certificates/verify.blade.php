@extends('layouts.public')

@section('title', 'Verificar certificado')

@section('content')
<div class="card" style="margin: 35px 0;">
    <h1>Verificar certificado digital</h1>

    <p class="muted">
        Introduce el código que aparece en el certificado
        para comprobar su autenticidad.
    </p>

    <form
        method="POST"
        action="{{ route('certificates.verify') }}"
    >
        @csrf

        <div class="form-group">
            <label for="certificate_code">
                Código del certificado
            </label>

            <input
                type="text"
                id="certificate_code"
                name="certificate_code"
                value="{{ old('certificate_code') }}"
                maxlength="100"
                required
                autocomplete="off"
                placeholder="Ejemplo: CERT-ABC123XYZ789"
            >
        </div>

        <button class="btn" type="submit">
            Verificar certificado
        </button>
    </form>
</div>
@endsection