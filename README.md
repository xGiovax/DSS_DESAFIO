# DataAuditLabs

Sistema web de gestión de tareas para empleados desarrollado como proyecto académico.

## Descripción

DataAuditLabs permite a los empleados gestionar sus tareas personales de forma organizada.
Incluye tres implementaciones para demostrar distintas tecnologías web:

- **mvc_nativo** → PHP puro con patrón MVC + Autenticación + CRUD + AJAX
- **laravel_tareas** → CRUD completo usando el framework Laravel
- **ajax** → Cambio de estado de tareas sin recargar la página

---

## Tecnologías utilizadas

- PHP 8.2
- MySQL (puerto 3307 en XAMPP)
- Laravel 12
- JavaScript (Fetch API para AJAX)
- HTML/CSS puro

---

## Estructura del proyecto

```
DataAuditLabs/
├── mvc_nativo/
│   ├── config/         → Configuración de base de datos
│   ├── controllers/    → AuthController, TareasController
│   ├── models/         → Usuario.php, Tarea.php
│   ├── views/          → Vistas PHP (auth y tareas)
│   ├── libs/           → Router.php
│   ├── index.php       → Punto de entrada
│   └── .htaccess       → Reescritura de URLs
├── laravel_tareas/
│   ├── app/            → Modelos y Controladores
│   ├── database/       → Migraciones
│   ├── resources/      → Vistas Blade
│   └── routes/         → web.php
├── ajax/
│   └── cambiar_estado.php → Endpoint AJAX
├── database/
│   └── script.sql      → Script completo de la BD
├── screenshots/        → Capturas de pantalla
├── README.md
└── .gitignore
```

---

## Requisitos previos

- XAMPP instalado con Apache y MySQL corriendo
- Composer instalado (https://getcomposer.org)
- Node.js instalado (https://nodejs.org)

---

## Instalación paso a paso

### 1. Copiar el proyecto

Copiar la carpeta `DataAuditLabs` dentro de:
```
C:\xampp\htdocs\
```

### 2. Crear la base de datos

1. Abrir XAMPP y arrancar Apache y MySQL
2. Ir a http://localhost/phpmyadmin
3. Hacer clic en la pestaña SQL
4. Copiar y ejecutar el contenido de `database/script.sql`

### 3. Configurar MVC Nativo

El archivo `mvc_nativo/config/database.php` ya viene configurado para XAMPP con puerto 3307.
Si tu MySQL usa el puerto 3306 estándar, cambiar la línea:
```php
define('DB_PORT', '3307');
```
por:
```php
define('DB_PORT', '3306');
```

### 4. Configurar Laravel

Abrir una terminal en la carpeta `laravel_tareas` y ejecutar:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

Editar el archivo `laravel_tareas/.env` con estos valores:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=dataauditlabs
DB_USERNAME=root
DB_PASSWORD=
SESSION_DRIVER=file
```

---

## URLs de acceso

| Módulo         | URL                                                                 |
|----------------|---------------------------------------------------------------------|
| MVC Nativo     | http://localhost/DataAuditLabs/mvc_nativo/?url=auth/login           |
| Laravel        | http://localhost/DataAuditLabs/laravel_tareas/public                |

---

## Funcionalidades implementadas

### MVC Nativo (mvc_nativo/)
- Registro de usuarios con validación
- Inicio y cierre de sesión con sesiones PHP
- CRUD completo de tareas (crear, leer, actualizar, eliminar)
- Cada usuario ve únicamente sus propias tareas
- Cambio de estado pendiente/completada mediante AJAX sin recargar la página
- Contraseñas encriptadas con password_hash (BCRYPT)

### Laravel (laravel_tareas/)
- Registro e inicio de sesión con Auth de Laravel
- CRUD completo de tareas usando Eloquent ORM
- Validaciones con reglas de Laravel
- Vistas con sistema de plantillas Blade
- Cambio de estado mediante AJAX
- Cada usuario ve únicamente sus propias tareas

---

## Base de datos

Tablas utilizadas:

| Tabla     | Descripción                          |
|-----------|--------------------------------------|
| usuarios  | Usuarios del módulo MVC Nativo       |
| users     | Usuarios del módulo Laravel          |
| tareas    | Tareas compartidas entre módulos     |

---

## Declaración Obligatoria de Uso de IA

| Herramienta | Parte del proyecto | Tipo de ayuda | ¿Entiende el código? |
|-------------|-------------------|---------------|----------------------|
| Claude (Anthropic) | login.php / registro.php | Generación de estructura y explicación de password_verify() | Sí |
| Claude (Anthropic) | AuthController.php | Explicación de sesiones PHP y validaciones | Sí |
| Claude (Anthropic) | TareasController.php | Generación de lógica CRUD y ejemplos de sintaxis | Sí |
| Claude (Anthropic) | Router.php | Explicación del patrón MVC y enrutamiento | Sí |
| Claude (Anthropic) | AJAX / cambiar_estado.php | Explicación de fetch() y manejo de respuestas JSON | Sí |
| Claude (Anthropic) | Laravel (controladores y vistas Blade) | Generación de código y depuración de errores | Sí |

Declaramos que: Todo el código entregado ha sido comprendido, modificado cuando fue necesario, y podemos explicar su funcionamiento en la defensa.

Firma del integrante 1: Giovanni Ruano

Firma del integrante 2: Beatriz Marroquin
