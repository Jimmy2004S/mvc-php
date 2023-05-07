
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
                <tbody id="personasINadmin">
                </tbody>
                </table>
        </div> 
    </section>
  
<?php include("../template/footer.php");