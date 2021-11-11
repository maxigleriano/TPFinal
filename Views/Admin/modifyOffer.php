<?php require_once(VIEWS_PATH . "nav.php") ?>

<body>
    <main class="d-flex align-items-center justify-content-center height-90" >
        <div class="content">
            <h2 class="text-center">Modificar Oferta</h2>

            <form action="<?php echo FRONT_ROOT ?>Offer/modify" method="post" class="login-form bg-dark-alpha p-5 bg-light">
                <input type="hidden" name="id" value="<?php echo $offer->getId() ?>">
                <div class="form-group">
                    <label for="company">Empresa</label>
                    <select name="company" id="company" class="form-control form-control-lg" required>
                        <option selected value="<?php echo $company->getId() ?>"><?php echo $company->getName() ?></option>  
                        
                        <?php foreach($companyList as $company) { ?>
                            <option value="<?php echo $company->getId() ?>"><?php echo $company->getName() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="career">Carrera</label>
                    <select name="career" id="career"class="form-control form-control-lg" onchange="getPositions()" required>
                        <option selected value="<?php echo $career->getId() ?>"><?php echo $career->getDescription() ?></option>  
                        
                        <?php foreach($careerList as $career) { ?>
                            <option value="<?php echo $career->getId() ?>"><?php echo $career->getDescription() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="position">Posición</label>
                    <select name="position" id="position" class="form-control form-control-lg" required>
                        <option selected value="<?php echo $position->getId() ?>"><?php echo $position->getDescription() ?></option>  
                        
                        <?php foreach($positionList as $position) { ?>
                            <option value="<?php echo $position->getId() ?>"><?php echo $position->getDescription() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="beginningDate">Fecha de inicio</label>
                    <input type="date" name="beginningDate" value="<?php echo $offer->getBeginningDate() ?>" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <label for="endingDate">Fecha de cierre</label>
                    <input type="date" name="endingDate" value="<?php echo $offer->getEndingDate() ?>" class="form-control form-control-lg" required>
                </div>
                <button class="btn btn-primary btn-block btn-lg" type="submit">Aceptar</button>
           </form>
        </div>
    </main>

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
