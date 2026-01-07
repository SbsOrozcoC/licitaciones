<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Licitaciones</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>

<div id="app" class="container mt-4">

    <h1 class="mb-4">Listado de Ofertas</h1>

    <?php require __DIR__ . '/offers/form.php'; ?>
    <?php require __DIR__ . '/offers/filters.php'; ?>
    <?php require __DIR__ . '/offers/table.php'; ?>
    <?php require __DIR__ . '/offers/edit-modal.php'; ?>

</div>

<!-- Vue -->
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
