# Módulo de Licitaciones

Este proyecto consiste en un módulo de licitaciones desarrollado en PHP 7+ sin frameworks, bajo arquitectura MVC,
con frontend en Vue.js y backend completamente funcional, incluyendo:

- Creación y edición de ofertas
- Asociación de actividades (UNSPSC)
- Carga y visualización de documentos
- Listado con búsqueda y paginación
- Exportación de información a Excel
- Interfaz web con Vue.js
- Backend en PHP con arquitectura MVC ligera
- Entorno completamente dockerizado
  El objetivo principal fue construir una solución funcional, clara y mantenible, priorizando buenas prácticas y experiencia de usuario.

## 🛠️ Stack Tecnológico

### Backend

- PHP 7.4 (PHP-FPM)
- Arquitectura MVC ligera
- Eloquent ORM (Illuminate Database)
- PhpSpreadsheet (exportación Excel)

### Frontend

- Vue.js 2
- Axios
- Bootstrap 5
- SweetAlert2

### Infraestructura

- Docker
- Docker Compose
- Nginx
- MySQL

## 📋 Requisitos

- Docker
- Docker Compose
- Git

## 🚀 Instalación y ejecución

1. Clonar el repositorio:

```bash
    git clone https://github.com/SbsOrozcoC/licitaciones.git
    cd licitaciones
```

2. Levantar el entorno:

```bash
    docker compose up -d
```

3. Importar actividades desde el archivo UNSPSC (una sola vez):

```bash
    docker compose exec php php scripts/import_actividades.php
```

4. Acceder a la aplicación:

```bash
    http://localhost:8080
```

5. 🔌 Endpoints disponibles

```md

### Crear oferta

POST /api/ofertas

### Listar ofertas

GET /api/ofertas?search=&page=&per_page=

### Ver oferta

GET /api/ofertas/{id}

### Editar oferta

PUT /api/ofertas/{id}

### Cargar documento

POST /api/ofertas/{id}/documentos

### Exportar ofertas a Excel

GET /api/ofertas/export
```

## 📐 Reglas de negocio

- El consecutivo de la oferta se genera automáticamente en backend.
- Las actividades se cargan desde el archivo UNSPSC oficial.
- Para poder guardar cambios en una oferta, debe existir al menos un documento cargado.
  Esta validación se guía desde la interfaz para mejorar la experiencia de usuario.
- Validaciones de fechas, moneda y presupuesto en backend.

## 🎨 Decisiones de UX destacadas

- El sistema guía al usuario visualmente antes de bloquear acciones.
- Los botones de acción se habilitan solo cuando se cumplen las reglas de negocio.
- Se utilizaron modales separados para ver y editar, evitando confusión.
- La paginación solo se muestra cuando es necesaria, manteniendo una interfaz limpia.

## 📝 Notas

- El proyecto está dockerizado para facilitar su ejecución.
- No se utiliza ningún framework PHP, cumpliendo el enunciado.
- El frontend puede conectarse directamente a los endpoints REST.

# Autor

Sebastian Orozco
Desarrollador Full Stack
