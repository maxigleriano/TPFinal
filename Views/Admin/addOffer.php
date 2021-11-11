<?php  require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <div class="container">
        <div class="text-center mt-5">
            <h1>Agregar Oferta</h1>
            <form action="<?php echo FRONT_ROOT ?>Offer/add" method="post" class="w-50 m-auto mt-4 bg-dark-alpha p-5 bg-light border border-dark rounded">
                <div class="">
                    <label for="company" class="form-label">Empresa</label>
                    <select name="company" id="company" class="form-control form-control-lg" required>
                        <option disabled selected value="">Seleccione una</option>
                        <?php foreach($companyList as $company) { ?>
                            <option value="<?php echo $company->getId() ?>"><?php echo $company->getName() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="career" class="form-label">Carrera</label>
                    <select name="career" id="career"class="form-control form-control-lg" onchange="getPositions()" required>
                        <option disabled selected value="">Seleccione una</option>  
                        
                        <?php foreach($careerList as $career) { ?>
                            <option value="<?php echo $career->getId() ?>"><?php echo $career->getDescription() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="position" class="form-label">Posición</label>
                    <select name="position" id="position" class="form-control form-control-lg" required>
                        <option disabled selected value="">--------------------</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="beginningDate" class="form-label">Fecha de Inicio</label>
                    <input type="date" name="beginningDate" class="form-control form-control-lg" required>
                </div>
                <div class="mt-3">
                    <label for="endingDate" class="form-label">Fecha de Cierre</label>
                    <input type="date" name="endingDate" class="form-control form-control-lg" required>
                </div>
                <button class="btn btn-dark mt-4" type="submit">Aceptar</button>
           </form>
        </div>
    </div>

    <script type="text/javascript">
        function getPositions() {
            document.getElementById("position").innerHTML = "<option disabled selected value=''>Cargando opciones</option>";
            let career = document.getElementById("career").value;

            $.ajax({
                url: "<?php echo FRONT_ROOT ?>Ajax/ajax.php",
                type: "POST",
                data: {career: career},
                success: function(response) {
                    $("#position").html(response);
                }
            })
        }
    </script>
