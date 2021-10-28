<!-- Delete Modal -->

<div class="modal fade" id="deleteModal<?php echo $offer->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Alerta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que querés eliminar esta oferta?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

        <form action="<?php echo FRONT_ROOT ?>Offer/delete" method="post">
            <input type="hidden" name="id" value="<?php echo $offer->getId() ?>">
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modify Modal -->

<div class="modal fade" id="modifyModal<?php echo $offer->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modifyModalLabel">Modificar Oferta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?php echo FRONT_ROOT ?>Offer/modify" method="post">
        <div class="modal-body">
          <input type="hidden" name="id" value="<?php echo $offer->getId() ?>" required>

          <label for="company">Empresa</label>
          <select name="company" id="company" class="form-control form-control-lg" required>
            <option value="<?php echo $offer->getCompany()->getId() ?>"><?php echo $offer->getCompany()->getName() ?></option>

            <?php foreach($companyList as $company) { ?>
            
            <option value="<?php echo $company->getId() ?>"><?php echo $company->getName() ?></option>
            
            <?php } ?>

          </select>

          <label for="career">Carrera</label>
          <select name="career" id="career<?php echo $offer->getId() ?>"class="form-control form-control-lg" onchange="getPositions(<?php echo $offer->getId() ?>)" required>
            <option value="<?php echo $offer->getCareer()->getId() ?>"><?php echo $offer->getCareer()->getDescription() ?></option> 
                        
            <?php foreach($careerList as $career) { ?>
            
            <option value="<?php echo $career->getId() ?>"><?php echo $career->getDescription() ?></option>
            
            <?php } ?>
          </select>

          <?php $positionList = $this->positionDAO->getJobPositionsByCareer($offer->getCareer()->getId()) ?>

          <label for="position">Posición</label>
          <select name="position" id="position<?php echo $offer->getId() ?>" class="form-control form-control-lg" required>
            <option value="<?php echo $offer->getPosition()->getId() ?>"><?php echo $offer->getPosition()->getDescription() ?></option>

            <?php foreach($positionList as $position) { ?>
            
            <option value="<?php echo $position->getId() ?>"><?php echo $position->getDescription() ?></option>
            
            <?php } ?>
          </select>

          <label for="beginningDate">Fecha de Inicio</label>
          <input type="date" name="beginningDate" value="<?php echo $offer->getBeginningDate() ?>" class="form-control form-control-lg" required>

          <label for="endingDate">Fecha de Cierre</label>
          <input type="date" name="endingDate" value="<?php echo $offer->getEndingDate() ?>" class="form-control form-control-lg" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Aceptar</button>
        </div>
      </form>
    </div>
  </div>
</div>