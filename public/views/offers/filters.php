<div class="row align-items-center mb-3">
    <div class="col-md-8">
        <input
            type="text"
            class="form-control"
            placeholder="Buscar por consecutivo, objeto o descripción"
            v-model="search"
            @keyup.enter="fetchOffers()">
    </div>

    <div class="col-md-4 d-flex gap-2 justify-content-end">
        <button
            class="btn btn-primary"
            @click="fetchOffers()">
            Buscar
        </button>

        <a
            :href="`/api/ofertas/export?search=${search}`"
            class="btn btn-outline-success">
            Exportar Excel
        </a>
    </div>
</div>