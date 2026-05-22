<nav style="background-color: #2e3d36; padding: 15px; border-radius: 8px; margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between; border-bottom: 3px solid #bbc66f; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <div style="flex: 1;"></div>
    <div style="display: flex; gap: 30px; justify-content: center; flex: 2;">
        <a href="{{ route('login') }}" style="color: #ffffff; font-weight: bold; text-decoration: none; opacity: 0.7;">LOGIN</a>
        <a href="{{ route('productos.index') }}" style="color: #ffffff; font-weight: bold; text-decoration: none; opacity: 0.7;">TIENDA</a>
        <a href="{{ route('productos.articulos') }}" style="color: #ffffff; font-weight: bold; text-decoration: none; opacity: 0.7;">ARTÍCULOS</a>
        <a href="#" style="color: #bfc96f; font-weight: bold; text-decoration: none; border-bottom: 2px solid #afb867; padding-bottom: 4px;">CARRITO</a>
    </div>
    <div style="flex: 1;"></div>
</nav>

<center><h1>Factura de Compra:</h1></center>

<div style="margin-bottom: 20px; text-align: center;">
    <a href="{{ route('productos.articulos') }}" style="background: #6f2121; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Volver/Artículos</a>
</div>

<style>
    .btn-editar { background: #ffcc00; color: black; border: none; padding: 5px 10px; cursor: pointer; font-weight: bold; }
    .btn-eliminar { background: #fe172e; color: white; border: none; padding: 5px 10px; cursor: pointer; font-weight: bold; }
</style>

<table border="1" style="width: 80%; margin: auto; border-collapse: collapse; text-align: center;">
    <tr style="background: #006f3b; color: white;">
        <th style="padding: 10px;">Articulos:</th>
        <th style="padding: 10px;">Precio:</th>
        <th style="padding: 10px;">Acciones:</th>
    </tr>
    
    @foreach($carrito as $index => $item)
    <tr>
        <td style="padding: 10px;">{{ $item['nombre'] }}</td>
        <td style="padding: 10px;">${{ number_format($item['precio'], 2) }}</td>
        <td style="padding: 10px;">
            <button class="btn-editar">Editar</button>
            
            <form action="{{ route('carrito.eliminar', $index) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn-eliminar">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
    
    <tr style="background: #f8f9fa;">
        <td colspan="1" style="text-align: right; padding: 10px;"><strong>TOTAL:</strong></td>
        <td colspan="2" style="padding: 10px;"><strong>${{ number_format($total, 2) }}</strong></td>
    </tr>
</table>