<?php include("bd.php"); ?>

<?php include('includes/header.php'); ?>

    <main class="container p-4">
    <div class="row">
    <div class="col-md-4">

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php session_unset(); } ?>

    <div class="card card-body">
        <form action="./crud/agregar.php" method="POST">
            <div class="form-group">
                <label for="tipo_documento">Seleccione el tipo de documento del paciente:</label>
                <select name="tipo_documento" class="form-control" id="tipo_documento" required>
                    <option value="0">Seleccione el tipo de documento</option>
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
                <input type="text" name="num_documento" class="form-control" placeholder="N° de documento" autofocus required>
            </div>
            <div class="form-group">
                <label for="nombre1">Escriba el primer nombre del paciente:</label>
                <input name="nombre1" class="form-control" placeholder="Primer nombre" required></input>
            </div>
            <div class="form-group">
                <label for="nombre2">Escriba el segundo nombre del paciente:</label>
                <input name="nombre2" class="form-control" placeholder="Segundo nombre" required></input>
            </div>
            <div class="form-group">
                <label for="apellido1">Escriba el primer apellido del paciente:</label>
                <input name="apellido1" class="form-control" placeholder="Primer apellido" required></input>
            </div>
            <div class="form-group">
                <label for="apellido2">Escriba el segundo apellido del paciente:</label>
                <input name="apellido2" class="form-control" placeholder="Segundo apellido" required></input>
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
                <input type="submit" name="save_pacient" class="btn btn-success btn-block" value="Guardar" onclick="validar_cbx();">
        </form>
    </div>
    </div>
    <div class="col-md-8">
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo Documento</th>
                <th>N° Documento</th>
                <th>Nombre 1</th>
                <th>Nombre 2</th>
                <th>Apellido 1</th>
                <th>Apellido 2</th>
                <th>Genero</th>
                <th>Departamento</th>
                <th>Municipio</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $query = "SELECT paciente.id, tipos_documento.nombre AS td_nom, numero_documento, nombre1, nombre2, apellido1, apellido2, genero.nombre as gen_nom, departamentos.nombre as dep_nom, municipios.nombre FROM paciente
                    INNER JOIN tipos_documento ON paciente.tipo_documento_id = tipos_documento.id
                    INNER JOIN genero ON paciente.genero_id = genero.id
                    INNER JOIN departamentos ON paciente.departamento_id = departamentos.id
                    INNER JOIN municipios ON paciente.municipio_id = municipios.id
                    ORDER BY paciente.id ASC";
        $result_tasks = mysqli_query($conn, $query);    

        while($row = mysqli_fetch_assoc($result_tasks)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['td_nom']; ?></td>
            <td><?php echo $row['numero_documento']; ?></td>
            <td><?php echo $row['nombre1']; ?></td>
            <td><?php echo $row['nombre2']; ?></td>
            <td><?php echo $row['apellido1']; ?></td>
            <td><?php echo $row['apellido2']; ?></td>
            <td><?php echo $row['gen_nom']; ?></td>
            <td><?php echo $row['dep_nom']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td>
            <a href="./crud/editar.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
            </a>
            <a href="./crud/eliminar.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
            </a>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
</div>
<script src="./js/main.js"></script>
</main>
<?php include('includes/footer.php'); ?>