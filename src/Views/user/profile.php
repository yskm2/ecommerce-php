<main class="page-content">
    <div class="container">
        <h1 class="page-title">Mi Perfil</h1>

        <!-- Mostrar mensaje flash si existe -->
        <?php if ($flash = \App\Helpers\Session::getFlashMessage()): ?>
            <div class="alert alert-<?= $flash['type'] ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>

        <!-- Botones de acción -->
        <div class="profile-actions" style="margin-bottom:20px;">
            <button id="edit-btn" class="btn-secondary">Editar Perfil</button>
            <form action="<?= $BASE_URL ?>index.php?route=logout" method="post" style="display:inline;">
                <button type="submit" class="btn-danger">Cerrar Sesión</button>
            </form>
        </div>

        <!-- Formulario de perfil -->
        <form id="profile-form" action="<?= $BASE_URL ?>index.php?route=profile-update" method="POST" class="profile-form">
            
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($user['nombre']) ?>" disabled required>

            <label>Apellido</label>
            <input type="text" name="apellido" value="<?= htmlspecialchars($user['apellido']) ?>" disabled>

            <label>Correo</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" disabled required>

            <label>Teléfono</label>
            <input type="text" name="telefono" value="<?= htmlspecialchars($user['telefono']) ?>" disabled>

            <label>Dirección</label>
            <input type="text" name="direccion" value="<?= htmlspecialchars($user['direccion'] ?? '') ?>" disabled>

            <button id="save-btn" type="submit" class="btn-primary" style="display:none;">Guardar Cambios</button>
        </form>

        <!-- Eliminar cuenta -->
        <form action="<?= $BASE_URL ?>index.php?route=profile-delete" method="POST" style="margin-top:20px;">
            <button type="submit" class="btn-danger" onclick="return confirm('¿Seguro que deseas eliminar tu cuenta?')">
                Eliminar cuenta
            </button>
        </form>
    </div>

    <!-- JS para habilitar edición -->
    <script>
        const editBtn = document.getElementById('edit-btn');
        const saveBtn = document.getElementById('save-btn');
        const inputs = document.querySelectorAll('#profile-form input[type="text"], #profile-form input[type="email"]');

        editBtn.addEventListener('click', (e) => {
            e.preventDefault();
            inputs.forEach(input => input.disabled = false);
            saveBtn.style.display = 'inline-block';
            editBtn.style.display = 'none';
        });
    </script>
</main>
