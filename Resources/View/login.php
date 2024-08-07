<?php include '../resources/view/template/head.php'; ?>
<body class="container-fluid">
    <div>
        <main class="main d-flex justify-content-center">
            <form class="form w-60 mt-5" id="form-login">
                <h2 id="login">Login</h2>
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email..." required>
                <input type="password" name="clave" class="form-control" id="floatingPassword" placeholder="Clave..." required>
                <button type="submit" class="btn btn-outline-primary">Login</button>
                <p>You are not registered? <a href="register">Register</a></p>
            </form>
        </main>
<?php include '../resources/view/template/footer.php'; ?>