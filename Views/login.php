<?php  require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <main class="d-flex align-items-center justify-content-center height-100" >
        <div class="content">
            <h2>Iniciar Sesión</h2>

            <form action="<?php echo FRONT_ROOT ?>User/login" method="post" class="login-form bg-dark-alpha p-5 bg-light">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar email">
                </div>
                <div class="form-group">
                    <label for="pass">Contraseña</label>
                    <input type="password" name="pass" class="form-control form-control-lg" placeholder="Ingresar constraseña">
                </div>
                <button class="btn btn-primary btn-block btn-lg" type="submit">Iniciar Sesión</button>
           </form>
        </div>
    </main>
