<?php  require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <main>
        <section id="listado" class="mb-5">
            <div class="container mt-5">
                <h1 class="mb-4 text-center">POSTULACIONES</h1>

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
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $postulation->getId() ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                        </svg>
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
