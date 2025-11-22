<?php
/**
 * Vista: Página de Registro
 * Variables esperadas:
 * - $BASE_URL (string): URL base de la aplicación
 */
?>
<main class="auth-page" role="main">
    <section class="check-in-area" aria-labelledby="register-heading">
      <header class="titulo-logo">
        <h1 id="register-heading">Registro</h1>
      </header>

      <!-- Mostrar mensaje flash si existe -->
      <?php if ($flash = \App\Helpers\Session::getFlashMessage()): ?>
          <div class="alert alert-<?= $flash['type'] ?>">
              <?= htmlspecialchars($flash['message']) ?>
          </div>
      <?php endif; ?>

      <form action="<?= $BASE_URL ?>index.php?route=register" method="post" class="check-in-form" aria-label="Formulario de registro de nueva cuenta">
    <input type="hidden" name="action" value="register">
    
    <div class="user">
        <label for="username">
            <i class="fas fa-user" aria-hidden="true"></i>
            <span class="sr-only">Nombre de usuario</span>
        </label>
        <input type="text" name="username" id="username" placeholder="Nombre de usuario" aria-label="Ingrese su nombre de usuario" required>
    </div>

    <div class="password">
        <label for="password">
            <i class="fas fa-lock" aria-hidden="true"></i>
            <span class="sr-only">Contraseña</span>
        </label>
        <input type="password" name="password" id="password" placeholder="Contraseña" aria-label="Ingrese una contraseña segura" required>
    </div>

    <div class="user">
        <label for="email">
            <i class="fas fa-envelope" aria-hidden="true"></i>
            <span class="sr-only">Correo electrónico</span>
        </label>
        <input type="email" name="email" id="email" placeholder="Correo electrónico" aria-label="Ingrese su correo electrónico" required>
    </div>

    <div class="user">
        <label for="phone">
            <i class="fas fa-phone" aria-hidden="true"></i>
            <span class="sr-only">Teléfono</span>
        </label>
        <input type="tel" name="phone" id="phone" placeholder="Teléfono" aria-label="Ingrese su número de teléfono" required>
    </div>

    <button type="submit" aria-label="Crear nueva cuenta">
        <i class="fas fa-user-plus" aria-hidden="true"></i> Registrarse
    </button>

    <a href="<?= $BASE_URL ?>index.php?route=login" class="register-btn" aria-label="Ir a la página de inicio de sesión">
        ¿Ya tienes cuenta? Inicia Sesión
    </a>
</form>
    </section>
</main>
