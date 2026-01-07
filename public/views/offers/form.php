<div class="card mb-4">
    <div class="card-header">
        Crear nueva oferta
    </div>
    <div class="card-body">

        <form @submit.prevent="createOffer">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Objeto</label>
                    <input type="text" class="form-control" v-model="form.objeto" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Moneda</label>
                    <select class="form-control" v-model="form.moneda" required>
                        <option value="">Seleccione</option>
                        <option value="COP">COP</option>
                        <option value="USD">USD</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" v-model="form.descripcion" required></textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Presupuesto</label>
                    <input type="number" class="form-control" v-model="form.presupuesto" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Fecha inicio</label>
                    <input type="date" class="form-control" v-model="form.fecha_inicio" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Hora inicio</label>
                    <input type="time" class="form-control" v-model="form.hora_inicio" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Fecha cierre</label>
                    <input type="date" class="form-control" v-model="form.fecha_cierre" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Hora cierre</label>
                    <input type="time" class="form-control" v-model="form.hora_cierre" required>
                </div>

                <div class="col-md-4 position-relative">
                    <label class="form-label">Actividad</label>

                    <input
                        type="text"
                        class="form-control"
                        v-model="activitySearch"
                        @input="searchActivities"
                        placeholder="Buscar actividad..."
                        autocomplete="off"
                        required>

                    <!-- Loader -->
                    <div v-if="activityLoading" class="small text-muted">
                        Buscando...
                    </div>

                    <!-- Resultados -->
                    <ul
                        v-if="activityResults.length"
                        class="list-group position-absolute w-100"
                        style="z-index: 1000;">
                        <li
                            v-for="activity in activityResults"
                            :key="activity.id"
                            class="list-group-item list-group-item-action"
                            @click="selectActivity(activity)">
                            {{ activity.producto }}
                        </li>
                    </ul>
                </div>

            </div>

            <button class="btn btn-success" :disabled="formLoading">
                {{ formLoading ? 'Guardando...' : 'Crear oferta' }}
            </button>

        </form>
    </div>
</div>