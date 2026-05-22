<nav style="background-color: #2e3d36; padding: 15px; border-radius: 8px; margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between; border-bottom: 3px solid #bbc66f; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    
    <div style="flex: 1;"></div>

    <div style="display: flex; gap: 30px; justify-content: center; flex: 2;">
        <a href="<?php echo e(route('login')); ?>" style="color: #ffffff; font-weight: bold; text-decoration: none; opacity: 0.7;">LOGIN</a>
        <a href="<?php echo e(route('productos.index')); ?>" style="color: #bfc96f; font-weight: bold; text-decoration: none; border-bottom: 2px solid #afb867; padding-bottom: 4px;">TIENDA</a>
        <a href="<?php echo e(route('productos.articulos')); ?>" style="color: #ffffff; font-weight: bold; text-decoration: none; opacity: 0.7;">ARTÍCULOS</a>
        <a href="#" style="color: #ffffff; font-weight: bold; text-decoration: none; opacity: 0.7;">CARRITO</a>
    </div>

    <div style="flex: 1; display: flex; justify-content: flex-end; padding-right: 10px;">
        <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin: 0;">
            <?php echo csrf_field(); ?>
            <button type="submit" style="background-color: #ea1010; color: white; border: none; padding: 6px 12px; font-weight: bold; border-radius: 4px; cursor: pointer; font-size: 12px; transition: background-color 0.2s;">
                Cerrar Sesión
            </button>
        </form>
    </div>
</nav>

<link rel="stylesheet" href="<?php echo e(asset('css/crud.css')); ?>">
<script src="<?php echo e(asset('js/crud.js')); ?>" defer></script>

<style>
    body {
        background-color: #f4f6f9;
    }

    .btn-guardar-tech {
        background-color: #49c109; 
        color: white;
        font-weight: bold;
        border: none;
        padding: 6px 15px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.2s ease, transform 0.1s ease;
    }
    /* Efecto al pasar el mouse por encima */
    .btn-guardar-tech:hover {
        background-color: #094bd9;
    }
    /* Efecto justo en el momento de darle clic */
    .btn-guardar-tech:active {
        background-color: #06b9d9; 
        transform: scale(0.96); 
    }
</style>

<center><h1>Gestión de Productos Electronicos.</h1></center>

<?php if(session('success')): ?>
    <div style="color: #6c02be; font-weight: bold; margin-bottom: 15px; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">¡Bienvenido al sistema!</div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div style="color: red; font-weight: bold;"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<h2>Agregar Producto Electronico:</h2>
<form action="<?php echo e(route('productos.store')); ?>" method="POST">
    <?php echo csrf_field(); ?> 
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="descripcion" placeholder="Descripción" required>
    <input type="number" step="0.01" name="precio" placeholder="Precio" required>
    <input type="number" name="stock" placeholder="Stock" required>
    <input type="text" name="categoria" placeholder="Categoría" required>
    <button type="submit" class="btn-guardar-tech">Guardar</button>
</form>

<hr>

<h2>Productos Existentes:</h2>
<table border="1" cellpadding="5">
<tr>
    <th>ID:</th>
    <th>Nombre:</th>
    <th>Descripción:</th>
    <th>Precio:</th>
    <th>Stock:</th>
    <th>Categoría:</th>
    <th>Acciones:</th>
</tr>

<?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($producto->id); ?></td>
    <td><?php echo e($producto->nombre); ?></td>
    <td><?php echo e($producto->descripcion); ?></td>
    <td><?php echo e($producto->precio); ?></td>
    <td><?php echo e($producto->stock); ?></td>
    <td><?php echo e($producto->categoria); ?></td>
    <td style="white-space: nowrap; text-align: center;">
        
        <a href="<?php echo e(route('productos.edit', $producto->id)); ?>" style="background-color: #e1d600; color: white; padding: 12px 6px; border-radius: 4px; text-decoration: none; font-weight: bold; display: inline-block; font-size: 12px; margin-right: 2px;">✏️Editar</a>
        
        <form action="<?php echo e(route('productos.destroy', $producto->id)); ?>" method="POST" style="display:inline;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn-eliminar" onclick="return confirm('¿Seguro de Eliminar?')" style="background-color: #ea1010; color: white; padding: 12px 6px; border-radius: 4px; border: none; cursor: pointer; font-weight: bold; font-size: 12px; display: inline-block; margin-right: 2px;">❌Eliminar</button>
        </form>
        
        <a href="<?php echo e(route('productos.formVenta', $producto->id)); ?>" style="background-color: #10b943; color: white; padding: 12px 6px; border-radius: 4px; text-decoration: none; font-weight: bold; display: inline-block; font-size: 12px;">✅Vender</a>

    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

<hr>

<h2>Historial de Ventas:</h2>


<?php if(session()->has('historial_ventas') && count(session('historial_ventas')) > 0): ?>
    <table border="1" cellpadding="5" style="border-collapse: collapse; width: 100%; max-width: 800px; background-color: #ffffff;">
        <tr style="background-color: #2e3d36; color: white;">
            <th>Fecha / Hora</th>
            <th>ID Prod</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Total Transacción</th>
        </tr>
        <?php $__currentLoopData = session('historial_ventas'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr style="text-align: center;">
            <td><?php echo e($venta['fecha']); ?></td>
            <td><?php echo e($venta['id']); ?></td>
            <td style="text-align: left; padding-left: 10px;"><?php echo e($venta['nombre']); ?></td>
            <td><?php echo e($venta['cantidad']); ?></td>
            <td>$<?php echo e(number_format($venta['precio'], 2)); ?></td>
            <td style="font-weight: bold; color: #10b943;">$<?php echo e(number_format($venta['total'], 2)); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
<?php else: ?>
    <p style="color: #718096; font-style: italic;">No hay Ventas Registradas En Esta Sesión.</p>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\proyectoFinal-main\catedra2-laravel\resources\views/index.blade.php ENDPATH**/ ?>