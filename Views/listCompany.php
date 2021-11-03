<?php  require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <main>
        <section id="listado" class="mb-5">
            <div class="container mt-5">
                <h1 class="mb-4">EMPRESAS</h1>

                <table class="table bg-light">
                    <thead class="bg-dark text-white">
                        <th>Nombre</th>
                        <th>Ciudad</th>
                        <th>Dirección</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>CUIT</th>
                        <th></th>
                        <?php if($this->isAdmin()) { ?>
                            <th></th>
                            <th></th>
                        <?php } ?>
                    </thead>
                    <tbody>
                        <?php foreach($companyList as $company) { ?>

                        <tr>
                            <td><?php echo $company->getName() ?></td>
                            <td><?php echo $company->getCity() ?></td>
                            <td><?php echo $company->getAddress() ?></td>
                            <td><?php echo $company->getEmail() ?></td>
                            <td><?php echo $company->getPhoneNumber() ?></td>
                            <td><?php echo $company->getCuit() ?></td>
                            <td>
                                <form action="<?php echo FRONT_ROOT . "Offer/listByCompany/" . $company->getId() ?>" method="get">
                                    <button type="submit" class="btn btn-success btn-sm">Ver ofertas</button>
                                </form>
                            </td>
                            <?php if($this->isAdmin()) { ?>
                                <td>
                                    <!-- Button trigger modify modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modifyModal<?php echo $company->getId() ?>">
                                        Modificar
                                    </button>
                                </td>
                                <td>
                                    <!-- Button trigger delete modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $company->getId() ?>">
                                        Eliminar
                                    </button>
                                </td>
                                <?php include(VIEWS_PATH . "Admin/modalCompany.php") ?>
                            <?php } ?>
                        </tr>  
                            
                    <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </section>
    </main>
