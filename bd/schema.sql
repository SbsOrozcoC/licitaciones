CREATE TABLE IF NOT EXISTS actividades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_segmento INT,
    segmento VARCHAR(200),
    codigo_familia INT,
    familia VARCHAR(200),
    codigo_clase INT,
    clase VARCHAR(200),
    codigo_producto INT,
    producto VARCHAR(200)
);

CREATE TABLE IF NOT EXISTS ofertas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    consecutivo VARCHAR(20) UNIQUE,
    objeto VARCHAR(150) NOT NULL,
    descripcion VARCHAR(400) NOT NULL,
    moneda VARCHAR(3) NOT NULL,
    presupuesto DECIMAL(15,2) NOT NULL,
    actividad_id INT NOT NULL,
    fecha_inicio DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    fecha_cierre DATE NOT NULL,
    hora_cierre TIME NOT NULL,
    estado VARCHAR(20),
    creado_en DATETIME,
    actualizado_en DATETIME,
    CONSTRAINT fk_oferta_actividad
        FOREIGN KEY (actividad_id) REFERENCES actividades(id)
);

CREATE TABLE IF NOT EXISTS ofertas_documentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    licitacion_id INT NOT NULL,
    titulo VARCHAR(100),
    descripcion VARCHAR(200),
    archivo VARCHAR(255),
    creado_en DATETIME,
    CONSTRAINT fk_documento_oferta
        FOREIGN KEY (licitacion_id) REFERENCES ofertas(id)
);
