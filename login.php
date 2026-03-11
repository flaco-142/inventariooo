<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: inicio.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login Inventario</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .card-header {
      background-color: #7B1F1F; /* Rojo vino oscuro */
      color: #fff;
    }
    .btn-vino {
      background-color: #7B1F1F;
      color: #fff;
    }
    .btn-vino:hover {
      background-color: #5a1414;
      color: #fff;
    }
    .logo {
      display: block;
      margin: 0 auto 15px auto;
      max-width: 220px; /* Ajusta el tamaño según lo necesites */
    }
    footer {
      background-color:#f8f9fa;
      text-align:center;
      padding:15px;
      margin-top:30px;
      border-top:1px solid #ddd;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header text-center">
            <h4>Iniciar Sesión</h4>
          </div>
          <div class="card-body">
            <!-- Imagen institucional -->
            <img src="../assets/logo_color.png" 
                 alt="Valle de Chalco Solidaridad - Gobernemos con el Corazón" 
                 class="logo">
            
            <form action="validar.php" method="POST">
              <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
              </div>
              <div class="mb-3">
                <label for="clave" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="clave" name="clave" required>
              </div>
              <button type="submit" class="btn btn-vino w-100">Entrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer institucional -->
  <footer>
    © 2026 H. Ayuntamiento de Valle de Chalco Solidaridad.<br>
    "Gobernemos con el Corazón"<br>
    Todos los derechos reservados. Sistema de Gestión de Inventarios.
  </footer>
</body>
</html>
