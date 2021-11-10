<?php  require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <main>
        <section id="listado" class="mb-5">
            <div class="container mt-5">
                <h1 class="mb-4">POSTULACIONES</h1>

                <table class="table bg-light">
                    <thead class="bg-dark text-white">
                        <th>Empresa</th>
                        <th>Puesto</th>
                        <th>Postulante</th>
                        <th>Curriculum</th>
                        <th>Mensaje</th>
                        <?php if($this->userHelper->isStudent()) { ?>
                            <th></th>
                        <?php } ?>
                    </thead>
                    <tbody>

                    <?php foreach($postulationList as $postulation) { ?>

                        <tr>
                            <td><?php echo $postulation->getOffer()->getCompany()->getName() ?></td>
                            <td><?php echo $postulation->getOffer()->getPosition()->getDescription() ?></td>
                            <td><a href="<?php echo FRONT_ROOT . "Student/studentInfo/" . $postulation->getUser()->getEmail()?>" target="_blank"><?php echo $postulation->getUser()->getNameAndLast() ?></a></td>
                            <td><a href="<?php echo UPLOADS_PATH . $postulation->getCurriculum()?>" download target="_blank"><?php echo $postulation->getCurriculum() ?></a></td>
                            <td><?php echo $postulation->getMessage() ?></td>
                            <?php if($this->userHelper->isStudent()) { ?>
                                <td>
                                    <!-- Button trigger delete modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $postulation->getId() ?>">
                                        Eliminar
                                    </button>
                                </td>
                                <?php include(VIEWS_PATH . "modalPostulation.php") ?>
                            <?php } ?>                       
                        </tr>  
                            
                    <?php } ?>
                            
                    </tbody>
                </table>
            </div>
        </section>
    </main>
