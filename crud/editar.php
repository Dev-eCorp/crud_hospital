<?php
    include("../bd.php");
    $tipo_docmento = '';
    $numero_documento = '';
    $nom1 = '';
    $nom2 = '';
    $ape1 = '';
    $ape2 = '';
    $genero = '';
    $dep = '';
    $mun = '';

    if  (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM paciente WHERE id=$id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $tipo_docmento = $row['tipo_documento_id'];
            $numero_documento = $row['numero_documento'];
            $nom1 = $row['nombre1'];
            $nom2 = $row['nombre2'];
            $ape1 = $row['apellido1'];
            $ape2 = $row['apellido2'];
            $genero = $row['genero_id'];
            $dep = $row['departamento_id'];
            $mun = $row['municipio_id'];
        }
    }

    if (isset($_POST['update'])) {
        $id = $_GET['id'];
        $tipo_docmento = $_POST['tipo_documento'];
        $numero_documento = $_POST['num_documento'];
        $nom1 = $_POST['nombre1'];
        $nom2 = $_POST['nombre2'];
        $ape1 = $_POST['apellido1'];
        $ape2 = $_POST['apellido2'];
        $genero = $_POST['genero'];
        $dep = $_POST['departamento'];
        $mun = $_POST['municipio'];

        $query = "UPDATE paciente set tipo_documento_id = '$tipo_docmento', numero_documento = '$numero_documento', nombre1 = '$nom1', nombre2 = '$nom2', apellido1 = '$ape1', apellido2 = '$ape2', genero_id = '$genero', departamento_id = '$dep', municipio_id = '$mun' WHERE id=$id";
        $result = mysqli_query($conn, $query);
        if(!$result) {
            die("Query Failed.");
        }
        $_SESSION['message'] = 'Datos del paciente actualizados con exito';
        $_SESSION['message_type'] = 'warning';
        header('Location: ../datos.php');
    }

?>
<?php include('../includes/header.php'); ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="editar.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <label for="tipo_documento">Seleccione el tipo de documento del paciente:</label>
                        <select name="tipo_documento" class="form-control" id="tipo_documento" required>
                            <option value="0>">Seleccione el tipo de documento</option>
                            <?php
                                $getDocuments = "select * from tipos_documento order by id";
                                $consulta = mysqli_query($conn, $getDocuments);
                                while ($row = mysqli_fetch_array($consulta)) {
                                    $id = $row['id'];
                                    $nombre = $row['nombre'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="num_documento">Digite el numero de documento del paciente:</label>
                        <input type="text" name="num_documento" value="<?php echo $numero_documento; ?>" class="form-control" placeholder="N° de documento" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="nombre1">Escriba el primer nombre del paciente:</label>
                        <input name="nombre1" class="form-control" value="<?php echo $nom1; ?>" placeholder="Primer nombre" required></input>
                    </div>
                    <div class="form-group">
                        <label for="nombre2">Escriba el segundo nombre del paciente:</label>
                        <input name="nombre2" class="form-control" value="<?php echo $nom2; ?>" placeholder="Segundo nombre" required></input>
                    </div>
                    <div class="form-group">
                        <label for="apellido1">Escriba el primer apellido del paciente:</label>
                        <input name="apellido1" class="form-control" value="<?php echo $ape1; ?>" placeholder="Primer apellido" required></input>
                    </div>
                    <div class="form-group">
                        <label for="apellido2">Escriba el segundo apellido del paciente:</label>
                        <input name="apellido2" class="form-control" value="<?php echo $ape2; ?>" placeholder="Segundo apellido" required></input>
                    </div>
                    <div class="form-group">
                        <label for="genero">Seleccione el genero del paciente:</label>
                        <select name="genero" class="form-control" id="genero" required>
                            <option value="0">Seleccione el genero</option>
                            <?php
                                $getGenders = "select * from genero order by id";
                                $consulta = mysqli_query($conn, $getGenders);
                                while ($row = mysqli_fetch_array($consulta)) {
                                    $id = $row['id'];
                                    $nombre = $row['nombre'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="departamento">Seleccione el departamento de vivienda del paciente:</label>
                        <select name="departamento" class="form-control" id="departamento" onchange="rellenar_municipios();" required>
                            <option value="0">Seleccione el departamento</option>
                            <?php
                                $getDepartments = "select * from departamentos order by nombre";
                                $consulta = mysqli_query($conn, $getDepartments);
                                while ($row = mysqli_fetch_array($consulta)) {
                                    $id = $row['id'];
                                    $nombre = $row['nombre'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="municipios">
                        <label for="municipio">Seleccione el municipio de vivienda del paciente:</label>
                        <select name="municipio" id="municipio" class="form-control" required>
                            <option value="0">Seleccione el municipio</option>
                        </select>
                    </div>
                    <input type="submit" name="update" class="btn btn-success btn-block" value="Actualizar" onclick="validar_cbx();">
                </form>
            </div>
        </div>
    </div>
</div>
<script src="./js/main.js"></script>
<?php include('../includes/footer.php'); ?>
<script>
    function validar_cbx(){
    let tipo_doc = document.getElementById('tipo_documento').value,
        genero = document.getElementById('genero').value,
        dept = document.getElementById('departamento').value,
        municip = document.getElementById('municipio').value;
    if(tipo_doc == 0){
        alert('Debes seleccionar un tipo de documento valido');
    }

    if(genero == 0){
        alert('Debes seleccionar un genero valido');
    }

    if(dept == 0){
        alert('Debes seleccionar un departamento valido');
    }

    if(municip == 0){
        alert('Debes seleccionar un municipio valido');
    }
}

function rellenar_municipios(){  
    let dept = document.getElementById('departamento'),
        municip = document.getElementById('municipio');
    if(dept.value == 1){
        municip.innerHTML = '';
        municip.insertAdjacentHTML('beforeend', '<option value="1">Medellin</option>');
        municip.insertAdjacentHTML('beforeend', '<option value="2">Bello</option>');
    }else if(dept.value == 2){
        municip.innerHTML = '';
        municip.insertAdjacentHTML('beforeend', '<option value="3">Neiva</option>');
        municip.insertAdjacentHTML('beforeend', '<option value="4">Baraya</option>');
    }else if(dept.value == 3){
        municip.innerHTML = '';
        municip.insertAdjacentHTML('beforeend', '<option value="5">Leticia</option>');
        municip.insertAdjacentHTML('beforeend', '<option value="6">Puerto Nariño</option>');
    }else if(dept.value == 4){
        municip.innerHTML = '';
        municip.insertAdjacentHTML('beforeend', '<option value="7">Valledupar</option>');
        municip.insertAdjacentHTML('beforeend', '<option value="8">Aguachica</option>');
    }else if(dept.value == 5){
        municip.innerHTML = '';
        municip.insertAdjacentHTML('beforeend', '<option value="9">Espinal</option>');
        municip.insertAdjacentHTML('beforeend', '<option value="10">Ibague</option>');
    }else{
        municip.innerHTML = '';
        municip.insertAdjacentHTML('beforeend', '<option>Seleccione el municipio</option>');
    }
}
</script>