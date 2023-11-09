<form action="crm.php" method="POST" enctype="multipart/form-data">
                
			<?php if(isset($_SESSION['exitoCRM'])){?>
				<div class="row">
					<div class="col-4 alert alert-success" role="alert">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
							<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
							<path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
						</svg>
							<?php echo $_SESSION['exitoCRM']; ?>
					</div>
				</div>
			<?php unset($_SESSION['exitoCRM']); }
                if(isset($_SESSION['erroCRM'])){?>
                    <div class="col-4 alert alert-danger" role="alert">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
							<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
							<path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
						</svg>
							<?php echo $_SESSION['erroCRM']; ?>
					</div>
                <?php unset($_SESSION['erroCRM']); }?>
                <div class="row">
                    <div class="col">
                        <div class="col-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" value="<?php echo $titulo?>"  required="required" name="titulo">
                        </div>                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <label for="nombre" class="form-label">Nombre Completo</label>
                        <input type="text" value="<?php echo $nombre;?>" class="form-control"  required="required" name="nombre">
                    </div>
                    <div class="col-3">
                        <label for="correoElectronico" class="form-label">Correo Electronico</label>
                        <input type="email" class="form-control" value="<?php echo $correo;?>" required="required" name="correoElectronico">
                    </div>
                    <div class="col-auto">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="tel" class="form-control" value="<?php echo $telefono?>" required="required" name="telefono">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-auto">
                        <label for="dinero" class="form-label">Dinero</label>
                        <input type="number" min=0 class="form-control" step="any" value="<?php echo number_format($dinero, 2, '.', '') ?>"required="required" name="dinero">
                    </div>
                </div>
                <br>
                <!--<div class="row">
                  <div class="col-5">
                       <label for="archivos[]" class="form-label">Archivos</label>
                       <input type="file" class="form-control" name="archivos[]" id="archivos[]" multiple="">
                    </div>
                </div>
                <br>-->
                <div class="row">
                    <div class="col-5">
                        <label for="nota">Nota</label>
                        <textarea class="form-control"name="nota"><?php echo $nota?></textarea>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
