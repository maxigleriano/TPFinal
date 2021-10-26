<?php  require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <main>
        <h1>INDEX PAGE</h1>

        <?php if(isset($student)) { ?>

        <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">ALUMNO</h2>

               <table class="table bg-light">
                    <thead class="bg-dark text-white">
                        <th>ID</th>
                        <th>Carrera</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Legajo</th>
                        <th>Genero</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Telefono</th>
                        <th>Activo</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $student->getStudentId() ?></td>
                            <td><?php echo $student->getCareer()->getDescription() ?></td>
                            <td><?php echo $student->getName() ?></td>
                            <td><?php echo $student->getLastName() ?></td>
                            <td><?php echo $student->getDni() ?></td>
                            <td><?php echo $student->getFileNumber() ?></td>
                            <td><?php echo $student->getGender() ?></td>
                            <td><?php echo $student->getBirthDate() ?></td>
                            <td><?php echo $student->getPhoneNumber() ?></td>
                            <td><?php echo $student->getActive() ? 'Si' : 'No' ?></td>
                        </tr>                     
                    </tbody>
                </table>
            </div>
        </section>

        <?php } ?>

    </main>
</body>