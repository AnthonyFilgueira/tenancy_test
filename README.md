

## Instrucciones para instalacion

- Clonar el repositorio
- Acceder al directorio del proyecto
- Ejecutar comando en consola el comando composer install
    - composer install
    - cp .env.example .env
    - php artisan key:generate
    - php artisan sail:install
    - sail up -d
    - sail artisan migrate
    - sail artisan db:seed
    - sail npm install
    - sail npm run dev

## Usuarios de Acceso Aplicacion Central

- Super Admin 
    - email: superadmin@admin.com
    - pass: password

## Tenants de ejemplo
- empresa1
- empresa2

## Usuarios de Acceso a los Tenants
- Admin 
    - email: admin@admin.com
    - pass: password
- Agent 
    - email: agent@agent.com
    - pass: password

## Funcionalidades Existentes Aplicacion Central
- Creacion y eliminacion de Tenants
- CRUD Usuarios
- Funcionalidad de Login y Registro
- Funcionalidad de Roles y Permisos

## Funcionalidades Existentes en cada Tenant
- CRUD Usuarios
- Funcionalidad de Login y Registro
- Funcionalidad de Roles y Permisos
- CRUD Tasks

## Notas

- Si al momento de ejecutar las migraciones o los seeders le da un error de permisos del usuario Sail debe conectarse a la base de datos y ejecutar este script
    GRANT ALL PRIVILEGES ON *.* TO 'sail'@'%' WITH GRANT OPTION;
    FLUSH PRIVILEGES;
- En algunas partes del codigo se aplico el patron SOLID
- Queda Pendiente mucha refactorizacion de codigo, aplicacion de patron Repository para reutilizacion y abstraccion de consultas al orm, entre otras.
