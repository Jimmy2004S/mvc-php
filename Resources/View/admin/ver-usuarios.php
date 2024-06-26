<?php
$accion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$codigo = (isset($_POST["codigo"])) ? $_POST["codigo"] : "";

switch ($accion) {
    case "Registrar":
        include("insertar.php");
        break;
    case "Eliminar":
        include("eliminar.php");
        break;
}
?>

<?php include '../resources/view/admin/template/navegacion.php'; ?>
<!-- modal para mostrar informacion de usuario selecionado -->
<div class="modal" id="miModalA">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <form class="formulario-project" id="form-addProject" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="input-form">
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre..." required>
                        <input type="text" name="apellido" id="apellido" placeholder="Apellido..." required>
                        <input type="text" name="identificacion" id="identificacion" placeholder="identificacion..." required>
                        <input type="email" name="email" id="email" placeholder="Correo..." required>
                        <input type="text" name="telefono" id="telefono" placeholder="Telefono..." required>
                        <select name="tipoUsuario" id="tipous" onchange="inforTipoPersona();">
                            <option selected="true" disabled="disabled">seleccione tipo de usuario</option>
                            <option value="Profesor">Profesor</option>
                            <option value="Estudiante">Estudiante</option>
                        </select>
                        <div id="estudiante" class="desaparece">
                            <input type="text" id="carrera" placeholder="Carrera..." name="carrera">
                            <select name="semestre">
                                <option selected=" true" disabled="disabled">Semestre</option>
                                <?php for ($i = 0; $i < 11; $i++) { ?>
                                    <option value=" <?php echo $i ?> "> <?php echo $i ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="profesor" class="desaparece">
                            <input type="text" id="departamento" name="departamento" placeholder="Departamento...">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-btn d-flex flex-column" id="acciones-formProyect">
                        <input type="submit" name="accion" class="btn btn-primary" id="btn-modificar" value="Modificar">
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- tabla para mostrar usuarios -->
<section class="container mt-5 mb-5">
    <div class="table-responsive">
        <table class="table" id="tabla">
            <thead class="table-dark">
                <tr>
                    <th> Code</th>
                    <th> user_name </th>
                    <th> Role </th>
                    <th> Email </th>
                    <th> state </th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="personasINadmin">

            </tbody>
        </table>
    </div>
</section>

<div id="templates" style="display: none;">
    <!-- template para mostrar usuarios en fila -->
    <template id="user-template">
        <tr userId="{{id}}">
            <td>{{code}}</td>
            <td>{{user_name}}</td>
            <td>{{role}}</td>
            <td>{{email}}</td>
            <td>{{state}}</td>
            <td>
                <button class="state btn {{class}} w-80" id="btn">
                    {{text}}
                </button>
                <button type="button" class="ms-3 btn btn-outline-dark">
                    <i class="selecciona fa-solid fa-hand-pointer"></i>
                </button>
            </td>
        </tr>
    </template>
</div>

<?php include '../resources/view/admin/template/footer.php'; ?>