<div class="main-content">
    <h1>Gestionar Usuarios</h1>

    <a href="<?= $BASE_URL ?>index.php?route=admin_create_user" class="btn-primary btn-inline-add">
        + Añadir Nuevo Usuario
    </a>

    <table class="content-table admin-table admin-users-table">
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
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['nombre'] . ' ' . $user['apellido']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['telefono']) ?></td>
                        <td>
                            <?php if ($user['rol'] === 'admin'): ?>
                                <strong>Admin</strong>
                            <?php else: ?>
                                Usuario
                            <?php endif; ?>
                        </td>
                        <td><?= date('d/m/Y', strtotime($user['creado_en'])) ?></td>
                        <td class="actions">
                            <a href="#" class="btn-edit">Editar</a>
                            <a href="#" class="btn-delete">Borrar</a>
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