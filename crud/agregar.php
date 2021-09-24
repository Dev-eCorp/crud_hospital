<?php
    include('../bd.php');
    if (isset($_POST['save_pacient'])) {
        $tipo_docmento = $_POST['tipo_documento'];
        $numero_documento = $_POST['num_documento'];
        $nom1 = $_POST['nombre1'];
        $nom2 = $_POST['nombre2'];
        $ape1 = $_POST['apellido1'];
        $ape2 = $_POST['apellido2'];
        $genero = $_POST['genero'];
        $dep = $_POST['departamento'];
        $mun = $_POST['municipio'];
        $query = "INSERT INTO paciente(id, tipo_documento_id, numero_documento, nombre1, nombre2, apellido1, apellido2, genero_id, departamento_id, municipio_id) VALUES (NULL, '$tipo_docmento', '$numero_documento', '$nom1', '$nom2', '$ape1', '$ape2', '$genero', '$dep', '$mun')";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die("Query Failed.");
        }
        $_SESSION['message'] = 'Paciente agregado con exito';
        $_SESSION['message_type'] = 'success';
        header('Location: ../datos.php');
    }
?>