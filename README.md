###### PRUEBA TÉCNICA - Studiogenesis ######

Este proyecto ha sido desarrollado con **Laravel 12**, usa **Bootstrap 5**, **Laravel Breeze** para autenticación y cuenta con funcionalidad completa de gestión de productos, categorías, tarifas, recordatorios y exportaciones a PDF.

# 🧱 Tecnologías utilizadas

- PHP 8.2
- Laravel 12
- MySQL
- Bootstrap 5.3
- Laravel Breeze (autenticación)
- DomPDF (exportación a PDF)
- FullCalendar (calendario interactivo)
- Vite + Laravel Mix (assets)

# 🚀 Requisitos

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL

# ⚙️ Instalación

1. Clona el repositorio
2. Ejecuta los comandos:

composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed          #ejecturá las migraciones y seeders
php artisan storage:link
npm run dev
php artisan serve

Y listo para correr!

# 🔐 Sistema de autenticación
- Laravel Breeze integrado
- Se requiere login para acceder al dashboard
- Incluye gestión de perfil y logout

# 📦 Pasos para crear la base de datos MySQL

1. Acceder a la database -> 127.0.0.1/phpmyadmin
2. Crear nueva database con nombre "pruebatecnica"
3. Utilizar el comando "php artisan migrate" para ejecutar las migraciones. Se crearán las tablas necesarias para poder hacer funcionar el aplicativo. Si fuese necesario, acceder al .env para modificar los parámetros de conexión.
4. Utilizar el comando "php artisan migrate:fresh --seed" para ejecutar las migraciones y el seeder en una sola línea. En caso de que fuese preciso, se puede utilizar "php artisan migrate:fresh" y "php artisan db:seed" para borrar y crecer las tablas y ejecutar el DatabaseSeeder.php

# Estructura destacada

- resources/views/products: formularios, listados y detalles
- resources/views/exports: plantillas PDF
- routes/web.php: rutas protegidas por autenticación
- app/Models: modelos Product, Category, Rate, Reminder
- app/Http/Controllers: lógica de negocio para cada entidad

###### 🧑‍💻 Desarrollado por Ángel Herrador Colino ######