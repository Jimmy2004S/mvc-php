<?php include("../template/navegacion.php") ?>
            <div class="row my-5 container-fluid">
                <div class="col-7">
                    <form action="" method="POST" id="form-addGrupo">
                        <input type="text" id="nombreGrupo" value="">
                        <input type="submit" value="Agregar">
                    </form>
                </div>
                <div class="col-5">
                    <table>
                        <thead>
                            <tr>
                                <th>Codigo Persona </th>
                                <th>Nombre Persona</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row my-4 container">
                <div class="col-12">
                    <div class="card border-warning mb-3" style="max-width: 20rem;">
                        <div class="card-header">Header</div>
                            <div class="card-body">
                                <h4 class="card-title">Warning card title</h4>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                    </div>
                </div>
            </div>
<?php include("../template/footer.php") ?>