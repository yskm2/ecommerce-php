<?php
/**
 * Vista: Página de Registro
 * Variables esperadas:
 * - $BASE_URL (string): URL base de la aplicación
 */
?>
<main class="auth-page">
    <div class="check-in-area">
      <div class="titulo-logo">
        <h2>Registro</h2>
      </div>

      <!-- Mostrar mensaje flash si existe -->
      <?php if ($flash = \App\Helpers\Session::getFlashMessage()): ?>
          <div class="alert alert-<?= $flash['type'] ?>">
              <?= htmlspecialchars($flash['message']) ?>
          </div>
      <?php endif; ?>

      <form action="<?= $BASE_URL ?>index.php?route=register" method="post" class="check-in-form">
    <input type="hidden" name="action" value="register">
    
    <div class="user">
        <label for="username">
            <i class="fas fa-user"></i>
        </label>
        <input type="text" name="username" id="username" placeholder="Nombre de usuario" required>
    </div>

    <div class="password">
        <label for="password">
            <i class="fas fa-lock"></i>
        </label>
        <input type="password" name="password" id="password" placeholder="Contraseña" required>
    </div>

    <div class="user">
        <label for="email">
            <i class="fas fa-envelope"></i>
        </label>
        <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
    </div>

    <div class="user">
        <label for="phone">
            <i class="fas fa-phone"></i>
        </label>
        <input type="tel" name="phone" id="phone" placeholder="Teléfono" required>
    </div>

    <button type="submit">
        <i class="fas fa-user-plus"></i> Registrarse
    </button>

    <a href="<?= $BASE_URL ?>index.php?route=login" class="register-btn">
        ¿Ya tienes cuenta? Inicia Sesión
    </a>
</form>
    </div>
    </main>
