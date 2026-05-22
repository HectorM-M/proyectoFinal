<div style="background-color: #387257; border: 3px solid #000000; border-radius: 8px; padding: 25px; max-width: 600px; margin: 40px auto; color: #ffffff; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">

    <h2 style="color: #ffffff; margin-top: 0; text-align: center;">Editar Producto: <?php echo e($producto->nombre); ?></h2>

    <form action="<?php echo e(route('productos.update', $producto->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <label style="font-weight: bold;">Nombre:</label><br>
        <input type="text" name="nombre" value="<?php echo e($producto->nombre); ?>" style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #ccc;" required><br>

        <label style="font-weight: bold;">Descripción:</label><br>
        <textarea name="descripcion" style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #ccc;" required><?php echo e($producto->descripcion); ?></textarea><br>

        <label style="font-weight: bold;">Precio:</label><br>
        <input type="number" step="0.01" name="precio" value="<?php echo e($producto->precio); ?>" style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #ccc;" required><br>

        <label style="font-weight: bold;">Stock:</label><br>
        <input type="number" name="stock" value="<?php echo e($producto->stock); ?>" style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 4px; border: 1px solid #ccc;" required><br>

        <label style="font-weight: bold;">Categoría:</label><br>
        <input type="text" name="categoria" value="<?php echo e($producto->categoria); ?>" style="width: 100%; padding: 10px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #ccc;" required><br>

        <div style="text-align: center;">
            <button type="submit" style="background-color: #ffc107; color: #000; padding: 12px 25px; border: none; cursor: pointer; font-weight: bold; border-radius: 4px; font-size: 16px;">
                Actualizar Producto
            </button>
            <a href="<?php echo e(route('productos.index')); ?>" style="background-color: #dc3545; color: white; padding: 12px 25px; text-decoration: none; font-weight: bold; border-radius: 4px; font-size: 16px; display: inline-block;">
                Cancelar
            </a>
        </div>
    </form>
</div><?php /**PATH C:\xampp\htdocs\proyectoFinal-main\catedra2-laravel\resources\views/productos/edit.blade.php ENDPATH**/ ?>