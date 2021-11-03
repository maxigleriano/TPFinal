<?php require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <main class="d-flex align-items-center justify-content-center height-90" >
        <div class="content">
            <h2>Agregar Empresa</h2>

            <form action="<?php echo FRONT_ROOT ?>Company/add" method="post" class="login-form bg-dark-alpha p-5 bg-light">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Ingresar nombre" required>
                </div>
                <div class="form-group">
                    <label for="city">Ciudad</label>
                    <input type="text" name="city" class="form-control form-control-lg" placeholder="Ingresar ciudad" required>
                </div>
                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" name="address" class="form-control form-control-lg" placeholder="Ingresar dirección" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar email" required>
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Número de Telefono</label>
                    <input type="text" name="phoneNumber" class="form-control form-control-lg" placeholder="Ingresar número de telefono" required>
                </div>
                <div class="form-group">
                    <label for="cuit">CUIT</label>
                    <input type="number" name="cuit" class="form-control form-control-lg" placeholder="Ingresar CUIT" required>
                </div>
                <button class="btn btn-primary btn-block btn-lg" type="submit">Aceptar</button>
           </form>
        </div>
    </main>
