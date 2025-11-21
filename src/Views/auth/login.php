<main class="auth-page">
        <div class="check-in-area">
            <div class="titulo-logo">
                <h2>Iniciar Sesión</h2>
            </div>

            <!-- Mostrar mensaje flash si existe -->
            <?php if ($flash = \App\Helpers\Session::getFlashMessage()): ?>
                <div class="alert alert-<?= $flash['type'] ?>">
                    <?= htmlspecialchars($flash['message']) ?>
                </div>
            <?php endif; ?>

            <form action="<?= $BASE_URL ?>index.php?route=login" method="post" class="check-in-form">
                <div class="user">
                    <label for="username">
                        <i class="fas fa-user"></i>
                    </label>
                    <input type="text" name="username" placeholder="Usuario o Email" id="username" required>
                </div>

                <div class="password">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                    </label>
                    <input type="password" name="password" placeholder="Contraseña" id="password" required>
                </div>

                <button type="submit">
                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                </button>

                <label>
                    <input type="checkbox" name="rememberme" value="1"> Recordarme
                </label>

                <a href="<?= $BASE_URL ?>index.php?route=register" class="register-btn">
                    <i class="fas fa-user-plus"></i> Registrarse
                </a>
            </form>
        </div>
    </main>