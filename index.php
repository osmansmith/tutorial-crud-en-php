
<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">    
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
</head>
  <body>
  <!-- Menu -->
    <header>          
       <div class="container-fluid menu" >
         <nav class="navbar navbar-expand-lg container">
            <a class="navbar-brand text-light bg-gray" href="#"><img src="img/logo.png" class="img-fluid" width="60" alt="Multiversos">Tutorial Crud en PHP con 'Multiversos'</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">               
              </ul>              
            </div>
          </nav>
      </div>            
    </header>
<!-- Fin Menu -->

<!-- Bienvenida -->
<div class="container-fliud fondo">
	<div class="container">
	  <div class="row align-items-center text-center text-light py-5">
	  	<div class="col-md-12">
	  		<h1 class="display-4">Bienvenido a Multiversos</h1>
		<p class="lead">Sucribete y regalanos un like (también síguenos en nuestras redes sociales)!</p>
    <a href="https://www.youtube.com/channel/UC1kLEcbegB5C83vyqCoc_4A?view_as=subscriber" style="font-size: 20px; color:#c0392b; " target="_blank" title="Youtube/Multiversos646" ><img src="img/Youtube.png" width="60" alt="Youtube"></a>
     <a href="https://www.facebook.com/multiversos646/" style="font-size: 20px; color:#3498db; " target="_blank" title="Facebook/Multiversos646"><img src="img/Facebook.png" width="60" alt=""></a>
      <a href="https://www.instagram.com/multiversos646/?hl=es" style="font-size: 20px; color:#fff; " target="_blank" title="Instagram/Multiversos646"><img src="img/Instagram.png" width="60" alt=""></a>
       <a href="https://twitter.com/Multiversos646" style="font-size: 20px; color:#fff; " target="_blank" title="Twitter/Multiversos646"><img src="img/Twitter.png" width="60" alt=""></a>
        <a href="https://twitter.com/Multiversos646" style="font-size: 20px; color:#fff; " target="_blank" title="Patreon/Multiversos646"><img src="img/Patreon2.png" width="60" alt=""></a>
	  	</div>
	  </div>	
	</div>  
</div><!-- fin Bienvenida -->

<!-- CRUD -->
<div class="container-fluid bg-light ">
<div class="container py-5" >
    <div class="row">
      <div class="col-md-3 ">
          <div class="card ml-auto sombra">
              <div class="card-body">
                <h4 class="card-title text-center">Ingresar usuario</h4>

                <form action="procesa.php" method="post" id="guarda">
                  <input type="text" value="guardar" name="opc" hidden>
                <div class="form-group">
                  <label for="usuario" class="text-left">nombre de usuario</label>
                  <input type="text" class="form-control" id="user" name="user" placeholder="usuario">
                  
                </div>
                <div class="form-group">
                  <label for="pass">Password de usuario</label>
                  <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="correo">Correo de usuario</label>
                  <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo">
                </div>
               
                <button type="submit" class="btn btn-primary">Guardar</button>
              </form>

              </div>
            </div>
      </div>
      <!-- Area donde se listan los datos -->
      <div class="col-md-9 ">
          <div class="card mr-auto sombra">
              <div class="card-body">
                <h4 class="card-title text-center">Acá se mostrarán los datos</h4>               
                <ul class="list-group">

                <?php

                try {
                      $conexion = new PDO('mysql:host=localhost;dbname=tutorialcrud', "root", "");
                          
                  } catch (PDOException $e) {
                      print "¡Error!: " . $e->getMessage() . "<br/>";
                      die();
                  }

                  try
                  {
                  $sql = $conexion->prepare("SELECT * FROM usuario");
                  $sql->execute();
                  while ( $fila = $sql->fetch()) {
                    ?>
                  <li class="list-group-item">

                    id = <?php echo $fila['id_user']?>, 
                    nombre = <?php echo $fila['nombre_user']?>, 
                    password = <?php echo $fila["pass_user"]?>, 
                    correo = <?php echo $fila['correo_user']?>

                      <span class="fa-stack  float-right eliminar" id="<?php echo $fila['id_user']?>" style="color:red; cursor: pointer;" title="Eliminar Registro">
                      <i class="fa fa-circle fa-stack-2x"></i>
                      <i class="fa fa-trash fa-stack-1x fa-inverse"></i>
                      </span>

                      <span class="fa-stack  float-right modificar" id="<?php echo $fila['id_user']?>" style="color:blue; cursor: pointer ;" title="Actualizar Registro">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                      </span>
                  </li>                    
                    
                    <?php
                  }
                }
                catch(Exception $ex)
                {
                    print "¡Error!: " . $ex->getMessage() . "<br/>";
                      die();
                }
                ?>
                </ul>
              </div>
            </div>
      </div>
    </div> 
   
       
</div>
</div>
<!-- Fin CRUD -->

<!-- Modal -->
<div class="modal fade" id="modificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body datos">       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>      
      </div>
    </div>
  </div>
</div>
<!-- fin Modal -->


<footer class="footer">
    <div class="container text-center text-white">
      <span class="text-muted empresa"></span>
    </div>
</footer>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="js/scrollreveal.min.js"></script> -->
    <script src="js/helper.js"></script>
    <script>

       $(".eliminar").click(function(){
        var clave = $(this).attr("id");
        $.ajax({
          url : "procesa.php",
          data : "opc=eliminar&clave="+clave,
          type : "post",
          success: function()
          {
            location.reload();
          }
        })
      });
       
       $(".modificar").click(function(){
        var clave = $(this).attr("id");
         $.ajax({
          url : "procesa.php",
          data : "opc=modificar-form&clave="+clave,
          type : "post",
          success: function($datos)
          {
            $(".datos").html($datos);
          }
        })
        $('#modificar').modal('show');
      });
    </script>
  </body>
</html>
