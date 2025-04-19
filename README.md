# 🎾 Proyecto ATP - Gestión de Tenistas y Torneos

Este proyecto web ha sido desarrollado utilizando **Laravel** con el objetivo de simular una pequeña plataforma de gestión de **tenistas profesionales** y su participación en **torneos ATP**. La aplicación permite visualizar tenistas, torneos y gestionar su relación, en un entorno claro, moderno y funcional.

Está pensado como una demostración educativa del uso de **Laravel 10**, enfocándose en aspectos clave como el uso de migraciones, seeders, relaciones entre modelos, controladores y vistas Blade.

---

## 🌟 Descripción general

La plataforma permite:
- Mostrar una lista de **tenistas registrados**
- Consultar la **información individual** de cada tenista
- Crear, editar o eliminar **torneos ATP**
- Asignar uno o varios tenistas a un torneo específico (relación **muchos a muchos**)
- Usar formularios web para realizar acciones de forma intuitiva
- Visualizar los torneos en los que ha participado cada tenista

Todo esto sobre una base de datos relacional bien estructurada, con un diseño claro y adaptado a móviles gracias a **Bootstrap**.

---

## 🧠 Funcionalidades principales

- CRUD completo de tenistas
- CRUD completo de torneos
- Relación muchos a muchos entre tenistas y torneos
- Formularios y validaciones en el lado del servidor
- Vistas Blade personalizadas para cada sección
- Seeders para poblar la base de datos con ejemplos reales

---

## 🛠️ Tecnologías utilizadas

- **Lenguaje**: PHP 8+
- **Framework**: Laravel 10
- **Frontend**: Blade Templates + Bootstrap 5
- **Base de datos**: MySQL o SQLite
- **ORM**: Eloquent
- **Manejo de rutas**: Laravel Web Routes
- **Herramientas de desarrollo**: Laravel Artisan, Composer

---

## ⚙️ Cómo ejecutar el proyecto

### Requisitos
- PHP 8+
- Composer
- MySQL / SQLite
- Laravel instalado globalmente o Laravel Sail

### Pasos para correr la app
```bash
git clone https://github.com/tuusuario/proyecto-tenistas-laravel.git
cd proyecto-tenistas-laravel
composer install
cp .env.example .env
php artisan key:generate
# Configurar base de datos en el archivo .env
php artisan migrate --seed
php artisan serve
```

Accede desde tu navegador a:  
[http://localhost:8000](http://localhost:8000)

---

## 📁 Estructura del proyecto

```
├── app/
│   └── Models/
│       ├── Tenista.php
│       └── Torneo.php
├── resources/
│   └── views/
│       ├── tenistas/
│       └── torneos/
├── routes/
│   └── web.php
├── database/
│   ├── migrations/
│   └── seeders/
```

---

## 🎯 Objetivo del proyecto

Este proyecto tiene fines educativos y fue creado para **practicar el uso de relaciones entre entidades en Laravel**, la creación de formularios, la implementación de vistas personalizadas y la estructuración de una aplicación MVC realista.

También es una excelente base para expandir con más funcionalidades, como autenticación, subida de imágenes, estadísticas por jugador, etc.

---

## 🤝 Autor

**Kevin Bermúdez**  
_Técnico Superior en Desarrollo de Aplicaciones Web_  
💡 Amante del desarrollo web y los retos de programación.

---

## 📄 Licencia

Este proyecto está licenciado bajo **MIT**. Puedes usarlo libremente para proyectos personales, educativos o como base para desarrollos más avanzados.
