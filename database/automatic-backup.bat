@echo off 
SET PG_BIN="C:\Program Files\PostgreSQL\10\bin\pg_dump.exe"
SET PG_HOST=localhost
SET PG_PORT=5432
SET PG_DATABASE=ia2
SET PG_USER=postgres
SET PGPASSWORD=1234
SET PG_PATH=C:\xampp\htdocs\project-IA2\database
SET PG_FECHA=%date:~11,4%%date:~8,2%%date:~5,2%
SET PG_FILENAME="%PG_PATH%\%PG_DATABASE%_%PG_FECHA%.backup"
%PG_BIN% -U %PG_USER% -v -F p %PG_DATABASE% > %PG_FILENAME%