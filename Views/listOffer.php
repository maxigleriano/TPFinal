<?php  require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <main>
        <section id="listado" class="mb-5">
            <div class="container mt-5">
                <h1 class="mb-4">OFERTAS LABORALES</h1>

                <table class="table bg-light">
                    <thead class="bg-dark text-white">
                        <th>Empresa</th>
                        <th>Carrera</th>
                        <th>Posición</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de cierre</th>
                        <?php if($this->userHelper->isAdmin()) { ?>
                            <th></th>
                            <th></th>
                            <th></th>
                        <?php } ?>
                        <?php if($this->userHelper->isStudent()) { ?>
                            <th></th>
                        <?php } ?>
                    </thead>
                    <tbody>

                    <?php foreach($offerList as $offer) { ?>

                        <tr>
                            <td><?php echo $offer->getCompany()->getName() ?></td>
                            <td><?php echo $offer->getCareer()->getDescription() ?></td>
                            <td><?php echo $offer->getPosition()->getDescription() ?></td>
                            <td><?php echo date("d/m/Y", strtotime($offer->getBeginningDate())) ?></td>
                            <td><?php echo date("d/m/Y", strtotime($offer->getEndingDate())) ?></td>
                            
                            <?php if($this->userHelper->isAdmin()) { ?>
                                <td>
                                    <form action="<?php echo FRONT_ROOT . "Postulation/listByOffer/" . $offer->getId() ?>" method="get">
                                        <button type="submit" class="btn btn-success btn-sm">Ver postulaciones</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="<?php echo FRONT_ROOT . "Offer/modifyView/" . $offer->getId() ?>">
                                        <button type="submit" class="btn btn-primary btn-sm">Modificar</button>
                                    </form>
                                </td>
                                <td>
                                    <!-- Button trigger delete modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $offer->getId() ?>">
                                        Eliminar
                                    </button>
                                </td>
                                <?php include(VIEWS_PATH . "Admin/modalOffer.php") ?>
                            <?php } ?>
                            
                            <?php if($this->userHelper->isStudent()) { ?>
                                <td>
                                    <form action="<?php echo FRONT_ROOT ?>Postulation/addView" method="post">
                                        <input type="hidden" name="offerId" value="<?php echo $offer->getId() ?>">
                                        <button type="submit" class="btn btn-primary btn-sm">Postularse</button>
                                    </form>
                                </td>
                            <?php } ?>
                        </tr>  
                        
                    <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script type="text/javascript">
        function getPositions(id) {
            document.getElementById("position"+id).innerHTML = "<option disabled selected value=''>Cargando opciones</option>";
            let career = document.getElementById("career"+id).value;

            $.ajax({
                url: "<?php echo FRONT_ROOT ?>Ajax/ajax.php",
                type: "POST",
                data: {career: career},
                success: function(response) {
                    $("#position"+id).html(response);
                }
            })
        }
    </script>
