<?php require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <main class="d-flex align-items-center justify-content-center height-100" >
        <div class="content">
            <h2>Agregar Postulación</h2>

            <form action="<?php echo FRONT_ROOT ?>Postulation/add" method="post" enctype="multipart/form-data" class="login-form bg-dark-alpha p-5 bg-light">
                <input type="hidden" name="offer" value="<?php echo $offer->getId() ?>" required>
                <div class="form-group">
                    <label for="">Empresa</label>
                    <span class="form-control form-control-lg"><?php echo $offer->getCompany()->getName() ?></span>
                </div><div class="form-group">
                    <label for="">Posición</label>
                    <span class="form-control form-control-lg"><?php echo $offer->getPosition()->getDescription() ?></span>
                </div>
                <div class="form-group">
                    <label for="curriculum">Curriculum</label>
                    <input type="file" name="curriculum" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <input type="text" name="message" class="form-control form-control-lg" placeholder="Ingresar mensaje">
                </div>
                <button class="btn btn-primary btn-block btn-lg" type="submit">Aceptar</button>
           </form>
        </div>
    </main>
