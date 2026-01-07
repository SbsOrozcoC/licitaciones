<div
    class="modal fade"
    tabindex="-1"
    role="dialog"
    :class="{ show: showViewModal }"
    style="display: block;"
    v-if="showViewModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4">

            <!-- Header -->
            <div class="modal-header border-0">
                <h5 class="modal-title fw-semibold">
                    Detalle de la oferta
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    @click="closeViewModal">
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <!-- Loading -->
                <div v-if="viewLoading" class="alert alert-info">
                    Cargando información...
                </div>

                <div v-if="viewOffer">

                    <!-- Datos generales -->
                    <h6 class="fw-semibold mb-3">Datos generales</h6>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Consecutivo</label>
                            <div class="form-control-plaintext">
                                {{ viewOffer.consecutivo }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted">Estado</label>
                            <div class="form-control-plaintext">
                                {{ viewOffer.estado }}
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label text-muted">Objeto</label>
                            <div class="form-control-plaintext">
                                {{ viewOffer.objeto }}
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label text-muted">Descripción</label>
                            <div class="form-control-plaintext">
                                {{ viewOffer.descripcion }}
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label text-muted">Actividad</label>
                            <div class="form-control-plaintext">
                                {{ viewOffer.actividad ? viewOffer.actividad.producto : 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <!-- Fechas y presupuesto -->
                    <h6 class="fw-semibold mb-3">Fechas y presupuesto</h6>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Presupuesto</label>
                            <div class="form-control-plaintext">
                                {{ viewOffer.presupuesto }} {{ viewOffer.moneda }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-muted">Fecha inicio</label>
                            <div class="form-control-plaintext">
                                {{ viewOffer.fecha_inicio }} {{ viewOffer.hora_inicio }}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-muted">Fecha cierre</label>
                            <div class="form-control-plaintext">
                                {{ viewOffer.fecha_cierre }} {{ viewOffer.hora_cierre }}
                            </div>
                        </div>
                    </div>

                    <!-- Documentos -->
                    <h6 class="fw-semibold mb-3">Documentos</h6>

                    <div v-if="viewOffer.documentos.length === 0" class="alert alert-warning">
                        No hay documentos cargados.
                    </div>

                    <ul class="list-group list-group-flush">
                        <li
                            class="list-group-item px-0"
                            v-for="doc in viewOffer.documentos"
                            :key="doc.id">
                            <div class="row g-3 mb-2">

                                <!-- Título -->
                                <div class="col-md-6">
                                    <label class="form-label text-muted mb-0">
                                        Título
                                    </label>
                                    <div class="fw-semibold">
                                        {{ doc.titulo || 'Documento' }}
                                    </div>
                                </div>

                                <!-- Descripción -->
                                <div class="col-md-6">
                                    <label class="form-label text-muted mb-0">
                                        Descripción
                                    </label>
                                    <div>
                                        {{ doc.descripcion || 'Sin descripción' }}
                                    </div>
                                </div>

                            </div>

                            <a
                                class="btn btn-sm btn-outline-primary"
                                :href="`/storage/uploads/${doc.archivo}`"
                                target="_blank">
                                Descargar archivo
                            </a>
                        </li>
                    </ul>



                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer border-0">
                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    @click="closeViewModal">
                    Cerrar
                </button>
            </div>

        </div>
    </div>
</div>