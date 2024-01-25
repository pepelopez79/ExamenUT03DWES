<nav class="navbar navbar-light">
    <div class="ml-auto">
        <a class="btn btn-danger" href="includes/logout.php">Salir</a>
    </div>
</nav>

<div class="centrar">    
    <div class="container cuerpo text-center">    
        <h1><strong>Opción C</strong></h1> 
        <p>
            <h2>
                <img class="alineadoTextoImagen" src="images//user.png" width="50px"/> 
                <?php 
                    if (isset($_COOKIE['abierta'])) { 
                        echo "'" . $_COOKIE['abierta'] . "'"; 
                    } else { 
                        echo "'" . $_SESSION['logueado'] . "'"; 
                    } 
                ?> 
            </h2>
        </p>

        <a class="btn btn-primary" href="frmUser.php">Volver</a>
    </div>
</div>