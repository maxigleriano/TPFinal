<?php  require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <div class="container">
        <div class="text-center mt-5">
            <h1>Registrarse</h1>
            <form action="<?php echo FRONT_ROOT ?>User/addNewUser" method="post" class="w-50 m-auto mt-4 bg-dark-alpha p-5 bg-light border border-dark rounded">
                <div class="">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar email" required>
                </div>
                <div class="mt-4">
                    <label for="pass1" class="form-label">Contraseña</label>
                    <input type="password" name="pass1" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
                </div>
                <div class="mt-4">
                    <label for="pass2" class="form-label">Repetir Contraseña</label>
                    <input type="password" name="pass2" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
                </div>
                <?php if($this->userHelper->isAdmin()) { ?>
                    <input type="hidden" name="role" value="1" required>
                <?php } ?>
                <button class="btn btn-dark mt-4" type="submit">Aceptar</button>
           </form>
        </div>
    </div>