<?php
$usuarios = array(
    "user" => "user",
    "admin" => "admin"
);

if (isset($_POST['submit'])) {
    // Comprobamos que recibimos los datos y que no están vacíos
    if ((isset($_POST['usuario']) && isset($_POST['password'])) && (!empty($_POST['usuario']) && !empty($_POST['password']))) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        // Verificamos si las credenciales son válidas
        if (array_key_exists($usuario, $usuarios) && $usuarios[$usuario] == $password) {
            session_start();
            $_SESSION['logueado'] = $usuario;
            $_SESSION['usuario'] = $usuario;

            // Creamos un par de cookies para recordar el user/pass. Tcaducidad=15días
            if (isset($_POST['recuerdo']) && ($_POST['recuerdo'] == "on")) { // Si está seleccionado el checkbox...
                // Creamos las cookies para ambas variables
                setcookie('usuario', $_POST['usuario'], time() + (15 * 24 * 60 * 60));
                setcookie('password', $_POST['password'], time() + (15 * 24 * 60 * 60));
                setcookie('recuerdo', $_POST['recuerdo'], time() + (15 * 24 * 60 * 60));
            } else { // Si no está seleccionado el checkbox..
                // Eliminamos las cookies
                if (isset($_COOKIE['usuario'])) {
                    setcookie('usuario', "");
                }
                if (isset($_COOKIE['password'])) {
                    setcookie('password', "");
                }
                if (isset($_COOKIE['recuerdo'])) {
                    setcookie('recuerdo', "");
                }
            }

            // Lógica asociada a mantener la sesión abierta
            if (isset($_POST['abierta']) && ($_POST['abierta'] == "on")) { // Si está seleccionado el checkbox...
                // Creamos una cookie para la sesión
                setcookie('abierta', $_POST['usuario'], time() + (15 * 24 * 60 * 60));
            } else { // Si no está seleccionado el checkbox..
                // Eliminamos la cookie
                if (isset($_COOKIE['abierta'])) {
                    setcookie('abierta', "");
                }
            }

            // Redirigimos a la página correspondiente según el tipo de usuario
            if ($usuario == 'admin') {
                header("Location: frmAdmin.php");
            } elseif ($usuario == 'user') {
                header("Location: frmUser.php");
            } else {
                // En caso de que el usuario no sea ni admin ni user
                header("Location: frmLogin.php?error=datos");
            }
        } else {
            header("Location: frmLogin.php?error=datos");
        }
    }
}
?>

<html>
<head lang="es">
    <?php require 'includes/header.php'; ?>
</head>
<body>
    <?php require 'includes/login.php'; ?>
    <?php require 'includes/footer.php'; ?>
</body>
</html>