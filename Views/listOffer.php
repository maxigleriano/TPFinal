<?php  require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <main>
        <section id="listado" class="mb-5">
            <div class="container mt-5">
                <h1 class="mb-4 text-center">OFERTAS LABORALES</h1>

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
                                        <button type="submit" class="btn btn-outline-info btn-sm">Ver postulaciones</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="<?php echo FRONT_ROOT . "Offer/modifyView/" . $offer->getId() ?>">
                                        <button type="submit" class="btn btn-outline-primary btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <!-- Button trigger delete modal -->
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $offer->getId() ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                        </svg>
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
