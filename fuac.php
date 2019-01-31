<?php
//Start session
session_start();
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['user_id']) || (trim($_SESSION['user_id']) == '')) {
    header("location: login.php");
    exit();
}
$session_id=$_SESSION['user_id'];

?>

<?php 
include('dbcon.php');
include('session.php'); 

$result=mysqli_query($con, "select * from users where user_id='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);

 ?>

<?php
 
$dataPoints = array();
$dataPoints2 = array();
try{
    
    $result2 = mysqli_query($con, "SELECT *  from sensor ORDER BY id desc");
    $numero2 = 1;
    $row2 = mysqli_fetch_array($result2);
        $id2=$row2["id"];
        $fecha2=$row2["fecha"];
        $papel2=$row2["temp"];
        $jabon2=$row2["hum"];
    
    $papel3 = 15-$papel2; 
    
    $link = new \PDO(   'mysql:$con,
                        array(
                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );
	
    $handle = $link->prepare('select id, temp, fecha from sensor'); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
		
    foreach($result as $row){
        array_push($dataPoints, array("x"=> $row->id, "y"=> $row->temp, "label"=>$row->fecha));
        array_push($dataPoints2, array("x"=> $row->id, "y"=> $row->hum, "label"=>$row->fecha));
    }
	$link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}
	
?>

<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <meta http-equiv="refresh"  content="60"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Historico de Datos</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/product.css" rel="stylesheet">
</head>

<body>

<nav class="site-header sticky-top py-1">
    <div class="container d-flex flex-column flex-md-row justify-content-between">
      <a class="py-2" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
      </a>
      <a class="py-2 d-none d-md-inline-block" href="index.php">Home</a>
      <a class="py-2 d-none d-md-inline-block dropdown-toggle" href="#" id="navBarServicios" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Servicios</a>
      <div class="dropdown-menu" aria-labelledby="navBarServicios">
        <a class="dropdown-item" style="color: black" href="fuac.php">FUAC</a>
        <a class="dropdown-item" style="color: black" href="#">IoT</a>
        <a class="dropdown-item" style="color: black" href="#">Connecting People</a>
      </div>
      <a class="py-2 d-none d-md-inline-block" href="#">Microsoft Azure</a>
      <a class="py-2 d-none d-md-inline-block" href="#">Empresarial</a>
      <a class="py-2 d-none d-md-inline-block" href="#">Soporte</a>
      <a class="py-2 d-none d-md-inline-block" href="#">Empleados</a>
      <a class="py-2 d-none d-md-inline-block" href="logout.php">Logout</a>
    </div>
</nav>

<div class="position-relative overflow-hidden p-3 p-md-6 m-md-3 text-center bg-light">
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-3 shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-4 shadow-sm d-none d-md-block"></div>
    <div class="col-md-12 p-lg-3 mx-auto my-4">    
    <h1 class="display-4 font-weight-normal">Monitor P&J Bienvenido</h1>
    <p>&nbsp;</p>
    
    <div class="container py-2">
        <div class="row">
                <iframe height="530" width="1080" src="prueba26.php">
                    <p>Your browser does not support iframes.</p>
                </iframe>
        </div>
    </div>
    
    <div class="container py-2">
        <div class="row">
                <iframe height="530" width="1080" src="prueba26a.php">
                    <p>Your browser does not support iframes.</p>
                </iframe>
        </div>
    </div>
    
    <div class="col-md-12 p-lg-2 mx-auto my-4">
        <div class="display-4 font-weight-normal">
            <h3 >Papel Historico </h3>
            <p>&nbsp;</p>
                <iframe height="600" width="1080" src="prueba24c.php">
                    <p>Your browser does not support iframes.</p>
                </iframe>
        </div>
    </div>
    
    <div class="col-md-12 p-lg-2 mx-auto my-4">
        <div class="display-4 font-weight-normal">
            <h3 >Jabon Historico </h3>
            <p>&nbsp;</p>
                <iframe height="600" width="1080" src="prueba24d.php">
                    <p>Your browser does not support iframes.</p>
                </iframe>
        </div>
    </div>
</div>

    <footer class="container py-5">
        <div class="col-md-12" allign="text-center">
          <div class="display-4 font-weight-normal">
              <h6><a href="index.php"> <?php echo date("Y")?>. IoT Colombia. Todos los derechos reservados </a></h6>
          </div>
</footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/holder.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
  </body>
</html>
