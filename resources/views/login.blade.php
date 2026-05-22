<nav style="background-color: #2e3d36; padding: 15px; border-radius: 8px; margin-bottom: 25px; display: flex; gap: 30px; justify-content: center; border-bottom: 3px solid #afb867; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <a href="{{ route('login') }}" style="color: #afb867; font-weight: bold; text-decoration: none; border-bottom: 2px solid #afb867; padding-bottom: 4px;">LOGIN</a>
    <a href="{{ route('productos.index') }}" style="color: #ffffff; font-weight: bold; text-decoration: none; opacity: 0.7;">TIENDA</a>
    <a href="#" style="color: #ffffff; font-weight: bold; text-decoration: none; opacity: 0.7;">ARTÍCULO</a>
    <a href="#" style="color: #ffffff; font-weight: bold; text-decoration: none; opacity: 0.7;">CARRITO</a>
</nav>

<link rel="stylesheet" href="{{ asset('css/crud.css') }}">

<style>
    body {
        background-color: #012516; 
        font-family: sans-serif;
    }

    /* Contenedor tipo Tarjeta */
    .login-card {
        background-color: #d3c7c7;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        margin-top: 40px;
        max-width: 400px;
        text-align: left;
        box-sizing: border-box;
        display: inline-block;
        width: 100%;
    }

    /* Estilos para las etiquetas */
    .login-label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #000000; 
        font-size: 14px;
    }

    /* Estilos modernos para los inputs */
    .login-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-size: 15px;
        background-color: #f8fafc;
        color: #334155;
        box-sizing: border-box;
        transition: border-color 0.2s, background-color 0.2s;
        margin-bottom: 5px;
    }

    .login-input:focus {
        outline: none;
        border-color: #2e3d36;
        background-color: #ffffff;
    }

    /* Botón personalizado a juego con tu barra de navegación */
    .btn-login-submit {
        width: 100%;
        background-color: #3e7a5e;
        color: white;
        font-weight: bold;
        font-size: 16px;
        border: none;
        padding: 12px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.2s ease, transform 0.1s ease;
        margin-top: 15px;
    }

    .btn-login-submit:hover {
        background-color: #1f2a25;
    }

    .btn-login-submit:active {
        transform: scale(0.98);
    }
</style>

<center>
    <div class="login-card">
        <center><h1 style="margin-top: 0; margin-bottom: 25px; color: #1e293b; font-size: 26px;">Iniciar Sesión</h1></center>

        @if($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-weight: bold;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.autenticar') }}" method="POST" style="display: block; width: 100%;">
            @csrf

            <div style="margin-bottom: 20px;">
                <label class="login-label">Correo Electrónico:</label>
                <input type="email" name="email" class="login-input" placeholder="ejemplo@correo.com" required value="{{ old('email') }}">
            </div>

            <div style="margin-bottom: 20px;">
                <label class="login-label">Contraseña:</label>
                <input type="password" name="password" class="login-input" placeholder="********" required>
            </div>

            <button type="submit" class="btn-login-submit">Ingresar al Sistema</button>
        </form>
    </div>
</center>