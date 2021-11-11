<?php require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <div class="container">
        <div class="text-center mt-5">
            <h1>Agregar Postulación</h1>
            <form action="<?php echo FRONT_ROOT ?>Postulation/add" method="post" enctype="multipart/form-data" class="w-50 m-auto mt-4 bg-dark-alpha p-5 bg-light border border-dark rounded">
            <input type="hidden" name="offer" value="<?php echo $offer->getId() ?>" required>    
            <div class="">
                    <label for="" class="form-label">Empresa</label>
                    <span class="form-control form-control-lg"><?php echo $offer->getCompany()->getName() ?></span>
                </div>
                <div class="mt-3">
                    <label for="" class="form-label">Posición</label>
                    <span class="form-control form-control-lg"><?php echo $offer->getPosition()->getDescription() ?></span>
                </div>
                <div class="mt-3">
                    <label for="curriculum" class="form-label">Curriculum</label>
                    <input type="file" name="curriculum" class="form-control form-control-lg" required>
                </div>
                <div class="mt-3">
                    <label for="message" class="form-label">Mensaje</label>
                    <input type="text" name="message" class="form-control form-control-lg" placeholder="Ingresar mensaje">
                </div>
                <button class="btn btn-dark mt-4" type="submit">Aceptar</button>
           </form>
        </div>
    </div>