                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body" id="cuerpo_pagina"> 
                        <div class="row">
                         <div class="col-md-12">
                          <a href="<?php echo base_url();?>Tipo_documento/nuevo"><button class="btn  btn-success" >Nuevo</button></a>
                        </div>
                      </div>
                      <div class="row">
                       <div class="col-md-12">
                        <div class="table-responsive">
                         <table class="table display product-overview mb-30" id="myTable">
                          <thead>
                            <tr>
                              <th width="10%">#</th>
                              <th width="70%">Descricpion</th>
                              <th width="70%">Tipo Abreviación</th>
                              <th width="10%">Acciones</th>
                            </tr>
                          </thead>
                          <tbody id="cuerpo_tabla">
                           <?php $c=1; foreach ($data["tabla"] as $key => $value) {
                            $a="'Tipo_documento',".$value["tipodoc_id"];
                            echo "<tr>";
                            echo "<td>".$c."</td>";
                            echo "<td>".$value["tipodoc_descripcion"]."</td>";
                            echo "<td>".$value["tipodoc_abreviacion"]."</td>";
                            echo '<td><a  onclick="eliminar('.$a.')" class="text-inverse" title="Eliminar" data-toggle="tooltip"><i class="mdi mdi-delete-empty txt-danger"></i></a> <a href="'.base_url().'Tipo_documento/editar/'.$value["tipodoc_id"].'" class="text-inverse" title="Editar" data-toggle="tooltip"><i class="mdi mdi-table-edit txt-danger"></i></a></td>';
                            echo "</tr>";
                            $c++;
                          }  ?>
                        </tbody>
                      </table>
                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

