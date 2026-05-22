<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto; // Importante para la DB

class ProductoController extends Controller
{
    // 1. Mostrar la Tienda (Lo que era index.php)
    public function index()
    {
        $productos = Producto::all(); 
        return view('index', compact('productos'));
    }

    // 2. Guardar Producto (Lo que era guardar.php)
    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'categoria'   => 'required|string',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto Guardado Exitosamente');
    }

    // 3. editar Producto Método para mostrar el formulario de edición
 public function edit($id)
{
    $producto = \App\Models\Producto::findOrFail($id);
    return view('productos.edit', compact('producto'));
}

    // 4. Actualizar Producto (Lo que era actualizar.php)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'categoria'   => 'required|string',
        ]);

        $producto = Producto::findOrFail($id);

        $producto->update([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio'      => $request->precio,
            'stock'       => $request->stock,
            'categoria'   => $request->categoria,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto Actualizado Correctamente');
    }

    // 5. Eliminar Producto (Lo que era eliminar.php)
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto Eliminado Exitosamente');
    }

    // 6. PROCESO DE VENTAS (Dividido en Mostrar Formulario y Procesar)
    
    // A. Muestra el formulario para ingresar la cantidad (Ruta GET: productos.formVenta)
    public function formularioVenta($id)
    {
        // Buscamos el producto por su ID para mostrar sus datos en la nueva vista
        $producto = Producto::findOrFail($id);
        
        // Retorna la nueva vista 'vender.blade.php' pasándole el producto
        return view('vender', compact('producto'));
    }

    // B. Procesa la transacción y descuenta el Stock (Ruta POST: productos.vender)
    public function mostrarVenta(Request $request, $id)
    {
        // En Laravel usamos $request->input en lugar de $_POST
        $cantidad = (int) $request->input('cantidad');
        
        // Buscamos el producto en la DB
        $producto = Producto::findOrFail($id);

        // Validaciones 
        if ($cantidad <= 0) {
            return back()->with('error', 'La Cantidad Debe ser Mayor a Cero.');
        }

        if ($cantidad > $producto->stock) {
            return back()->with('error', 'No hay Suficiente Stock para Realizar la Venta.');
        }

        // Descontar stock y guardar en la Base de Datos
        $producto->stock -= $cantidad;
        $producto->save(); 

        // --- APARTADO AGREGADO: Guardar registro en el Historial de Sesión ---
        // Recuperamos el historial actual o inicializamos un array si está vacío
        $historial = session()->get('historial_ventas', []);

        // Preparamos los datos estructurados de la nueva venta realizada
        $nuevaVenta = [
            'id'        => $producto->id,
            'nombre'    => $producto->nombre,
            'cantidad'  => $cantidad,
            'precio'    => $producto->precio,
            'total'     => $producto->precio * $cantidad,
            'fecha'     => now()->format('d/m/Y H:i:s') // Captura tiempo real de la venta
        ];

        // Añadimos el nuevo registro al principio de la lista para que aparezca primero
        array_unshift($historial, $nuevaVenta);

        // Subimos de nuevo la colección actualizada a las variables de sesión
        session()->put('historial_ventas', $historial);

        return redirect()->route('productos.index')->with('success', 'Venta Procesada. Stock Actualizado.');
    }

    // 7. NUEVO APARTADO DE ARTÍCULOS
  public function mostrarArticulos()
{
    $productos = \App\Models\Producto::all();
    return view('articulos', compact('productos')); 
 }

 public function verCarrito()
{
    $carrito = session()->get('carrito', []);
    $total = array_sum(array_column($carrito, 'precio'));
    return view('carrito', compact('carrito', 'total'));
}

 // 8. APARTADO DE Carrito

public function agregarAlCarrito($id)
{
    $producto = Producto::findOrFail($id);
    $carrito = session()->get('carrito', []);

    // Añadimos el producto al array de sesión
    $carrito[] = [
        'id' => $producto->id,
        'nombre' => $producto->nombre,
        'precio' => $producto->precio
    ];

    session()->put('carrito', $carrito);
    return redirect()->route('carrito.index')->with('success', 'Producto Añadido al Carrito');
}

public function eliminarDelCarrito($index)
{
    $carrito = session()->get('carrito', []);
    if (isset($carrito[$index])) {
        unset($carrito[$index]);
        session()->put('carrito', array_values($carrito));
    }
    return redirect()->route('carrito.index')->with('success', 'Producto Eliminado');
 } 
}