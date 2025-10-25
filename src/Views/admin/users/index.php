<div class="main-content">
    <h1>Gestionar Usuarios</h1>

    <a href="<?= $BASE_URL ?>index.php?route=admin_create_user" class="btn-submit"
        style="margin-bottom: 20px; display: inline-block;">
        + Añadir Nuevo Usuario
    </a>

    <table class="content-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nombre Completo</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Rol</th>
                <th>Registrado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['nombre'] . ' ' . $user['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['telefono']); ?></td>
                        <td>
                            <?php if ($user['rol'] === 'admin'): ?>
                                <strong><?php echo 'Admin'; ?></strong>
                            <?php else: ?>
                                <?php echo 'Usuario'; ?>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date('d/m/Y', strtotime($user['creado_en'])); ?></td>
                        <td class="actions">
                            <a href="#">Editar</a>
                            <a href="#" class="delete">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No se encontraron usuarios.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>