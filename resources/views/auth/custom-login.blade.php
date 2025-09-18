<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Eduk APP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            height: 100vh;
            background-color: #ffffff; 
        }
        .left-panel {
            flex: 1;
            background-color: #e6ffe6; 
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }
        .logo {
            margin-bottom: 30px;
        }
        .logo img {
            width: 150px; 
            height: auto;
        }
        .form-container {
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 1.8em;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group input, .input-group select {
            width: calc(100% - 40px);
            padding: 15px 20px;
            border: 1px solid #ffffff;
            border-radius: 8px;
            font-size: 1em;
            box-sizing: border-box;
            outline: none;
        }
        .input-group input:focus, .input-group select:focus {
            border-color: #5cb85c;
        }
        button {
            background-color: #5cb85c;
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .secondary-link {
            display: block;
            margin-top: 20px;
            color: #5cb85c;
            text-decoration: none;
            font-size: 1em;
        }
        .secondary-link:hover {
            text-decoration: underline;
        }

        .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }
        .sena-logo {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 120px; 
        }
        .illustration {
            width: 80%; 
            max-width: 600px;
            height: auto;
        }

        .eduk-app-logo {
            width: 250px; 
            height: 250px; 
            border-radius: 15px; 
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8em;
            font-weight: bold;
            text-align: center;
            line-height: 1.2;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
            position: relative;
        }

    </style>
</head>
<body>
    <div class="left-panel">
        <div class="eduk-app-logo">
            <img src="{{ asset('images/logoEdukapp.png') }}"  style="width: 100%; height: 100%; object-fit: contain;">
        </div>
        <div class="form-container">
            <h1>INICIAR SESIÓN</h1>
            
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <input type="email" name="email" placeholder="CORREO ELECTRONICO" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="CONTRASEÑA" required autocomplete="current-password">
                </div>
                <button type="submit">INICIAR SESIÓN</button>
            </form>
            <a href="{{ url('/registro') }}" class="secondary-link">¿No tienes una cuenta? Regístrate</a>
        </div>
    </div>
    <div class="right-panel">
        <img src="{{ asset('images/LOGO_SENA.png') }}" alt="SENA Logo" class="sena-logo">
        <img src="{{ asset('images/re.png') }}" alt="Illustration" class="illustration">
    </div>
</body>
</html>
