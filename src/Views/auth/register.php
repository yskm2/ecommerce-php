<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link rel="stylesheet" href="./css/register.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

  <main>
    <div class="check-in-area">
      <div class="titulo-logo">
        <h2>Registro</h2>
      </div>

      <!-- Adaptado para que funcione con php/register.php -->
      <form action="<?= $BASE_URL ?>index.php?route=register" method="post" class="check-in-form">
    <input type="hidden" name="action" value="register">
    
    <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="username" id="username" placeholder="Nombre de usuario" required>
    </div>

    <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="Contraseña" required>
    </div>

    <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
    </div>

    <div class="input-group">
        <i class="fas fa-phone"></i>
        <input type="tel" name="phone" id="phone" placeholder="Teléfono" required>
    </div>

    <button type="submit">
        <i class="fas fa-user-plus"></i> Registrarse
    </button>

    <a href="<?= BASE_URL ?>index.php?route=login" class="secondary-btn">
        ¿Ya tienes cuenta? Inicia Sesión
    </a>
</form>
    </div>
  </main>

  <footer class="footer">
    <div class="footer-elements">
      
    </div>
  </footer>

</body>
</html>
