<?php require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <main class="d-flex align-items-center justify-content-center height-100" >
        <div class="content">
            <h2>Registrase</h2>

            <form action="<?php echo FRONT_ROOT ?>User/addNewUser" method="post" class="login-form bg-dark-alpha p-5 bg-light">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar email" required>
                </div>
                <div class="form-group">
                    <label for="pass1">Contraseña</label>
                    <input type="password" name="pass1" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
                </div>
                <div class="form-group">
                    <label for="pass2">Repetir Contraseña</label>
                    <input type="password" name="pass2" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
                </div>
                <button class="btn btn-primary btn-block btn-lg" type="submit">Aceptar</button>
           </form>
        </div>
    </main>
