<?php
session_start();

function obtenerNombreUsuario() {
    return isset($_SESSION['logueado']) ? $_SESSION['logueado'] : (isset($_COOKIE['abierta']) ? $_COOKIE['abierta'] : null);
}

$usuario = obtenerNombreUsuario();

$mensaje = "";
if ($usuario && isset($_COOKIE[$usuario . '_visita']) && isset($_COOKIE[$usuario . '_fecha'])) {
    $mensaje = "¡Hola de nuevo, $usuario! Tu última visita fue el " . $_COOKIE[$usuario . '_fecha'];
} else {
    setcookie($usuario . '_visita', 'ok', time() + 365 * 24 * 60 * 60);
    $mensaje = "¡Bienvenido por primera vez, $usuario!";
}

$fecha = '';

if (!isset($_SESSION['logueado']) && !isset($_COOKIE['abierta'])) {
    $fecha = date("d/m/Y| H:i:s");
    setcookie($usuario . '_fecha', $fecha, time() + 365 * 24 * 60 * 60);
}

if (isset($_COOKIE[$usuario.'_contador'])) {
    setcookie($usuario.'_contador', ++$_COOKIE[$usuario.'_contador'], time() + 365 * 24 * 60 * 60);
} else {
    setcookie($usuario.'_contador', 1, time() + 365 * 24 * 60 * 60);
}

$ultimaOpcion = isset($_COOKIE[$usuario.'_ultima_opcion']) ? $_COOKIE[$usuario.'_ultima_opcion'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ir']) && isset($_POST['opcion'])) {
        $opcion = $_POST['opcion'];

        setcookie($usuario.'_ultima_opcion', $opcion, time() + 365 * 24 * 60 * 60);

        switch ($opcion) {
            case 'c':
              header("Location: frmC.php");
              exit;
            case 'd':
                header("Location: frmD.php");
                exit;
            default:
                exit;
        }
    }
}
?>

<html>
<head>
    <title>DWES - Examen</title>
    <meta charset="UTF-8" />
</head>

<body>

<nav class="navbar navbar-light">
    <div class="ml-auto">
        <a class="btn btn-danger" href="includes/logout.php">Salir</a>
    </div>
</nav>

<div class="centrar">    
    <div class="container cuerpo text-center">    
        <p>
            <h2>
                <img class="alineadoTextoImagen" src="images//user.png" width="50px"/>
                Bienvenido  
                <?php 
                    if (isset($_COOKIE['abierta'])) { 
                        echo "'" . $_COOKIE['abierta'] . "'";
                    } else { 
                        echo "'" . $_SESSION['logueado'] . "'";
                    } 
                ?> 
            </h2>
        </p>

        <br>

        <div class="alert alert-info" role="alert">
            <?php echo $mensaje; ?>
        </div>

        <?php if ($_COOKIE[$usuario.'_contador'] > 1): ?>
            <div class="centrar">
                <div class="container cuerpo text-center">
                    <div class="alert alert-success" role="alert">
                        <?php echo "Número de visitas como $usuario: " . $_COOKIE[$usuario.'_contador']; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php
            echo '<br><br><strong>Opciones de usuario:</strong>';
            echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
            echo '<div class="form-check form-check-inline">';
            echo '<input class="form-check-input" type="radio" name="opcion" id="opcionC" value="c"';
            echo ($ultimaOpcion === 'c') ? ' checked' : '';
            echo '>';
            echo '<label class="form-check-label" for="opcionC" style="margin-right: 50px;">Opción C</label>';
            echo '</div>';
            echo '<div class="form-check form-check-inline">';
            echo '<input class="form-check-input" type="radio" name="opcion" id="opcionD" value="d"';
            echo ($ultimaOpcion === 'd') ? ' checked' : '';
            echo '>';
            echo '<label class="form-check-label" for="opcionD" style="margin-right: 30px;">Opción D</label>';
            echo '</div>';
            echo '<input type="submit" class="btn btn-primary" name="ir" value="Ir...">';
            echo '</form>';
        ?> 
    </div>
</div>

</body>
</html>