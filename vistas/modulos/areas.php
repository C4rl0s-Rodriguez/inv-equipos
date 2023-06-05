<div class="row">
    <div class="header-title py-2 mb-4 border-bottom container-fluid">
        <h4 class="mb-0 ps-3"><i class="fa-solid fa-building-user"></i> AREAS</h4>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="d-flex justify-content-between">
            <button id="btnAgregarArea" type="button" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#modal-gestionar-areas">
                <i class="fas fa-plus-square"></i>  Agregar Area
            </button>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 pt-3">
        <table id="tblAreas" class="table table-striped table-bordered display responsive nowrap table-custom" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>UBICACION</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
               
    <!-- Modal para agregar o modificar areas -->
    <div class="modal fade" id="modal-gestionar-areas" tabindex="-1" aria-labelledby="add-area-modlLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ttlModalAreas"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAreas" class="needs-validation" novalidate action="javascript:void(0);"> 
                    <div class="modal-body">
                        <div class="row g-3 mb-2 pb-3 border-bottom">
                            <div class="col-md-12">
                                <p class="fs-6 mb-0 fw-bold">Información Area:</p>
                            </div>
                            <div class="col-md-12">
                                <input id="txtIdArea" type="hidden" value="">
                                <label for="txtNombreArea" class="form-label">Nombre</label>
                                <input id="txtNombreArea" type="text" class="form-control" name="nombreArea"pattern="^[A-ZÁÉÍÓÚÜÑ.0-9 ]+$" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                                <div class="invalid-feedback">
                                    Nombre inválido ej. (A-Z, 0-9)
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="sltUbicacion" class="form-label">Ubicacion</label>
                                <select id="sltUbicacion" class="form-select" name="selectUbicacion" required>
                                    <option value="none" disabled selected></option>
                                    <option value="PLANTA BAJA">PLANTA BAJA</option>
                                    <option value="PLANTA ALTA">PLANTA ALTA</option>
                                    <option value="AZOTEA">AZOTEA</option>
                                    <option value="#N/D">#N/D</option>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione una ubicación
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btnCancelarArea" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button id="btnGuardarArea" type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="vistas/assets/dist/js/areas-script.js"></script>