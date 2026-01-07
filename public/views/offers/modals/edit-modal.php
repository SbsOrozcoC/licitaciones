<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    :class="{ show: showEditModal }"
    style="display: block;"
    v-if="showEditModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4">

            <!-- Header -->
            <div class="modal-header border-0">
                <h5 class="modal-title fw-semibold">
                    Editar oferta
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    @click="closeEditModal">
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <!-- Datos generales -->
                <h6 class="fw-semibold mb-3">Datos generales</h6>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Objeto</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="editForm.objeto">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Estado</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="editForm.estado"
                            disabled>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Descripción</label>
                        <textarea
                            class="form-control"
                            rows="3"
                            v-model="editForm.descripcion">
                        </textarea>
                    </div>
                </div>

                <!-- Fechas -->
                <h6 class="fw-semibold mb-3">Fechas y presupuesto</h6>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Presupuesto</label>
                        <input
                            type="number"
                            class="form-control"
                            v-model="editForm.presupuesto">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Fecha inicio</label>
                        <input
                            type="date"
                            class="form-control"
                            v-model="editForm.fecha_inicio">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Fecha cierre</label>
                        <input
                            type="date"
                            class="form-control"
                            v-model="editForm.fecha_cierre">
                    </div>
                </div>

                <!-- Documentos -->
                <h6 class="fw-semibold mb-3">Documentos</h6>
                <small class="text-primary">
                    Para guardar los cambios, cargue al menos un documento con su información.
                </small>


                <div class="row g-3 mb-3">

                    <!-- Título -->
                    <div class="col-md-6">
                        <label class="form-label">Título</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="documentForm.titulo">
                    </div>

                    <!-- Descripción -->
                    <div class="col-md-6">
                        <label class="form-label">Descripción</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="documentForm.descripcion">
                    </div>

                </div>

                <div class="row g-3 align-items-end">

                    <!-- Archivo -->
                    <div class="col-md-9">
                        <label class="form-label">Archivo</label>
                        <input
                            type="file"
                            class="form-control"
                            @change="handleFile">
                    </div>

                    <!-- Botón subir -->
                    <div class="col-md-3 d-grid">
                        <button
                            type="button"
                            class="btn btn-outline-primary"
                            :disabled="documentLoading"
                            @click="uploadDocument">
                            Subir documento
                        </button>
                    </div>

                </div>


            </div>

            <!-- Footer -->
            <div class="modal-footer border-0">
                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    @click="closeEditModal">
                    Cancelar
                </button>

                <button
                    type="button"
                    class="btn btn-primary"
                    :disabled="!canSaveOffer || editLoading"
                    @click="updateOffer">
                    Guardar cambios
                </button>


            </div>

        </div>
    </div>
</div>