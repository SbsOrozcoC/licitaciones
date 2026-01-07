<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Licitaciones</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- App styles -->
    <link rel="stylesheet" href="/assets/css/app.css">
</head>

<body>

    <div id="app" class="container my-4">

        <div class="card shadow-sm rounded-4">

            <!-- Header -->
            <div class="card-header bg-white border-0">
                <h3 class="mb-0">Listado de Ofertas</h3>
            </div>

            <!-- Body -->
            <div class="card-body">

                <!-- Crear oferta -->
                <?php require __DIR__ . '/offers/form.php'; ?>

                <hr>

                <!-- Filtros / búsqueda / export -->
                <?php require __DIR__ . '/offers/filters.php'; ?>

                <!-- Tabla + paginación -->
                <?php require __DIR__ . '/offers/table.php'; ?>

            </div>
        </div>

        <!-- Modales fuera de la card -->
        <?php require __DIR__ . '/offers/modals/edit-modal.php'; ?>
        <?php require __DIR__ . '/offers/modals/view-modal.php'; ?>

    </div>

    <!-- Vue 2 -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- API Service -->
    <script src="/assets/js/services/api.js"></script>

    <!-- Vue App -->
    <script src="/assets/js/app.js"></script>

</body>

</html>