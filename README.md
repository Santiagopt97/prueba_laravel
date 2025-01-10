# Proyecto Prueba

## Descripción

Este proyecto es una aplicación diseñada para gestionar gastos

## Requisitos

Antes de comenzar, asegúrate de tener los siguientes requisitos instalados en tu sistema:

- Laravel 5.10
- Composer
- Node.js y npm
- SQLite

## Instalación

Sigue estos pasos para instalar y configurar el proyecto en tu entorno local:

1. Clona el repositorio en tu máquina local:
    ```bash
    git clone https://github.com/Santiagopt97/prueba_laravel.git
    ```

2. Navega al directorio del proyecto:
    ```bash
    cd prueba
    ```

3. Instala las dependencias de PHP utilizando Composer:
    ```bash
    composer install
    ```

4. Instala las dependencias de Node.js utilizando npm:
    ```bash
    npm install
    ```

5. Configura las variables de entorno:
    - Crea un archivo `.env` en la raíz del proyecto y añade las siguientes variables:
        ```plaintext
        DB_CONNECTION=sqlite
        ```

6. Ejecuta las migraciones de la base de datos:
    ```bash
    php artisan migrate
    ```

7. Ejecuta los seeders para poblar la base de datos con datos iniciales:
    ```bash
    php artisan db:seed
    ```

## Uso

Para ejecutar la aplicación, utiliza el siguiente comando:

```bash
composer run dev
```

La aplicación debería estar disponible en http://localhost:8000.



