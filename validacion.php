<?php
    include('bd.php');
    $usuario=$_POST['usuario'];
    $clave=$_POST['clave'];
    session_start();
    $_SESSION['usuario']=$usuario;
    $conexion=mysqli_connect("localhost","root","","hospital");
    $consulta="SELECT*FROM usuarios where usuario = '$usuario' and clave = '$clave'";
    $resultado=mysqli_query($conexion,$consulta);
    $filas=mysqli_num_rows($resultado);
    if($filas){
        header("location: datos.php");
    }else{
        ?>
        <?php
            include("index.php");
        ?>
            <h1 class="bad">ERROR DE AUTENTIFICACION</h1>
        <?php
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
?>