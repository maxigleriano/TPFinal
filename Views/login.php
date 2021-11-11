<?php  require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <div class="container">
        <div class="text-center mt-5">
            <h1>Iniciar Sesión</h1>
            <form action="<?php echo FRONT_ROOT ?>User/login" method="post" class="w-50 m-auto mt-4 bg-dark-alpha p-5 bg-light border border-dark rounded">
                <div class="">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar email">
                </div>
                <div class="mt-4">
                    <label for="pass" class="form-label">Contraseña</label>
                    <input type="password" name="pass" class="form-control form-control-lg" placeholder="Ingresar constraseña">
                </div>
                <button class="btn btn-dark mt-4" type="submit">Iniciar Sesión</button>
           </form>
        </div>
    </div>