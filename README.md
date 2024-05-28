# AdminDashboard

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
 
<img src="./img/home.png" alt="home" width="70%"/>
<img src="./img/responsive.png" alt="home" width="30%" style="float:right"/>

## Descripción

AdminDashboard es un panel de administración adaptable a cualquier dispositivo, utilizado para el registro de citas, venta de servicios y productos, junto con su registro de ventas y generación de recibos en PDF. También incluye el registro de usuarios y manejo de roles.

<img src="./img/logs.png" alt="home" width="33.33%" style="float:right"/>
<img src="./img/calendar.png" alt="home" width="33.33%" style="float:right"/>
<img src="./img/invoice.png" alt="home" width="33.33%" style="float:right"/>
<div style="clear:both"></div>

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
    git clone https://github.com/eduardoNBD/adminDashboard.git
    cd adminDashboard
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

5. **Configurar smtp:**

    En el archivo `.env`, configura tus credenciales de tu servidor smtp para poder recuperar contraseñas:

    ```dotenv
    MAIL_MAILER=smtp
    MAIL_HOST=mailpit
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="hello@example.com"
    MAIL_FROM_NAME="${APP_NAME}"
    ```

6. **Migrar la base de datos:**

    Ejecuta las migraciones para crear las tablas necesarias y el usuario por default (usuario: admin, password: administrator):

    ```bash
    composer run migrate-user
    ```

7. **Instalar dependencias de JavaScript:**

    Asegúrate de tener [Node.js](https://nodejs.org/) y [npm](https://www.npmjs.com/) instalados y ejecuta:

    ```bash
    npm install
    ```

8. **Compilar Tailwind CSS:**

    Para generar el archivo de salida de Tailwind CSS, ejecuta:

    ```bash
    npm run compileTailwind
    ```

9. **Iniciar el servidor de desarrollo:**

    Finalmente, inicia el servidor de desarrollo de Laravel:

    ```bash
    php artisan serve
    ```

    Tu aplicación debería estar corriendo en `http://localhost:8000`.

## Uso

Accede a `http://localhost:8000` en tu navegador para interactuar con el dashboard de administración. Desde aquí puedes gestionar citas, ventas de servicios y productos, generar recibos en PDF, y administrar usuarios y roles.
 

