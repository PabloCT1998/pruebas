
<table  id="tablax" class="table table-striped table-bordered text-center">
						<thead style="background-color: #003a70;" >
          				<tr>
							<th class="text-center text-light">MATERIAL</th>
                            <th class="text-center text-light">NÚMERO</th>
							<th class="text-center text-light">COSTO USCy</th>
                            <th class="text-center text-light">PRECIO</th>
          				</tr>
						</thead>
						<tbody>
							<tr>
								<td class="">CELDAS</td>
                                <td class="col-2"><?php echo $_SESSION['numPiezas']?></td>
                                <td class="col-4">
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<select class="form-select " aria-label="Default select example" name="panelPrecio" id="panelPrecio" required>
												<option value="">CELDAS</option>
													<?php 
														foreach($paneles as $i){
															if($precioNum['panel'] == $i['ProductoID']){
														?>
																<option selected value="<?php echo $i['ProductoID']?>"> <?php echo $i['Modelo'].'&nbsp; $'. number_format($i['Precio'], 2, '.', ',')?></option>
													<?php }else{?>
												<option value="<?php echo $i['ProductoID']?>"> <?php echo $i['Modelo'].'&nbsp; $'. number_format($i['Precio'], 2, '.', ',')?></option>
														<?php }}?>
												</select>
										</div>
									</div>
								</td>
								<td class=" col-2 text-end">
									<?php echo llaveDefinida('celdas', $precios) ? '$'.number_format($precios['celdas'], 2, '.', ',') : '$-';?>
								</td>
							</tr>
                            <tr>
								<td>INVERSORES</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any" min=0 value="<?php echo $numProducto['inversores']?>" name="inversoresNum" id="inversoresNum" class="form-control" required>
										</div>
									</div>
								</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<select class="form-select " aria-label="Default select example" name="inversoresPrecio" id="inversoresPrecio" required>
												<option value="">INVERSORES</option>
													<?php 
														foreach($inversores as $i){
															if($precioNum['inversores'] == $i['ProductoID']){
														?>
																<option selected value="<?php echo $i['ProductoID']?>"> <?php echo $i['Modelo'].'&nbsp; $'. number_format($i['Precio'], 2, '.', ',')?></option>
													<?php }else{?>
												<option value="<?php echo $i['ProductoID']?>"> <?php echo $i['Modelo'].'&nbsp; $'. number_format($i['Precio'], 2, '.', ',')?></option>
														<?php }}?>
												</select>
										</div>
									</div>
								</td>
								<td class="text-end"><?php echo llaveDefinida('inversores', $precios) ? '$'.number_format($precios['inversores'], 2, '.', ',') : '$-';?></td>
							</tr>
                            <tr>
								<td>ESTRUCTURA</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any" min=0 value="<?php echo $numProducto['estructuras']?>" name="estructurasNum" id="estructurasNum" class="form-control" required>
										</div>
									</div>
								</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
												<input type="number" step="any" value="<?php echo $precioNum['estructuras']?>" name="estructurasPrecio" id="estructurasPrecio" class="form-control" required>
										</div>
									</div>
								</td>
                                <td class="text-end"><?php echo llaveDefinida('estructuras', $precios) ? '$'.number_format($precios['estructuras'], 2, '.', ',') : '$-';?></td>
							</tr>
                            <tr>
								<td>COMBI BOX</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any" min=0 name="combiBoxNum" id="combiBoxNum" 
												<?php echo ($inversor[1] == 2) ? ' value="0" disabled class="form-control combiBox" ' : 'value="'.$numProducto['combiBox'].'"required class="form-control"';?>>
										</div>
									</div>
								</td>
								<td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<select class="form-select " aria-label="Default select example" name="combiBoxPrecio" id="combiBoxPrecio" required
												<?php echo ($inversor[1] == 2) ? 'value="0" disabled' : 'value="'.$precioNum['combiBox'].'" required';?>
											>
												<option value="">COMBI BOX</option>
													<?php 
														foreach($combiBox as $i){
															if($precioNum['combiBox'] == $i['Precio']){
														?>
																<option selected value="<?php echo $i['Precio']?>"> <?php echo $i['Modelo'].'&nbsp; $'. number_format($i['Precio'], 2, '.', ',')?></option>
													<?php }else{?>
												<option value="<?php echo $i['Precio']?>"> <?php echo $i['Modelo'].'&nbsp; $'. number_format($i['Precio'], 2, '.', ',')?></option>
														<?php }}?>
												</select>
										</div>
									</div>
								</td>
								<td class="text-end"><?php echo llaveDefinida('combiBox', $precios) ? '$'.number_format($precios['combiBox'], 2, '.', ',') : '$-';?></td>

							</tr>
                            <tr>
								<td>CABLES</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number"step="any" min=0 name="cablesNum" value="<?php echo $numProducto['cables']?>" id="cablesNum" class="form-control" required>
										</div>
									</div>
								</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any" min=0 name="cablesPrecio" value="<?php echo $precioNum['cables']?>" id="cablesPrecio" class="form-control" required>
										</div>
									</div>
								</td>
                                <td class="text-end"><?php echo llaveDefinida('cables', $precios) ? '$'.number_format($precios['cables'], 2, '.', ',') : '$-';?></td>
							</tr>
							<tr>
								<td>CONECTORES MC4</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number"step="any" min=0 name="conectoresMC4Num" value="<?php echo $numProducto['conectoresMC4']?>" id="conectoresMC4Num" class="form-control" required>
										</div>
									</div>
								</td>
								<td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<select class="form-select " aria-label="Default select example" name="conectoresMC4Precio" id="conectoresMC4Precio" required>
												<option value="">CONECTORES MC4</option>
													<?php 
														foreach($conectores as $i){
															if($precioNum['conectoresMC4'] == $i['ProductoID']){
														?>
																<option selected value="<?php echo $i['ProductoID']?>"> <?php echo $i['Modelo'].'&nbsp; $'. number_format($i['Precio'], 2, '.', ',')?></option>
													<?php }else{?>
												<option value="<?php echo $i['ProductoID']?>"> <?php echo $i['Modelo'].'&nbsp; $'. number_format($i['Precio'], 2, '.', ',')?></option>
														<?php }}?>
												</select>
										</div>
									</div>
								</td>
                                <td class="text-end"><?php echo llaveDefinida('conectoresMC4', $precios) ? '$'.number_format($precios['conectoresMC4'], 2, '.', ',') : '$-';?></td>
							</tr>
                            <tr>
								<td>MANO DE OBRA</td>
                                <td><?php echo $_SESSION['numPiezas']?></td>
                                <td>
								<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any" min=0 name="manoObraPrecio" value="<?php echo $precioNum['manoObra']?>" id="manoObraPrecio" class="form-control" required>
										</div>
									</div>
								</td>
                                <td class="text-end">
									<?php echo llaveDefinida('manoObra', $precios) ? '$'.number_format($precios['manoObra'], 2, '.', ','): '$-';?>
								</td>
							</tr>
                            <tr>
								<td>FLETES</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any" min=0 name="fletesNum" id="fletesNum" value="<?php echo $numProducto['fletes']?>" class="form-control" required>
										</div>
									</div>
								</td>
                                <td>
								<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any" min=0 name="fletesPrecio" value="<?php echo $precioNum['fletes']?>" id="fletesPrecio" class="form-control" required>
										</div>
									</div>
								</td>                            
                                <td class="text-end"> <?php echo llaveDefinida('fletes', $precios) ? '$'.number_format($precios['fletes'], 2, '.', ',') :'$-';?></td>
							</tr>
                            <tr>
								<td>WIFI</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any" min=0 name="wifiNum"  id="wifiNum" required
											<?php echo ($inversor[1] == 3) ? 'value="0" disabled class="form-control wifi"' : 'value="'.$numProducto['wifi'].'"required class="form-control"';?>>
										</div>
									</div>
								</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any" min=0 name="wifiPrecio" id="wifiPrecio"required
											<?php echo ($inversor[1] == 3) ? ' value="0" disabled  class="form-control wifi" ' : 'value="'.$precioNum['wifi'].'"required  class="form-control" ';?>>
										</div>
									</div></td>
								<td class="text-end"><?php echo llaveDefinida('wifi', $precios) ? '$'.number_format($precios['wifi'], 2, '.', ',') : '$-';?></td>
							</tr>
                            <tr>
								<td>UNIDAD VERIFICADORA</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any" min=0 name="unidadVerificadorNum"  id="unidadVerificadorNum" class="form-control" 
											<?php echo ($_SESSION['kwNecesarios'] >= 30) ? 'value="1" required' : 'value="0" disabled';?>>
										</div>
									</div>
								</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any"min=0  name="unidadVerificadorPrecio" id="unidadVerificadorPrecio" class="form-control" 
											<?php echo ($_SESSION['kwNecesarios'] >= 30) ? ' value="'.$precioNum['unidadVerificadora'].'" required' : 'value="0" disabled';?>>
										</div>
									</div>
								</td>
                                <td class="text-end"><?php echo llaveDefinida('unidadVerificadora', $precios) ? '$'.number_format($precios['unidadVerificadora'], 2, '.', ',') :  '$-';?></td>						
                            </tr>
                            <tr>
								<td>INTERCONEXIÓN CFE</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any" min=0 name="interconexionNum" value="<?php echo $numProducto['interconexion']?>" id="interconexionNum" class="form-control" required>
										</div>
									</div>
								</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any"  min=0 name="interconexionPrecio" value="<?php echo $precioNum['interconexion']?>" id="interconexionPrecio" class="form-control" required>
										</div>
									</div></td>
									<td class="text-end"><?php echo llaveDefinida('interconexion', $precios) ? '$'.number_format($precios['interconexion'], 2, '.', ',') : '$-';?></td>
							</tr>
							<tr>
								<td>KIT</td>
                                <td>
									<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<input type="number" step="any" min=1 name="kitNum" id="kitNum" value="<?php echo $numProducto['kit']?>" class="form-control" disabled required>
										</div>
									</div>
								</td>
                                <td>
								<div class="row justify-content-sm-center h-100">
										<div class="col-auto">
											<select class="form-select " aria-label="Default select example" name="kitPrecio" id="kitPrecio" required>
												<option value="">KIT</option>
													<?php 
														foreach($kits as $k){
															if($precioNum['kit'] == $k['ProductoID']){
														?>
																<option selected value="<?php echo $k['ProductoID']?>"> <?php echo $k['Modelo'].'&nbsp; $'. number_format($k['Precio'], 2, '.', ',')?></option>
													<?php }else{?>
												<option value="<?php echo $k['ProductoID']?>"> <?php echo $k['Modelo'].'&nbsp; $'. number_format($k['Precio'], 2, '.', ',')?></option>
														<?php }}?>
												</select>
										</div>
									</div>
								</td>
                                <td class="text-end"><?php echo llaveDefinida('kit', $precios) ? '$'.number_format($precios['kit'], 2, '.', ',') : '$-';?></td>
							</tr>
							<tr>
								<td>TOTAL</td>
                                <td>
								</td>
                                <td>
								</td>
                                <td class="text-end"><?php echo '$' . number_format($total, 2, '.', ',');?></td>
							</tr>
						</tbody>
					</table>