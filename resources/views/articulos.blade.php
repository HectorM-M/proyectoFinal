<nav style="background-color: #2e3d36; padding: 15px; border-radius: 8px; margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between; border-bottom: 3px solid #bbc66f; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <div style="flex: 1;"></div>
    <div style="display: flex; gap: 30px; justify-content: center; flex: 2;">
        <a href="{{ route('login') }}" style="color: #ffffff; font-weight: bold; text-decoration: none; opacity: 0.7;">LOGIN</a>
        <a href="{{ route('productos.index') }}" style="color: #ffffff; font-weight: bold; text-decoration: none; opacity: 0.7;">TIENDA</a>
        <a href="{{ route('productos.articulos') }}" style="color: #bfc96f; font-weight: bold; text-decoration: none; border-bottom: 2px solid #afb867; padding-bottom: 4px;">ARTÍCULOS</a>
        <a href="{{ route('carrito.index') }}" style="color: #ffffff; font-weight: bold; text-decoration: none; opacity: 0.7;">CARRITO</a>
    </div>
    <div style="flex: 1;"></div>
</nav>

<style>
    .grid-articulos { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 25px; padding: 20px; }
    
    .card { 
        background: white; 
        border: 1px solid #000000; 
        border-radius: 12px; 
        padding: 0; 
        text-align: center; 
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        overflow: hidden; 
    }

    /* Encabezado de la tarjeta */
    .card-header {
        background-color: #008935; 
        color: white;
        padding: 15px;
    }

    /* Cuerpo de la tarjeta */
    .card-body {
        padding: 20px;
        background-color: #dedede;
    }

    .btn-add { 
        background: #00582f; 
        color: white; 
        border: none; 
        padding: 10px 20px; 
        border-radius: 4px; 
        cursor: pointer; 
        transition: background 0.3s;
        margin-top: 10px;
    }
    .btn-add:hover { background: #1a5e3e; }
</style>

<center><h1>Catálogo de Artículos:</h1></center>

@if(session('success'))
    <center><p style="color: green; font-weight: bold;">{{ session('success') }}</p></center>
@endif

<div class="grid-articulos">
    @foreach ($productos as $producto)
        <div class="card">
            <div class="card-header">
                <h3>{{ $producto->nombre }}</h3>
            </div>
            
            <div class="card-body">
                <p style="color: #000000;">{{ $producto->descripcion }}</p>
                <p><strong>${{ number_format($producto->precio, 2) }}</strong></p>
                
                <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-add">Añadir Al Carrito</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
