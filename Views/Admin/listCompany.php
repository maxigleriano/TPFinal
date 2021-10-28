<?php  require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <main>
        <div class="contenedor">
            <section id="listado" class="mb-5">
                <div class="container">
                    <h1 class="mb-4">EMPRESAS</h1>

                    <table class="table bg-light">
                        <thead class="bg-dark text-white">
                            <th>Nombre</th>
                            <th>Ciudad</th>
                            <th>Dirección</th>
                            <th>Email</th>
                            <th>Número de Teléfono</th>
                            <th>CUIT</th>
                            <th></th>
                            <th></th>
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
                            </tr>  
                            
                        <?php } ?>
                            
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        
    </main>
