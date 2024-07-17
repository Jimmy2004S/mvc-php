<?php include '../resources/view/template/head.php'; ?>
<body>
    <div>
        <main class="main d-flex justify-content-center row">
            <form class="form w-50 mt-5" id="form-login">
                <h2 id="login">Login</h2>
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email..." required>
                <input type="password" name="clave" class="form-control" id="floatingPassword" placeholder="Clave..." required>
                <button type="submit" class="btn btn-primary mt-3">Login</button>
                <hr>
                <p>You are not registered? <a href="register">Register</a></p>
            </form>
        </main>
<?php include '../resources/view/template/footer.php'; ?>