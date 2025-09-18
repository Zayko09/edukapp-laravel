<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carnet Digital - Eduk APP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #e6ffe6; 
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #5cb85c;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .back-link:hover {
            background-color: #4cae4c;
        }
        .carnet-container {
            background-color: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            text-align: center;
            width: 350px;
        }
        .carnet-header .logo img {
            width: 120px;
            margin-bottom: 20px;
        }
        .carnet-body h2 {
            margin-top: 0;
            font-size: 1.8em;
            color: #333;
        }
        .carnet-body p {
            font-size: 1.1em;
            color: #666;
            margin: 10px 0;
        }
        .qr-code {
            margin-top: 25px;
        }
        .qr-code img {
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body>

    <a href="{{ route('dashboard.index') }}" class="back-link">Volver al Panel</a>

    <div class="carnet-container">
        <div class="carnet-header">
            <div class="logo">
                <img src="{{ asset('images/logoEdukapp.png') }}" alt="Edukapp Logo">
            </div>
        </div>
        <div class="carnet-body">
            <h2>{{ $usuario->nombre }} {{ $usuario->apellido }}</h2>
            <p>{{ $usuario->email }}</p>
            <p><strong>Documento:</strong> {{ $usuario->numero_documento }}</p>
            <div class="qr-code">
                <img src="{{ $qrCodeUrl }}" alt="Código QR">
            </div>
        </div>
    </div>

</body>
</html>
