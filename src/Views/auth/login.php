<?php
/**
 * Vista: Página de Login
 * Variables esperadas:
 * - $BASE_URL (string): URL base de la aplicación
 */
?>
<main class="auth-page" role="main">
    <section class="check-in-area" aria-labelledby="login-heading">
        <header class="titulo-logo">
            <h1 id="login-heading">Iniciar Sesión</h1>
        </header>

            <!-- Mostrar mensaje flash si existe -->
            <?php if ($flash = \App\Helpers\Session::getFlashMessage()): ?>
                <div class="alert alert-<?= $flash['type'] ?>">
                    <?= htmlspecialchars($flash['message']) ?>
                </div>
            <?php endif; ?>

        <form action="<?= $BASE_URL ?>index.php?route=login" method="post" class="check-in-form" aria-label="Formulario de inicio de sesión">
            <div class="user">
                <label for="username">
                    <i class="fas fa-user" aria-hidden="true"></i>
                    <span class="sr-only">Usuario o Email</span>
                </label>
                <input type="text" name="username" placeholder="Usuario o Email" id="username" aria-label="Ingrese su usuario o correo electrónico" required>
            </div>

            <div class="password">
                <label for="password">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    <span class="sr-only">Contraseña</span>
                </label>
                <input type="password" name="password" placeholder="Contraseña" id="password" aria-label="Ingrese su contraseña" required>
            </div>

            <div class="remember-me">
                <label for="rememberme">
                    <input type="checkbox" name="rememberme" id="rememberme" value="1">
                    <span>Recordarme</span>
                </label>
            </div>

            <button type="submit" aria-label="Iniciar sesión en su cuenta">
                <i class="fas fa-sign-in-alt" aria-hidden="true"></i> Iniciar Sesión
            </button>

            <a href="<?= $BASE_URL ?>index.php?route=register" class="register-btn" aria-label="Ir a la página de registro">
                <i class="fas fa-user-plus" aria-hidden="true"></i> Registrarse
            </a>
        </form>
    </section>
</main>