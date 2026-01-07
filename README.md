# Módulo de Licitaciones

Este proyecto consiste en un módulo de licitaciones desarrollado en PHP 7+ sin frameworks, bajo arquitectura MVC,
con frontend en Vue.js y backend completamente funcional.

## 🛠️ Stack Tecnológico

- PHP 7.4 (sin frameworks)
- MySQL 8
- Nginx
- Docker / Docker Compose
- Eloquent ORM (standalone)
- PhpSpreadsheet (importación y exportación Excel)


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
    POST /ofertas

    ### Listar ofertas
    GET /ofertas?search=&page=&per_page=

    ### Ver oferta
    GET /ofertas/{id}

    ### Editar oferta
    PUT /ofertas/{id}
    > Requiere al menos un documento cargado

    ### Cargar documento
    POST /ofertas/{id}/documentos
    - Tipos permitidos: PDF, ZIP

    ### Exportar ofertas a Excel
    GET /ofertas/export
```

## 📐 Reglas de negocio

- El consecutivo de la oferta se genera automáticamente en backend.
- Las actividades se cargan desde el archivo UNSPSC oficial.
- Para editar una oferta es obligatorio que tenga al menos un documento.
- Validaciones de fechas, moneda y presupuesto en backend.

## 📝 Notas

- El proyecto está dockerizado para facilitar su ejecución.
- No se utiliza ningún framework PHP, cumpliendo el enunciado.
- El frontend puede conectarse directamente a los endpoints REST.

# Autor
Sebastian Orozco
Desarrollador Full Stack