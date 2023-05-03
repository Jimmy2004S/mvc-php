<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/register.css">
    
</head>
<body>
    <?php  include("../Datos/grupos/listar.php") ?>
<form action="" method="post">
        <h2>Register</h2>
        <p>Crea una <span>cuenta</span> para acceder a las funciones de la aplicación</p>
        <input type="text" name="nombreProyecto" id="nombreProyecto" placeholder="Nombre del proyecto..." required>
        <input type="email" name="Descripcion" id="Descripcion" placeholder="Describe tu proyecto..." required>
        <select name="codigoGrupo" id="">
            <option selected="true" disabled="disabled">seleccione un grupo</option>
            <?php foreach ($listaCodigoGrupo as $grupos) {?>
                <option value="">  <?php echo $grupos['codigo'] ?> </option>
            <?php } ?>
        </select>
        <div class="form-group">
            <label for="formFile" class="form-label mt-4">Adjunta tu proyecto</label>
            <input class="form-control" type="file" id="formFile">
        </div>
        <button id="reg-btn">Registrar</button>
    </form>
</body>
</html>