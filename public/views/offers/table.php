<div>

    <div v-if="loading" class="alert alert-info">
        Cargando ofertas...
    </div>

    <div v-if="error" class="alert alert-danger">
        {{ error }}
    </div>

    <div v-if="!loading && offers.length === 0" class="alert alert-warning">
        No hay ofertas registradas.
    </div>

    <table v-if="!loading && offers.length > 0" class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Consecutivo</th>
                <th>Objeto</th>
                <th>Descripción</th>
                <th>Actividad</th>
                <th>Fecha Inicio</th>
                <th>Fecha Cierre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="offer in offers" :key="offer.id">
                <td>{{ offer.consecutivo }}</td>
                <td>{{ offer.objeto }}</td>
                <td>{{ offer.descripcion }}</td>
                <td>{{ offer.actividad ? offer.actividad.producto : '' }}</td>
                <td>{{ offer.fecha_inicio }} {{ offer.hora_inicio }}</td>
                <td>{{ offer.fecha_cierre }} {{ offer.hora_cierre }}</td>
                <td>{{ offer.estado }}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        <button
                            class="btn btn-outline-primary"
                            @click="openViewModal(offer.id)">
                            Ver
                        </button>

                        <button
                            class="btn btn-outline-secondary"
                            @click="openEditModal(offer)">
                            Editar
                        </button>
                    </div>


                </td>
            </tr>
        </tbody>
    </table>

    <nav v-if="meta.last_page > 1">
        <ul class="pagination">

            <li class="page-item" :class="{ disabled: meta.page === 1 }">
                <button class="page-link" @click="changePage(meta.page - 1)">
                    Anterior
                </button>
            </li>

            <li
                class="page-item"
                v-for="page in meta.last_page"
                :key="page"
                :class="{ active: page === meta.page }">
                <button class="page-link" @click="changePage(page)">
                    {{ page }}
                </button>
            </li>

            <li class="page-item" :class="{ disabled: meta.page === meta.last_page }">
                <button class="page-link" @click="changePage(meta.page + 1)">
                    Siguiente
                </button>
            </li>

        </ul>
    </nav>

</div>


<div v-if="showViewModal" class="modal fade show d-block" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detalle de la oferta</h5>
                <button type="button" class="btn-close" @click="closeViewModal"></button>
            </div>

            <div class="modal-body">

                <div v-if="viewLoading" class="alert alert-info">
                    Cargando información...
                </div>

                <div v-if="viewOffer">

                    <p><strong>Consecutivo:</strong> {{ viewOffer.consecutivo }}</p>
                    <p><strong>Objeto:</strong> {{ viewOffer.objeto }}</p>
                    <p><strong>Descripción:</strong> {{ viewOffer.descripcion }}</p>
                    <p><strong>Estado:</strong> {{ viewOffer.estado }}</p>

                    <p><strong>Actividad:</strong>
                        {{ viewOffer.actividad ? viewOffer.actividad.producto : 'N/A' }}
                    </p>

                    <hr>

                    <h6>Documentos</h6>

                    <div v-if="viewOffer.documentos.length === 0" class="alert alert-warning">
                        No hay documentos cargados.
                    </div>

                    <ul v-else>
                        <li v-for="doc in viewOffer.documentos" :key="doc.id">
                            <a
                                :href="`/storage/uploads/${doc.archivo}`"
                                target="_blank">
                                {{ doc.titulo || doc.archivo }}
                            </a>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" @click="closeViewModal">
                    Cerrar
                </button>
            </div>

        </div>
    </div>
</div>