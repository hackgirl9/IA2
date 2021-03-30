CREATE DATABASE IF NOT EXISTS ia2;

USE ia2;

CREATE TABLE IF NOT EXISTS clientes(

    cedula_cliente              VARCHAR(9)         NOT NULL,
    tipo_documento_cliente      VARCHAR(2)         NOT NULL,
    nombre_cliente              VARCHAR (40)       NOT NULL,
    descripcion_cliente         TEXT,
    direccion_cliente           TEXT,
    telefono_cliente            VARCHAR(11)        NOT NULL,
    representante_cliente       VARCHAR(40)        NOT NULL,

    CONSTRAINT pk_cedula PRIMARY KEY (cedula_cliente)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE IF NOT EXISTS pedidos(

    codigo_pedido               VARCHAR(10)         NOT NULL,
    cedula_cliente              VARCHAR(9)          NOT NULL,
    status_pedido               VARCHAR(10)         NOT NULL,
    descripcion_pedido          TEXT,
    fecha_pedido                DATE                NOT NULL,
    fecha_entrega_pedido        DATE                NOT NULL,

    CONSTRAINT pk_codigo PRIMARY KEY (codigo_pedido)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE IF NOT EXISTS servi_pedidos(

    id_servi_pedido             INT AUTO_INCREMENT  NOT NULL,
    codigo_pedido               VARCHAR(10)         NOT NULL,
    id_servicio                 INT                 NOT NULL,
    id_tela                     INT                 NOT NULL,
    cantidad_prenda             INT                 NOT NULL,
    cantidad_medida             INT                 NOT NULL,

    CONSTRAINT pk_id_servi_pedido PRIMARY KEY (id_servi_pedido)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE IF NOT EXISTS servicios(

    id_servicio                 INT AUTO_INCREMENT  NOT NULL,
    nombre_servicio             VARCHAR(40)         NOT NULL,
    descripcion_servicio        TEXT,
    precio_servicio             FLOAT               NOT NULL,
    costo_servicio              FLOAT               NOT NULL,
    unidad_medida               VARCHAR(10)         NOT NULL,

    CONSTRAINT pk_id_servicio PRIMARY KEY (id_servicio)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE IF NOT EXISTS productos(

    codigo_producto             VARCHAR(15)         NOT NULL,
    nombre_producto             VARCHAR(20)         NOT NULL,
    descripcion_producto        TEXT,
    tipo_producto               VARCHAR(2)          NOT NULL,
    modelo_producto             VARCHAR(10)         NOT NULL,
    costo_producto              FLOAT               NOT NULL,
    precio_producto             FLOAT               NOT NULL,
    stock_producto              INT                 NOT NULL,
    stock_max_producto          INT                 NOT NULL,
    stock_min_producto          INT                 NOT NULL,
    img_producto                VARCHAR(256),

    CONSTRAINT pk_codigo_producto PRIMARY KEY (codigo_producto) 

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


CREATE TABLE IF NOT EXISTS pro_tallas(

    codigo_producto             VARCHAR(10)         NOT NULL,
    id_talla                    VARCHAR(5)          NOT NULL,
    stock_pro_talla             INT                 NOT NULL,

    CONSTRAINT pk_pro_talla PRIMARY KEY (codigo_producto, id_talla)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE IF NOT EXISTS tallas(

    id_talla                    INT AUTO_INCREMENT  NOT NULL,
    nombre_talla                VARCHAR(3)          NOT NULL,

    CONSTRAINT pk_pro_talla PRIMARY KEY (id_talla)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO tallas VALUES(default, 'XS');
INSERT INTO tallas VALUES(default, 'S');
INSERT INTO tallas VALUES(default, 'M');
INSERT INTO tallas VALUES(default, 'L');
INSERT INTO tallas VALUES(default, 'XXL');
INSERT INTO tallas VALUES(default, '32');
INSERT INTO tallas VALUES(default, '34');
INSERT INTO tallas VALUES(default, '36');
INSERT INTO tallas VALUES(default, '38');
INSERT INTO tallas VALUES(default, '40');
INSERT INTO tallas VALUES(default, '42');
INSERT INTO tallas VALUES(default, '44');
INSERT INTO tallas VALUES(default, '46');
INSERT INTO tallas VALUES(default, '48');
INSERT INTO tallas VALUES(default, '50');
INSERT INTO tallas VALUES(default, '52');

CREATE TABLE IF NOT EXISTS pro_pedidos(

    codigo_pedido               VARCHAR(10)         NOT NULL,
    codigo_producto             VARCHAR(10)         NOT NULL,
    cant_pro_pedido             INT                 NOT NULL,

    CONSTRAINT pk_pro_pedido PRIMARY KEY (codigo_pedido, codigo_producto)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


CREATE TABLE IF NOT EXISTS materiales(

    id_material                 INT AUTO_INCREMENT  NOT NULL,
    nombre_material             VARCHAR(100)        NOT NULL,
    descripcion_material        TEXT,
    unidad_material             VARCHAR(5)          NOT NULL,
    precio_material             FLOAT               NOT NULL,
    
    CONSTRAINT pk_id_material PRIMARY KEY (id_material)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE IF NOT EXISTS telas(

    id_tela                     INT AUTO_INCREMENT  NOT NULL,
    nombre_tela                 VARCHAR(20)         NOT NULL,
    descripcion_tela            TEXT,
    unidad_med_tela             VARCHAR(3)          NOT NULL,
    tipo_tela                   VARCHAR(20)         NOT NULL,

    CONSTRAINT pk_id_tela PRIMARY KEY (id_tela)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


CREATE TABLE IF NOT EXISTS mat_servicios(

    id_material                 INT                 NOT NULL,
    id_servicio                 INT                 NOT NULL,
    cant_mat_servicio           INT                 NOT NULL,

    CONSTRAINT pk_mat_pedido PRIMARY KEY (id_material, id_servicio)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE IF NOT EXISTS factura_ventas(

    codigo_factura              VARCHAR(10)         NOT NULL,
    codigo_pedido               VARCHAR(10)         NOT NULL,
    fecha_factura               DATE                NOT NULL,
    modo_pago_factura           VARCHAR(20)         NOT NULL,
    porcentaje_venta_factura    FLOAT               NOT NULL,
    status_factura              BOOL                NOT NULL,

    CONSTRAINT pk_codigo_factura PRIMARY KEY (codigo_factura)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE IF NOT EXISTS usuarios(

 	nick_usuario                VARCHAR(30)         NOT NULL,
    nombre_usuario              VARCHAR(20)         NOT NULL,
    apellido_usuario            VARCHAR(20)         NOT NULL,
    email_usuario               VARCHAR(40),    
    contrasenia_usuario         VARCHAR(255)        NOT NULL,
    id_rol                      INT                 NOT NULL,

    CONSTRAINT pk_nick_usuario PRIMARY KEY (nick_usuario)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE IF NOT EXISTS bitacoras(

    id_bitacora                 INT AUTO_INCREMENT  NOT NULL,
    nick_usuario                VARCHAR(30)         NOT NULL,
    fecha_actu_bitacora         DATE                NOT NULL,
    hora_actu_bitacora          TIME                NOT NULL,
    modulo_bitacora             VARCHAR(20)         NOT NULL,
    accion_bitacora             TEXT                NOT NULL,

    CONSTRAINT pk_id_bitacora PRIMARY KEY (id_bitacora)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE IF NOT EXISTS roles(

    id_rol                      INT AUTO_INCREMENT  NOT NULL,
    nombre_rol                  VARCHAR(15)         NOT NULL,
    descripcion_rol             TEXT,

    CONSTRAINT pk_id_rol PRIMARY KEY (id_rol)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


CREATE TABLE IF NOT EXISTS permisos(

    id_permiso                  INT AUTO_INCREMENT  NOT NULL,
    nombre_permiso              VARCHAR(30)         NOT NULL,
    descripcion_permiso         TEXT,

    CONSTRAINT pk_id_permiso PRIMARY KEY (id_permiso)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE IF NOT EXISTS rol_permisos (

    id_rol                      INT                 NOT NULL,
    id_permiso                  INT                 NOT NULL,

    CONSTRAINT pk_rol_permiso PRIMARY KEY (id_rol, id_permiso)

)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


ALTER TABLE    pedidos         ADD CONSTRAINT    Fkdocumento      FOREIGN KEY    (cedula_cliente)    REFERENCES    clientes(cedula_cliente)         ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    servi_pedidos   ADD CONSTRAINT    Fkpedido_1       FOREIGN KEY    (codigo_pedido)     REFERENCES    pedidos(codigo_pedido)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    servi_pedidos   ADD CONSTRAINT    Fkservicio_1     FOREIGN KEY    (id_servicio)       REFERENCES    servicios(id_servicio)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    servi_pedidos   ADD CONSTRAINT    Fktela           FOREIGN KEY    (id_tela)           REFERENCES    telas(id_tela)                   ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    pro_pedidos     ADD CONSTRAINT    Fkpedido_2       FOREIGN KEY    (codigo_pedido)     REFERENCES    pedidos(codigo_pedido)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    pro_pedidos     ADD CONSTRAINT    Fkproducto_1     FOREIGN KEY    (codigo_producto)   REFERENCES    productos(codigo_producto)       ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    pro_tallas      ADD CONSTRAINT    Fkproducto_2     FOREIGN KEY    (codigo_producto)   REFERENCES    productos(codigo_producto)       ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    pro_tallas      ADD CONSTRAINT    Fktalla          FOREIGN KEY    (id_talla)          REFERENCES    tallas(id_talla)                 ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    mat_servicios   ADD CONSTRAINT    Fkmaterial       FOREIGN KEY    (id_material)       REFERENCES    materiales(id_material)          ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    mat_servicios   ADD CONSTRAINT    Fkservicio_2     FOREIGN KEY    (id_servicio)       REFERENCES    servicios(id_servicio)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    factura_ventas  ADD CONSTRAINT    Fkpedido_5       FOREIGN KEY    (codigo_pedido)     REFERENCES    pedidos(codigo_pedido)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    bitacoras       ADD CONSTRAINT    Fkusuario        FOREIGN KEY    (nick_usuario)      REFERENCES    usuarios(nick_usuario)           ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    rol_permisos    ADD CONSTRAINT    Fkroles          FOREIGN KEY    (id_rol)            REFERENCES    roles(id_rol)                    ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE    rol_permisos    ADD CONSTRAINT    Fkpermiso        FOREIGN KEY    (id_permiso)        REFERENCES    permisos(id_permiso)             ON UPDATE CASCADE ON DELETE CASCADE;

