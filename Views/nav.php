<nav>
    <?php if(isset($_SESSION["loggedUser"])) { 
        if($_SESSION["loggedUser"]->getRole() == 1) { ?>
            <a href="<?php echo FRONT_ROOT ?>Home/adminView">Administración</a>
            <a href="<?php echo FRONT_ROOT ?>User/signup">Registrar Usuario</a>
            <a href="<?php echo FRONT_ROOT ?>User/logout">Salir</a>
        <?php } else { ?>
            <a href="<?php echo FRONT_ROOT . "Student/studentInfo/" . $_SESSION["loggedUser"]->getEmail() ?>">Información</a>
            <a href="<?php echo FRONT_ROOT ?>Company/list">Empresas</a>
            <a href="<?php echo FRONT_ROOT . "Offer/listByCareer/" . $_SESSION["student"]->getCareer() ?>">Ofertas</a>
            <a href="<?php echo FRONT_ROOT . "Postulation/listByUser/" . $_SESSION["loggedUser"]->getId() ?>">Mis Postulaciones</a>
            <a href="<?php echo FRONT_ROOT ?>User/logout">Salir</a>
        <?php } ?>
    <?php } else { ?>
        <a href="<?php echo FRONT_ROOT ?>Home/Index">Inicio</a>
        <a href="<?php echo FRONT_ROOT ?>User/signup">Registrarse</a>
    <?php } ?>
</nav>