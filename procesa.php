<?php
try {

    $conexion = new PDO('mysql:host=localhost;dbname=tutorialcrud', "root", "");
        
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}


switch($_POST['opc'])
{

 case "guardar":
 try{
          $sql = $conexion->prepare("INSERT INTO usuario(nombre_user,pass_user,correo_user)
          VALUES('".$_POST['user']."','".$_POST['pass']."','".$_POST['correo']."')");       
          $sql->execute();         
          header("location:index.php");   
    }
    catch (PDOException $e) {
    print "¡Error al guardar!: " . $e->getMessage() . "<br/>";
    die();
    } 
    break;

case "eliminar":
 try{
          $sql = $conexion->prepare("DELETE FROM usuario WHERE id_user =".$_POST['clave']);       
          $sql->execute();         
          //header("location:index.php");   
    }
      catch (PDOException $e) {
    print "¡Error al guardar!: " . $e->getMessage() . "<br/>";
    die();
} 
 break;
 case "modificar-form":
 try{
          $sql = $conexion->prepare("SELECT * FROM usuario WHERE id_user=".$_POST['clave']);       
          $sql->execute();         
          if($fila = $sql->fetch())
          {  
 ?>
       <form action="procesa.php" method="post" id="modificar">
                  <input type="text" value="modificar" name="opc" hidden>
                  <input type="text" value="<?php echo $_POST['clave']?>" name="clave" hidden>
                <div class="form-group">
                  <label for="usuario" class="text-left">nombre de usuario</label>
                  <input type="text" class="form-control" id="user" name="user" value="<?php echo $fila['nombre_user']?>" placeholder="usuario">
                  
                </div>
                <div class="form-group">
                  <label for="pass">Password de usuario</label>
                  <input type="password" class="form-control" id="pass" name="pass" value="<?php echo $fila['pass_user']?>" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="correo">Correo de usuario</label>
                  <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $fila['correo_user']?>" placeholder="Correo">
                </div>
               
                <button type="submit" class="btn btn-info">Modificar</button>
              </form>
 <?php
}
  }
      catch (PDOException $e) {
    print "¡Error al guardar!: " . $e->getMessage() . "<br/>";
    die();
}
 break;
 
case "modificar":
  try{
          $sql = $conexion->prepare("UPDATE usuario SET nombre_user='".$_POST['user']."',pass_user='".$_POST['pass']."',correo_user='".$_POST['correo']."' WHERE id_user=".$_POST['clave']);       
          $sql->execute();         
          header("location:index.php");   
    }
      catch (PDOException $e) {
    print "¡Error al guardar!: " . $e->getMessage() . "<br/>";
    die();
}
 break;
}







?>