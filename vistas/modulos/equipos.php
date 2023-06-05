<div class="row">
    <div class="header-title py-2 mb-4 border-bottom container-fluid">
        <h4 class="ps-3 mb-0">   <i class="fa-solid fa-desktop">  </i>        INVENTARIO EQUIPOS DE CÓMPUTO</h4>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="d-flex justify-content-between">
            <button id="btnAgregarEquipo" type="button" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#modal-gestionar-equipos">
                <i class="fas fa-plus-square"></i>  Agregar Equipo
            </button>
            <button id="btnDescargar" type="button" class="btn btn-danger dropdown-toggle" id="dropdownDescargas" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-download"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownDescargas">
                <li><a class="dropdown-item" type="button" id="btnDownload"><i class="fa-solid fa-file-pdf"></i>   F027-B</a></li>
            </ul>
        </div>
        
        <!-- <button class="btn btn-primary bold">
            <i class="fas fa-plus-square"></i>  Agregar Area            
        </button> -->
        <!-- <i class="fa-solid fa-circle-check text-success fa-lg"></i> -->
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 pt-3">
        <table id="tablareg" class="table table-striped table-bordered display responsive nowrap table-custom" style="width:100%">
            <thead>
                <tr>
                    <th>NUMERO INVENTARIO</th>
                    <th>EQUIPO</th>
                    <th>MARCA</th>
                    <th>MODELO</th>
                    <th>NUMERO DE SERIE</th>
                    <th>AÑO DE COMPRA</th>
                    <th>RECEPCIÓN</th>
                    <th>AREA</th>
                    <th>BAJA</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
               
    <!-- Modal Para registro de nuevos equipos -->
    <div class="modal fade" id="modal-gestionar-equipos" tabindex="-1" aria-labelledby="add-reg-modlLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ttlModalEquipos">Registrar equipo de cómputo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEquipos" class="needs-validation" novalidate action="javascript:void(0);"> 
                    <div class="modal-body">
                        <div class="row g-3 mb-2 pb-3 border-bottom">
                            <div class="col-md-12">
                                <p class="fs-6 mb-0 fw-bold">Información General:</p>
                            </div>
                            <div class="col-md-3">
                                <input id="txtIdEquipo" type="hidden" value="">
                                <input id="txtIdSpecs" type="hidden" value="">
                                <label for="txtNumInventario" class="form-label">Nº Inventario</label>
                                <input id="txtNumInventario" type="text" class="form-control" name="numInventario" disabled>
                            </div>
                            <div class="col-md-5">
                                <label for="sltTipoEquipo" class="form-label">Equipo</label>
                                <select id="sltTipoEquipo" class="form-select codeGenerate" name="tipoEquipo" required>
                                    <option value="none" disabled selected></option>
                                    <option value="LAPTOP">LAPTOP</option>
                                    <option value="AIO">ALL IN ONE</option>
                                    <option value="PC">COMPUTADORA DE ESCRITORIO</option>
                                    <option value="IMPRESORA">IMPRESORA</option>
                                    <option value="SERVIDOR">SERVIDOR</option>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione un equipo
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="sltCiudad" class="form-label">Ciudad</label>
                                <select id="sltCiudad" class="form-select codeGenerate" name="sltCiudad" required>
                                    <option value="none" disabled selected></option>
                                    <option value="MAZATLÁN">MAZATLÁN</option>
                                    <option value="CULIACÁN">CULIACAN</option>
                                    <option value="LA PAZ">LA PAZ</option>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione una ciudad
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="sltMarca" class="form-label">Marca</label>
                                <select id="sltMarca" class="form-select" name="idMarcasTable" required>
                                    <option value="none" disabled selected></option>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione una marca
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="txtModelo" class="form-label">Modelo</label>
                                <input id="txtModelo" type="text" class="form-control" pattern="^[A-Z0-9-/ ]+$" name="modelo_equipo" onkeyup="javascript:this.value=this.value.toUpperCase();" required >
                                <div class="invalid-feedback">
                                    Invalido ej. (A-Z, 0-9, -, /)
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="txtNumSerie" class="form-label">Nº Serie</label>
                                <input id="txtNumSerie" type="text" class="form-control"  pattern="^[A-Z0-9-/ ]+$" name="numSerie" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                <div class="invalid-feedback">
                                    Seleccione la fecha
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="txtFechaCompra" class="form-label">Fecha de Compra</label>
                                <input id="txtFechaCompra" type="date" class="form-control" name="dateIngreso" required>
                                <div class="invalid-feedback">
                                    Invalido ej. (A-Z, 0-9, -, /)
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="sltEstado" class="form-label">Estado</label>
                                <select id="sltEstado" class="form-select" name="estadoIngreso" required>
                                    <option value="none" disabled selected></option>
                                    <option value="NUEVO">NUEVO</option>
                                    <option value="USADO">USADO</option>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione el estado
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="txtLugarCompra" class="form-label">Lugar de Compra</label>
                                <input id="txtLugarCompra" type="text" class="form-control" name="idLugarCompra" pattern="^[A-ZÁÉÍÓÚÜÑ0-9 ]+$" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                <div class="invalid-feedback">
                                    Invalido ej. (A-Z, 0-9)
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="txtNumFactura" class="form-label">Numero de Factura</label>
                                <input id="txtNumFactura" type="text" class="form-control" name="idNumFactura" pattern="^[A-Z0-9-/ ]+$" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                <div class="invalid-feedback">
                                    Invalido ej. (A-Z, 0-9, -, /)
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="sltArea" class="form-label">Area</label>
                                <select id="sltArea" class="form-select" name="idAreas" required>
                                    <option value="none" disabled selected></option>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione el area
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="txtBaja" class="form-label">Baja</label>
                                <input id="txtBaja" type="date" class="form-control" aria-label="Disabled input" name="statusEquipo" disabled>
                            </div>
                        </div>
                        <div id="stnEspec" class="row g-3 mb-2 pb-3 border-bottom">
                            <div class="col-md-12">
                                <p class="fs-6 mb-0 fw-bold">Especificaciones:</p>
                            </div>
                            <div class="col-md-3">
                                <label for="txtCpu" class="form-label">CPU</label>
                                <input id="txtCpu" type="text" class="form-control" name="idCpu" required pattern="^[A-Z0-9- ]+$" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                <div class="invalid-feedback">
                                    Invalido ej. (A-Z, 0-9, -)
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="txtRam" class="form-label">RAM</label>
                                <div class="input-group">
                                    <input id="txtRam" type="number" class="form-control" required name="idRam" min="1">
                                    <span class="input-group-text">GB</span>
                                    <div class="invalid-feedback">
                                        Ingrese la cantidad
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="txtAlmacenamiento" class="form-label">Almacenamiento</label>
                                <div class="input-group">
                                    <input id="txtAlmacenamiento" type="number" class="form-control" name="idAlmacenamiento" min="1" required>
                                    <span class="input-group-text">GB</span>
                                    <div class="invalid-feedback">
                                        Ingrese la cantidad
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="sltSO" class="form-label">Sistema Operativo</label>
                                <select id="sltSO" class="form-select" name="selectSO" required>
                                    <option value="none" disabled selected></option>
                                    <option value="WINDOWS 11">WINDOWS 11</option>
                                    <option value="WINDOWS 10">WINDOWS 10</option>
                                    <option value="WINDOWS 8.1">WINDOWS 8.1</option>
                                    <option value="WINDOWS 8">WINDOWS 8</option>
                                    <option value="WINDOWS 7">WINDOWS 7</option>
                                    <option value="WINDOWS XP">WINDOWS XP</option>
                                    <option value="SERVER 2008 R2">SERVER 2008 R2</option>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione el sistema operativo
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mb-2 pb-3 border-bottom">
                            <div class="col-md-12">
                                <p class="fs-6 mb-0 fw-bold">Información de Red:</p>
                            </div>
                            <div class="col-md-5">
                                <label for="txtDirMac" class="form-label">Dirección Mac</label>
                                <input id="txtDirMac" type="text" class="form-control" name="idDirMac" pattern="^[A-Z0-9-]{17}$" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                                <div class="invalid-feedback">
                                    Invalido ej. (0A-0B-0C-0D-0E-0F)
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="txtDirIp" class="form-label">Dirección IP</label>
                                <input id="txtDirIp" type="text" class="form-control" name="idDirIp" pattern="^[0-9.]{7,15}$" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                                <div class="invalid-feedback">
                                    Invalido ej. (192.168.10.1)
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnCancelar" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button id="btnGuardar" type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="vistas/assets/dist/js/equipos-script.js"></script>
<script src="vistas/assets/dist/fonts/calibri-regular.js"></script>