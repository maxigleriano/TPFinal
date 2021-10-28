<?php  require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <main>
        <div class="contenedor">
            <section id="listado" class="mb-5">
                <div class="container">
                    <h1 class="mb-4">OFERTAS LABORALES</h1>

                    <table class="table bg-light">
                        <thead class="bg-dark text-white">
                            <th>Empresa</th>
                            <th>Carrera</th>
                            <th>Posición</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de cierre</th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>

                        <?php foreach($offerList as $offer) { ?>

                            <tr>
                                <td><?php echo $offer->getCompany()->getName() ?></td>
                                <td><?php echo $offer->getCareer()->getDescription() ?></td>
                                <td><?php echo $offer->getPosition()->getDescription() ?></td>
                                <td><?php echo date("d/m/Y", strtotime($offer->getBeginningDate())) ?></td>
                                <td><?php echo date("d/m/Y", strtotime($offer->getEndingDate())) ?></td>
                                <td>
                                    <!-- Button trigger modify modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modifyModal<?php echo $offer->getId() ?>">
                                        Modificar
                                    </button>
                                </td>
                                <td>
                                    <!-- Button trigger delete modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $offer->getId() ?>">
                                        Eliminar
                                    </button>
                                </td>
                                <?php include(VIEWS_PATH . "Admin/modalOffer.php") ?>
                            </tr>  
                            
                        <?php } ?>
                            
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
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
