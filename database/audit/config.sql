INSERT INTO pgaudit.config (key, value) VALUES 
('I', 'INSERT'),
('U', 'UPDATE'),
('D', 'DELETE');

/**Add Audits**/
select pgaudit.table('productos');

select pgaudit.table('clientes');

select pgaudit.table('bitacoras');

select pgaudit.table('pedidos');

select pgaudit.table('pro_pedidos');

select pgaudit.table('servi_pedidos');

select pgaudit.table('factura_ventas');

select pgaudit.table('usuarios');

select pgaudit.table('materiales');

select pgaudit.table('telas');





