<div class="row mb-3">
    <div class="col-md-6">
        <input
            type="text"
            class="form-control"
            placeholder="Buscar por consecutivo, objeto o descripción"
            v-model="search"
            @keyup.enter="fetchOffers"
        >
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary w-100" @click="fetchOffers">
            Buscar
        </button>
    </div>
</div>
