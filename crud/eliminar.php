<?php
    include("../bd.php");
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM paciente WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die("Error de consulta");
        }
        $_SESSION['message'] = 'Paciente eliminado con exito';
        $_SESSION['message_type'] = 'danger';
        header('Location: ../datos.php');
    }
?>