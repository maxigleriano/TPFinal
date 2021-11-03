<?php  require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <main>
        <div class="contenedor">
            <section id="listado" class="mb-5">
                <div class="container">
                    <h1 class="mb-4">POSTULACIONES</h1>

                    <table class="table bg-light">
                        <thead class="bg-dark text-white">
                            <th>Empresa</th>
                            <th>Puesto</th>
                            <th>Postulante</th>
                            <th>Curriculum</th>
                            <th>Mensaje</th>
                        </thead>
                        <tbody>

                        <?php foreach($postulationList as $postulation) { ?>

                            <tr>
                                <td><?php echo $postulation->getOffer()->getCompany()->getName() ?></td>
                                <td><?php echo $postulation->getOffer()->getPosition()->getDescription() ?></td>
                                <td><a href="<?php echo FRONT_ROOT . "Student/studentInfo/" . $postulation->getUser()->getEmail()?>" target="_blank"><?php echo $postulation->getUser()->getNameAndLast() ?></a></td>
                                <td><a href="<?php echo UPLOADS_PATH . $postulation->getCurriculum()?>" download target="_blank"><?php echo $postulation->getCurriculum() ?></a></td>
                                <td><?php echo $postulation->getMessage() ?></td>                           
                            </tr>  
                            
                        <?php } ?>
                            
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
