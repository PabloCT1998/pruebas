
<div class="modal fade" id="modalUtilidad" tabindex="-1" aria-labelledby="modalUtilidad" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">EDITAR UTILIDAD</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="actualizarParametros.php" method="post">
        <div class="modal-body">
            <label for="utilidad" class="col-form-label">% UTILIDAD</label>
            <input type="number" class="form-control" name="utilidad" id="utilidad" min="0" step="any" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
          <button type="submite" class="btn btn-primary">GUARDAR</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modalComision" tabindex="-1" aria-labelledby="modalComision" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">EDITAR COMISIÓN</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="actualizarParametros.php" method="post">
        <div class="modal-body">
            <label for="utilidad"class="col-form-label">% COMISIÓN</label>
            <input type="number" class="form-control" name="comision" id="comision" min="0" step="any" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
          <button type="submite" class="btn btn-primary">GUARDAR</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modalDolar" tabindex="-1" aria-labelledby="modalDolar" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">EDITAR VALOR DÓLAR</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="actualizarParametros.php" method="post">
        <div class="modal-body">
            <label for="dollar">VALOR DÓLAR</label>
            <input type="number" class="form-control" name="dollar" id="dollar" min="0" step="any" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
          <button type="submite" class="btn btn-primary">GUARDAR</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php if($crm == 0){?>
<div class="modal fade" id="modalCRM" tabindex="-1" aria-labelledby="modalCRM" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">CRM</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="activarCRM.php" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="col-auto">
              <label for="crm">Seleccione el CRM</ñlabel>
            </div>
            <div class="row">
              <div class="col-auto">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="crm" id="pipedrive" required value="Piepedrive">
                  <label class="form-check-label" for="crm">Pipedrive</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="crm" id="hubspot" required value="Hubspot">
                  <label class="form-check-label" for="crm">Hubspot</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-auto">
                <label for="token">Token</label>
                <input type="text" class="form-control" name="token" id="token" required>
              </div>
            </div>
            <div class="row">
              <div class="col-auto">
                <label for="dominio">Dominio</label>
                <input type="text" class="form-control" name="dominio" id="dominio" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
            <button type="submite" class="btn btn-primary">SI</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } else if($crm == 1){?>
<div class="modal fade" id="modalCRM" tabindex="-1" aria-labelledby="modalCRM" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">CRM</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php echo ($crm == 1) ? '<label for="crm">¿QUIERE DESACTIVAR EL CRM?</label>'  : '<label for="dollar">QUIERE ACTIVAR EL CRM?</label>'?>
      </div>
      <div class="modal-footer">
        <form action="desactivarCRM.php" method="post">
          <input type="hidden" name="crm" id="crm" value="<?php echo $crm ?>">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
          <button type="submite" class="btn btn-primary">SI</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="token" tabindex="-1" aria-labelledby="token" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">TOKEN</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="actualizarParametrosCRM.php" method="post">
        <div class="modal-body">
            <label for="token">EDITAR TOKEN</label>
            <input type="text" class="form-control" name="token" id="token" required>
            <?php if($pipedriveActivo == 1 && $hubspotActivo == 0){?>
              <input type="hidden" class="form-control" name="crm" value="Pipedrive" >
            <?php }else if($pipedriveActivo == 0 && $hubspotActivo == 1){?>
              <input type="hidden" class="form-control" name="crm" value="Hubspot" >
            <?php }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
          <button type="submite" class="btn btn-primary">GUARDAR</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php }?>
<?php if($pipedriveActivo == 1){?>
<div class="modal fade" id="dominio" tabindex="-1" aria-labelledby="dominio" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">DOMINIO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="actualizarParametros.php" method="post">
        <div class="modal-body">
            <label for="dominio">EDITAR DOMINIO</label>
            <input type="text" class="form-control" name="dominio" id="dominio" step="any" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
          <button type="submite" class="btn btn-primary">GUARDAR</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php }?>