-- CLIENTES

INSERT INTO 	clientes 		VALUES ('27210326','V', 'Angel Serrano'    , 'Estudiante de Informática' , 'Sarare' , '04120531200'  ,'UPTAEB');
INSERT INTO 	clientes 		VALUES ('27085898','V', 'Yohnneiber Diaz'  , 'Estudiante de Informática' , 'Barrio el jebe sector, propatria'          , '04241585586'		 ,'UPTAEB');
INSERT INTO 	clientes 		VALUES ('27317920','V', 'Jhon Moran'       , 'Estudiante de Informática' , '5 de julio'     , '0424'		 ,'UPTAEB');
INSERT INTO 	clientes 		VALUES ('28286639','V', 'Andres Melendez'  , 'Estudiante de Informática' , 'Cerrito Blanco, a lado de la licoreria' , '04241234567' ,'UPTAEB');
INSERT INTO 	clientes 		VALUES ('27198456','V', 'Veronica Quintero', 'Estudiante de Informática' , 'Santa Elena'    , '0412123457'		 ,'UPTAEB');
INSERT INTO 	clientes 		VALUES ('27212503','V', 'Gabriel Oropeza'  , 'Estudiante de Informática' , 'Calle 48'       , '04241234567'		 ,'UPTAEB');

-- PEDIDOS

INSERT INTO 	pedidos 		VALUES	('P-0000001','27210326','Entregado' ,'','2020-1-01', '2020-1-01');
INSERT INTO 	pedidos 		VALUES	('P-0000002','27085898','Facturado' ,'','2020-1-01', '2020-1-01');
INSERT INTO 	pedidos 		VALUES	('P-0000003','27317920','En Proceso','','2020-1-01', '2020-1-23');
INSERT INTO 	pedidos 		VALUES	('P-0000004','28286639','Cancelado' ,'','2019-11-01', '2019-11-19');
INSERT INTO 	pedidos 		VALUES	('P-0000005','27198456','En Proceso','','2020-1-22', '2020-1-23');
INSERT INTO 	pedidos 		VALUES	('P-0000006','27212503','Facturado' ,'','2019-11-01', '2019-11-19');

-- FACTURA

INSERT INTO 	factura_ventas 	VALUES	('1','P-0000001','2020-1-20', 'Punto'         , true  , 12);
INSERT INTO 	factura_ventas 	VALUES	('2','P-0000002','2020-1-20', 'Pago Movil'    , false ,  3);
INSERT INTO 	factura_ventas 	VALUES	('3','P-0000003','2020-1-22', 'Transferencia' , true  ,  3);

-- SERVICIOS

INSERT INTO 	servicios 		VALUES (default , 'Sublimación'       , '' , 'Area'   , 12   , 24 );
INSERT INTO 	servicios 		VALUES (default , 'Confección Textil' , '' , 'Metros' , 20.2 , 40 );
INSERT INTO 	servicios 		VALUES (default , 'Serigrafia'        , '' , 'Color'  , 10   , 20 );

-- TELAS

INSERT INTO 	telas 			VALUES (default, 'Rayón'           	, '' , 'Mts' , 'Algodón'   );
INSERT INTO 	telas 			VALUES (default, 'Tonela'          	, '' , 'Kg'  , 'Sintetico' );
INSERT INTO 	telas 			VALUES (default, 'Tonela Estampada'	, '' , 'Mts' , 'Algodon');
INSERT INTO 	telas 			VALUES (default, 'Popelina'			, '' , 'Mts' , 'Algodon');
INSERT INTO 	telas 			VALUES (default, 'Micro Durazno'	, '' , 'Mts' , 'Algodon');
INSERT INTO 	telas 			VALUES (default, 'Crochet'			, '' , 'Mts' , 'Sintetico');
INSERT INTO 	telas 			VALUES (default, 'Gabardina'		, '' , 'Mts' , 'Algodon');
INSERT INTO 	telas 			VALUES (default, 'Licra'			, '' , 'Mts' , 'Sintetico');


-- SERVI_PEDIDOS

INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000001', 2 , 1 , 24 , 0,10);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000002', 3 , 1 , 24 , 2,10);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000002', 1 , 1 , 5  , 0,5);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000002', 2 , 1 , 1  , 0,10);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000005', 1 , 3 , 20 , 0,10);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000005', 2 , 3 , 15 , 0,5);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000005', 3 , 3 , 10 , 2,10);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000003', 2 , 2 , 12 , 0,50);
INSERT INTO 	servi_pedidos 	VALUES (default, 'P-0000004', 1 , 1 , 40 , 0,5);

-- MATERIALES

INSERT INTO 	materiales 		VALUES (default, 'Tijeras' , '' , '10'  , 2    );
INSERT INTO 	materiales 		VALUES (default, 'Hilos'   , '' , '100' , 1.50 );
INSERT INTO 	materiales 		VALUES (default, 'Agujas'  , '' , '10'  , 1    );
INSERT INTO 	materiales 		VALUES (default, 'Botones Pequeños'  , '' , '10'  , 1    );
INSERT INTO 	materiales 		VALUES (default, 'Botones Grande'  , '' , '10'  , 1    );
INSERT INTO 	materiales 		VALUES (default, 'Cadenas'  , '' , '10'  , 2    );
INSERT INTO 	materiales 		VALUES (default, 'Pintura '  , '' , '10'  , 2    );

-- MAT_SERVICIOS

INSERT INTO 	mat_servicios 	VALUES ( 1 , 2 , 0 );
INSERT INTO 	mat_servicios 	VALUES ( 2 , 2 , 0 );
INSERT INTO 	mat_servicios 	VALUES ( 3 , 2 , 0 );
INSERT INTO 	mat_servicios 	VALUES ( 1 , 3 , 0 );
INSERT INTO 	mat_servicios 	VALUES ( 1 , 1 , 0 );
INSERT INTO 	mat_servicios 	VALUES ( 2 , 1 , 0 );
INSERT INTO 	mat_servicios 	VALUES ( 3 , 1 , 0 );

-- PRODUCTOS

INSERT INTO 	productos 		VALUES ( '1' , 'Camisa'   , 'Estampada'  	, 'ma' , ' ' , 10 , 20 , 24 , 100 , 24 , 'camisa.jpg' );
INSERT INTO 	productos 		VALUES ( '2' , 'Pantalón' , 'Blue Jeans' 	, 'fe' , ' ' , 20 , 40 , 25 , 100 , 24 , 'pantalon.png' );
INSERT INTO 	productos 		VALUES ( '3' , 'Suerter'  , 'Negro'      	, 'ux' , ' ' , 15 , 30 , 25 , 100 , 24 , 'sueter.png' );

-- PRO_TALLAS

INSERT INTO 	pro_tallas 		VALUES ( '1' , 1 , 5  );
INSERT INTO 	pro_tallas 		VALUES ( '2' , 2 , 10 );
INSERT INTO 	pro_tallas 		VALUES ( '3' , 5 , 20 );

-- PRO_PEDIDOS

INSERT INTO 	pro_pedidos 	VALUES ( 'P-0000001' , '3' , 5 ,5, 'S');
INSERT INTO 	pro_pedidos 	VALUES ( 'P-0000006' , '2' , 1 ,5, 'S');
INSERT INTO 	pro_pedidos 	VALUES ( 'P-0000006' , '3' , 1 ,5, 'XXL');
INSERT INTO 	pro_pedidos 	VALUES ( 'P-0000006' , '1' , 1, 5, 'XS');
INSERT INTO 	pro_pedidos 	VALUES ( 'P-0000001' , '2' , 1 ,5, 'S');
