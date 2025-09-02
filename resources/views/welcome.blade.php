<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear una Cuenta - Eduk APP</title>
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
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
            text-align: left;
            padding-left: 20px;
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
            margin-top: 20px;
        }
        button:hover {
            background-color: #4cae4c;
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
            <h1>CREA UNA CUENTA</h1>
            <form id="registrationForm">
                <div class="input-group">
                    <input type="text" id="username" placeholder="NOMBRE DE USUARIO">
                    <div class="error-message" id="usernameError"></div>
                </div>
                <div class="input-group">
                    <input type="email" id="email" placeholder="CORREO ELECTRONICO">
                    <div class="error-message" id="emailError"></div>
                </div>
                <div class="input-group">
                    <select id="documentType">
                        <option value="">TIPO DE DOCUMENTO</option>
                        <option value="CC">Cédula de Ciudadanía</option>
                        <option value="TI">Tarjeta de Identidad</option>
                        <option value="CE">Cédula de Extranjería</option>
                    </select>
                    <div class="error-message" id="documentTypeError"></div>
                </div>
                <div class="input-group">
                    <input type="password" id="password" placeholder="CONTRASEÑA">
                    <div class="error-message" id="passwordError"></div>
                </div>
                <div class="input-group">
                    <input type="password" id="confirmPassword" placeholder="REPETIR LA CONTRASEÑA">
                    <div class="error-message" id="confirmPasswordError"></div>
                </div>
                <button type="submit">CREAR</button>
            </form>
        </div>
    </div>
    <div class="right-panel">
        <img src="{{ asset('images/LOGO_SENA.png') }}" alt="SENA Logo" class="sena-logo">
        <img src="{{ asset('images/re.png') }}" alt="Illustration" class="illustration">
    </div>

    <script src="validation.js"></script>
</body>
</html>