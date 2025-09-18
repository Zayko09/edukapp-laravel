<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Estudiantil - Eduk APP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #e6ffe6; 
            color: #333;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }
        .navbar .logo img {
            width: 100px;
        }
        .navbar h1 {
            font-size: 1.5em;
            margin: 0;
        }
        .navbar a {
            color: #5cb85c;
            text-decoration: none;
            font-weight: bold;
        }
        .container {
            padding: 30px;
        }
        .user-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        .user-card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }
        .user-card h3 {
            margin-top: 0;
            font-size: 1.2em;
        }
        .user-card p {
            font-size: 0.9em;
            color: #666;
            margin: 5px 0;
        }
        .user-card .action-button {
            display: inline-block;
            margin-top: 15px;
            background-color: #5cb85c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 0.9em;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .user-card .action-button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="{{ asset('images/logoEdukapp.png') }}" alt="Edukapp Logo">
        </div>
        <h1>Panel de Control Estudiantil</h1>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <div class="container">
        <div class="user-grid">
            @forelse ($usuarios as $usuario)
                <div class="user-card">
                    <h3>{{ $usuario->nombre }} {{ $usuario->apellido }}</h3>
                    <p>{{ $usuario->email }}</p>
                    <p>Doc: {{ $usuario->numero_documento }}</p>
                    <a href="{{ route('dashboard.carnet', $usuario) }}" class="action-button">Generar Carnet</a>
                </div>
            @empty
                <p>No hay usuarios registrados para mostrar.</p>
            @endforelse
        </div>
    </div>

</body>
</html>
