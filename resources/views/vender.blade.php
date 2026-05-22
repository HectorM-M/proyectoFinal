<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vender Producto:</title>
    <style>
        body {
            background-color: #93b19c; 
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Barra de navegación superior idéntica a tu index */
        nav {
            background-color: #2c3e35; 
            padding: 15px; 
            margin-bottom: 25px; 
            display: flex; 
            gap: 30px; 
            justify-content: center;
        }
        nav a {
            color: #ffffff; 
            font-weight: bold; 
            text-decoration: none; 
            opacity: 0.7;
            font-size: 14px;
            letter-spacing: 1px;
        }
        nav a.active {
            color: #afb867; 
            opacity: 1;
        }

        /* Estructura tipo carta / tarjeta blanca centradita */
        .card-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 75vh;
            padding: 20px;
            box-sizing: border-box;
        }

        .venta-card {
            background-color: #ffffff;
            padding: 35px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 460px;
            text-align: left;
        }

        .venta-card h2 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #2c3e35;
            font-size: 24px;
            border-bottom: 2px solid #bbd4c2;
            padding-bottom: 10px;
        }

        /* Bloque informativo del producto seleccionado */
        .info-producto {
            background-color: #f4f7f5;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 22px;
            border-left: 5px solid #2c3e35;
        }
        .info-producto p {
            margin: 6px 0;
            color: #4a5568;
            font-size: 15px;
        }

        /* Formulario e inputs */
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #2c3e35;
            font-size: 14px;
        }
        .input-cantidad {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            outline: none;
        }
        .input-cantidad:focus {
            border-color: #2c3e35;
            box-shadow: 0 0 0 2px rgba(44, 62, 53, 0.2);
        }

        /* Botones de acción */
        .btn-submit {
            width: 100%;
            background-color: #41785c;
            color: #ffffff;
            font-weight: bold;
            font-size: 15px;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .btn-submit:hover {
            background-color: #17a764;
        }

        .btn-cancelar {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #ff0000;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-cancelar:hover {
            color: #e53e3e;
            text-decoration: underline;
        }

        /* Mensajes de error dentro de la tarjeta */
        .alert-error {
            background-color: #fed7d7;
            color: #c53030;
            padding: 10px 12px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <nav>
        <a href="{{ route('login') }}">LOGIN</a>
        <a href="{{ route('productos.index') }}" class="active">TIENDA</a>
        <a href="#">ARTÍCULOS</a>
        <a href="#">CARRITO</a>
    </nav>

    <div class="card-container">
        <div class="venta-card">
            <h2>Vender Producto</h2>

            @if(session('error'))
                <div class="alert-error">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="info-producto">
                <p><strong>Producto:</strong> {{ $producto->nombre }}</p>
                <p><strong>Precio Unitario:</strong> ${{ number_format($producto->precio, 2) }}</p>
                <p><strong>Stock Disponible:</strong> {{ $producto->stock }} unidades</p>
            </div>

            <form action="{{ route('productos.vender', $producto->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="cantidad">Cantidad a Vender:</label>
                    <input type="number" 
                           id="cantidad" 
                           name="cantidad" 
                           class="input-cantidad" 
                           min="1" 
                           max="{{ $producto->stock }}" 
                           placeholder="Ej: 2" 
                           required 
                           autofocus>
                </div>
                
                <button type="submit" class="btn-submit">Confirmar Venta</button>
                
                <a href="{{ route('productos.index') }}" class="btn-cancelar">Cancelar y Volver</a>
            </form>
        </div>
    </div>

</body>
</html>