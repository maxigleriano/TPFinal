<!-- Delete Modal -->

<div class="modal fade" id="deleteModal<?php echo $company->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Alerta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que querés eliminar esta empresa?
        <br>
        <?php echo $company->getName() ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

        <form action="<?php echo FRONT_ROOT ?>Company/delete" method="post">
            <input type="hidden" name="id" value="<?php echo $company->getId() ?>">
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modify Modal -->

<div class="modal fade" id="modifyModal<?php echo $company->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modifyModalLabel">Modificar Empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="<?php echo FRONT_ROOT ?>Company/modify" method="post">
        <div class="modal-body">
          <input type="hidden" name="id" value="<?php echo $company->getId() ?>" required>

          <label for="name">Nombre</label>
          <input type="text" name="name" value="<?php echo $company->getName() ?>" class="form-control form-control-lg" required>

          <label for="city">Ciudad</label>
          <input type="text" name="city" value="<?php echo $company->getCity() ?>" class="form-control form-control-lg" required>

          <label for="address">Dirección</label>
          <input type="text" name="address" value="<?php echo $company->getAddress() ?>" class="form-control form-control-lg" required>

          <label for="email">Email</label>
          <input type="email" name="email" value="<?php echo $company->getEmail() ?>" class="form-control form-control-lg" required>

          <label for="phoneNumber">Teléfono</label>
          <input type="text" name="phoneNumber" value="<?php echo $company->getPhoneNumber() ?>" class="form-control form-control-lg" required>

          <label for="cuit">CUIT</label>
          <input type="text" name="cuit" value="<?php echo $company->getCuit() ?>" class="form-control form-control-lg" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Aceptar</button>
        </div>
      </form>
    </div>
  </div>
</div>