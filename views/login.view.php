<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet-Stylo</title>
    <!-- Styles -->
    <link rel="stylesheet" href="assets/david/css/styles.css">
    <style>
        .bg{
            background-image: url(assets/david/img/imgLog.jpg);
            background-position: center center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<header>
    <?php include 'partials/header.php'?>
</header>   
<body>
    <h1>Soy el Login</h1>
    <main>
        <div class="container w-75 rounded shadow login mt-4 mb-4">
            <div class="row align-items-stretch">
                <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">

                </div>
                <div class="col p-5 rounded-end">
                    <div class="text-end">
                        <img src="assets/david/img/tienda-en-linea.png" width="70" alt="">
                    </div>
                    <h2 class="fw-bold text-center py-5">Bienvenido</h2>
                    <?php
                    if (!empty($message)) : ?>
                        <p><?= $message ?></p>
                    <?php endif;?>
                    <!--Login-->
                    <form action="login.php" method="post">
                        <div class="mb-4">
                            <label for="email" class="form-label">Correo Electronico</label>
                            <input type="email" class="form-control" name="email" id="">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="">
                        </div>
                        <div class="mb-4 form-check" >
                            <input type="checkbox" name="connected" class="form-check-input" id="">
                            <label for="connected" class="form-check-label">Mantenerme Conectado</label>
                        </div>
                        <div class="d-grid">
                            <button style="background-color: #70d0df;" type="submit" class="btn btn-primary">Iniciar Sesion</button>
                        </div>
                        <div class="my-3">
                            <span>No tienes cuenta? <a href="?c=Landing&a=registro">Registrate</a></span><br>
                            <span><a href="#">Recuperar Contraseña</a></span>
                        </div>
                    </form>
                    <!--Login con cuentas-->
                    <div class="container w-100 my-5" >
                        <div class="row text-center">
                            <div class="col-12">O inicia sesion con</div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-outline-primary w-100 my-1">
                                    <div class="row align-items-center">
                                        <div class="col-2 d-none d-md-block">
                                            <img src="assets/david/img/Redes/facebook.png" width="32px" alt="">
                                        </div>
                                        <div class="col-12 text-center col-md-10">
                                            Facebook
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div class="col">
                                <button class="btn btn-outline-danger w-100 my-1">
                                    <div class="row align-items-center">
                                        <div class="col-2 d-none d-md-block">
                                            <img src="assets/david/img/Redes/google.png" width="32px" alt="">
                                        </div>
                                        <div class="col-12 text-center col-md-10">
                                            Google
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<!-- Scripts -->
<script src="js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- <script src="assets/david/js/scripts.js"></script> -->
</body>
<footer>
    <?php include 'partials/footer.php'?>
</footer>
</html>