<div
    v-if="showEditModal"
    class="modal fade show"
    style="display: block; background: rgba(0,0,0,.5)">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Editar oferta</h5>
                <button type="button" class="btn-close" @click="closeEditModal"></button>
            </div>

            <div class="modal-body">

                <div v-if="editError" class="alert alert-danger">
                    {{ editError }}
                </div>

                <div class="mb-3">
                    <label class="form-label">Objeto</label>
                    <input class="form-control" v-model="editForm.objeto">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" v-model="editForm.descripcion"></textarea>
                </div>

                <hr>

                <h5>Documentos</h5>

                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" class="form-control" v-model="documentForm.titulo">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <input type="text" class="form-control" v-model="documentForm.descripcion">
                </div>

                <div class="mb-3">
                    <label class="form-label">Archivo</label>
                    <input type="file" class="form-control" @change="handleFile">
                </div>

                <button
                    class="btn btn-outline-primary"
                    @click="uploadDocument"
                    :disabled="documentLoading">
                    {{ documentLoading ? 'Subiendo...' : 'Subir documento' }}
                </button>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" @click="closeEditModal">Cancelar</button>
                <button class="btn btn-primary" @click="updateOffer" :disabled="editLoading">
                    {{ editLoading ? 'Guardando...' : 'Guardar cambios' }}
                </button>
            </div>

        </div>
    </div>
</div>