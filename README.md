# AdminDashboard

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)

## Descripción

AdminDashboard es un panel de administración utilizado para el registro de citas, venta de servicios y productos, junto con su registro de ventas y generación de recibos en PDF. También incluye el registro de usuarios y manejo de roles.

## Tecnologías Usadas

- **PHP**
- **JavaScript**

## Frameworks

- **Laravel** ![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
- **Tailwind CSS** ![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)

## Instalación

Sigue estos pasos para configurar y ejecutar el proyecto:

1. **Clonar el repositorio:**

    ```bash
    git clone https://github.com/tu-usuario/admindashboard.git
    cd admindashboard
    ```

2. **Instalar dependencias de PHP:**

    Asegúrate de tener [Composer](https://getcomposer.org/) instalado y ejecuta:

    ```bash
    composer install
    ```

3. **Configurar el archivo `.env`:**

    Copia el archivo `.env.example` a `.env` y configura tu entorno:

    ```bash
    cp .env.example .env
    ```

    Luego, genera la clave de la aplicación:

    ```bash
    php artisan key:generate
    ```

4. **Configurar la base de datos:**

    En el archivo `.env`, configura tus credenciales de base de datos:

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_tu_base_de_datos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```

5. **Migrar la base de datos:**

    Ejecuta las migraciones para crear las tablas necesarias:

    ```bash
    php artisan migrate
    ```

6. **Instalar dependencias de JavaScript:**

    Asegúrate de tener [Node.js](https://nodejs.org/) y [npm](https://www.npmjs.com/) instalados y ejecuta:

    ```bash
    npm install
    ```

7. **Compilar Tailwind CSS:**

    Para generar el archivo de salida de Tailwind CSS, ejecuta:

    ```bash
    npm run compileTailwind
    ```

8. **Iniciar el servidor de desarrollo:**

    Finalmente, inicia el servidor de desarrollo de Laravel:

    ```bash
    php artisan serve
    ```

    Tu aplicación debería estar corriendo en `http://localhost:8000`.

## Uso

Accede a `http://localhost:8000` en tu navegador para interactuar con el dashboard de administración. Desde aquí puedes gestionar citas, ventas de servicios y productos, generar recibos en PDF, y administrar usuarios y roles.

## Contribuciones

Las contribuciones son bienvenidas. Por favor, abre un issue o envía un pull request con tus mejoras y correcciones.

## Licencia

Este proyecto está licenciado bajo la [MIT License](https://opensource.org/licenses/MIT).
