<?php  require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <div class="container">
        <div class="text-center mt-5">
            <h1>Agregar Empresa</h1>
            <form action="<?php echo FRONT_ROOT ?>Company/add" method="post" class="w-50 m-auto mt-4 bg-dark-alpha p-5 bg-light border border-dark rounded">
                <div class="">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Ingresar nombre" required>
                </div>
                <div class="mt-3">
                    <label for="city" class="form-label">Ciudad</label>
                    <input type="text" name="city" class="form-control form-control-lg" placeholder="Ingresar ciudad" required>
                </div>
                <div class="mt-3">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" name="address" class="form-control form-control-lg" placeholder="Ingresar dirección" required>
                </div>
                <div class="mt-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar email" required>
                </div>
                <div class="mt-3">
                    <label for="phoneNumber" class="form-label">Número de Telefono</label>
                    <input type="text" name="phoneNumber" class="form-control form-control-lg" placeholder="Ingresar número de telefono" required>
                </div>
                <div class="mt-3">
                    <label for="cuit" class="form-label">CUIT</label>
                    <input type="number" name="cuit" class="form-control form-control-lg" max="99999999999" placeholder="Ingresar CUIT" required>
                </div>
                <button class="btn btn-dark mt-4" type="submit">Aceptar</button>
           </form>
        </div>
    </div>