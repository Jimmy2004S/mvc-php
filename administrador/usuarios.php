<?php  include("../Datos/persona/ListarPersonas.php");?>

<?php 
    $accion = (isset($_POST["accion"]))? $_POST["accion"]: "";
    $codigo = (isset($_POST["codigo"]))? $_POST["codigo"]: "";

    switch($accion){
        case "Registrar":
            include("insertar.php");
            break;
        case "Eliminar":
            include("eliminar.php");
            break;
    }  
?>

<?php include("templateAdmin/navegacion.php"); ?>
       
    <section class="container mt-5 mb-5">
        <div class="table-responsive">
            <table class="table" id="tabla">
                <thead class="table-dark">
                    <tr>
                        <th> Codigo</th>
                        <th> Nombres </th>
                        <th> Tipo persona </th>
                        <th> Correo electronico </th>
                        <th> Telefono </th>
                        <th> Estado </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listaPersonas as $lista) { ?>
                    <tr>
                        <td> <?php  echo $lista['codigo'] ?> </td>
                        <td> <?php  echo $lista['nombre'] . ' ' . $lista['apellido'] ?> </td>
                        <td> <?php  echo $lista['tipo_persona'] ?></td>
                        <td> <?php  echo $lista['email'] ?> </td>
                        <td> <?php  echo $lista['telefono'] ?> </td>
                        <td> <?php  echo $lista['estado'] ?> </td>
                        <td>
                        <form method="POST">
                            <input type="hidden" name="codigo" value="<?php echo $lista['codigo']?>">
                            <input type="submit" class="btn btn-danger" name="accion" value="Activar">
                            <input type="submit" class="btn btn-primary" name="accion" value="Desactivar">
                        </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                </table>
        </div> 
    </section>
  
<?php include("../template/footer.php");