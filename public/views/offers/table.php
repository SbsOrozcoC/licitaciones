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
                    <button class="btn btn-sm btn-primary me-1">Ver</button>
                    <button class="btn btn-sm btn-secondary">Editar</button>
                </td>
            </tr>
        </tbody>
    </table>

</div>
