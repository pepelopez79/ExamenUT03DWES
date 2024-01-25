<div class="centrar">    
  <div class="container cuerpo text-center">    
    <p><h2><img class="alineadoTextoImagen" src="images//user.png" width="50px"/> Login:</h2></p>
  </div>
  
  <div class="container">
    <form action="frmLogin.php" method="POST">
      <label for="name">Usuario:
        <input type="text" name="usuario" class="form-control" value="<?php if(isset($_COOKIE['usuario'])) { echo $_COOKIE['usuario']; } ?>" /> 
      </label>
      <br/>
      
      <label for="password">Contraseña:
        <input type="password" name="password" class="form-control" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>"/>            
      </label>
      <br/>
      
      <label><input type="checkbox" name="recuerdo" <?php if(isset($_COOKIE['recuerdo'])){echo " checked";} ?> > Recordad usuario</label>
      <br/>     
      
      <label><input type="checkbox" name="abierta" <?php if(isset($_COOKIE['abierta'])){echo " checked";} ?> > Mantener sesión iniciada</label>
      <br/>     

      <?php
        if(isset($_GET['error'])){
          if ($_GET['error'] == "datos") {
            echo '<div class="alert alert-danger" style="margin-top:5px;">' . "¡Su usuario o/y tu contraseña no son correctos, inténtelo de nuevo!<br/>" . '</div>';
          } else if ($_GET['error'] == "fuera") {
            echo '<div class="alert alert-danger" style="margin-top:5px;">' . "¡No puede acceder directamente a esta página, ha de loguearse!<br/>" . '</div>';   
          }
        }     
      ?>      

      <input type="submit" value="Acceder" name="submit" class="btn btn-success" />
    </form>
  </div>
</div>