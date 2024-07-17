<?php include '../resources/view/admin/template/head.php'; ?>
<?php include '../resources/view/admin/template/navegacion.php'; ?>
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
            </td>
        </tr>
    </template>
</div>

<?php include '../resources/view/template/footer.php'; ?>