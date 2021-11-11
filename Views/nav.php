<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo FRONT_ROOT ?>Home/Index">Trabajos UTN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <?php if($this->userHelper->isLogged()) { 
                if($this->userHelper->isAdmin()) { ?>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo FRONT_ROOT ?>Home/adminView">Inicio</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Menu</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT ?>User/signup">Registrar Usuario</a></li>
                            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT ?>User/logout">Salir</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo FRONT_ROOT . "Student/studentInfo/" . $_SESSION["loggedUser"]->getEmail() ?>">Inicio</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Menu</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT ?>Company/list">Empresas</a></li>
                            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT . "Offer/listByCareer/" . $_SESSION["student"]->getCareer() ?>">Ofertas</a></li>
                            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT . "Postulation/listByUser/" . $_SESSION["loggedUser"]->getId() ?>">Mis Postulaciones</a></li>
                            <li><a class="dropdown-item" href="<?php echo FRONT_ROOT ?>User/logout">Salir</a></li>
                        </ul>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo FRONT_ROOT ?>Home/Index">Inicio</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo FRONT_ROOT ?>User/signup">Registrarse</a></li>
            <?php } ?>
            </ul>
        </div>
    </div>
</nav>