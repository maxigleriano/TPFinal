<nav>
    <?php if(isset($_SESSION["loggedUser"])) { 
        if($_SESSION["loggedUser"]->getRole() == 1) { ?>
            <a href="<?php echo FRONT_ROOT ?>Home/Index">Inicio</a>
            <a href="#">Administración</a>
            <a href="<?php echo FRONT_ROOT ?>User/logout">Salir</a>
        <?php } else { ?>
            <a href="<?php echo FRONT_ROOT ?>Home/Index">Inicio</a>
            <a href="<?php echo FRONT_ROOT ?>User/logout">Salir</a>
        <?php } ?>
    <?php } else { ?>
        <a href="<?php echo FRONT_ROOT ?>Home/Index">Inicio</a>
        <a href="<?php echo FRONT_ROOT ?>User/signup">Registrarse</a>
    <?php } ?>
</nav>