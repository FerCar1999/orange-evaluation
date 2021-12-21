# Orange Evaluation Readme

Hola, este es el readme del proyecto de prueba para la empresa orange. En este, se dará a detalle los pasos para instalar la aplicación y poder usarla.

## Versiones utlizadas

Para este proyecto se han utilizado lo siguiente:

- PHP >= 7.3
- Composer 2.1.5 (https://getcomposer.org/)
- Git 2.33.1 (https://git-scm.com/downloads)
- [Laravel 8.x](https://laravel.com/docs/8.x)
- MySQL 5.7

Opcionales
- Docker 20.10.9
- Docker Compose 1.25.0


# Instalación

## Clonando proyecto

Para empezar hay que clonar el repositorio corriendo en consola el siguiente comando:

    git clone https://github.com/FerCar1999/orange-evaluation.git

## Instalando dependencias del proyecto
Luego de clonar el repositorio (y tener composer instalado), entramos a la carpeta del proyecto, abrimos una terminal y ejecutamos el siguiente comando:

    composer install

Una vez finalizada la instalacion, seguimos con el proceso.

## Alternativa para base de datos

Si desea utilizar un servicio de docker para la base de datos. Debe de instalar docker y docker-compose. Una vez instalados, vamos a la raiz del proyecto y ejecutamos el siguiente comando:

    docker-compose up -d

Esto va a tardar un momento ya que esta levantando el servicio de la base e instalando todo lo necesario.
Una vez finalice la instalacion, si necesitamos verificar si nuestro servicio está corriendo, solo ejecutamos el comando

    docker ps

Nos mostrará la lista de nuestros servicios y ahí veremos el de nuestra base de datos.

## Configuracion proyecto
Para seguir con el levantamiento del proyecto, necesitamos generar nuestro archivo `.env`

Para eso solo ejecutamos el siguiente comando en consola:

    cp .env.example .env

Damos enter y nos generará el archivo `.env`

## Generando llave de proyecto

Para generar una key, solo tenemos que ingresar y ejecutar el siguiente comando:

    php artisan key:generate

## Generando llave de JWT

Para generar una key de JWT, solo tenemos que ingresar y ejecutar el siguiente comando:

    php artisan jwt:secret

## Configuracion de .env
Ya teniendo esas 2 llaves importantes en el proyecto, ahora tenemos que configurar todo para acceder a nuestra base de datos.

Para esto, abriremos el archivo `.env` y buscaremos los siguientes campos:

    DB_CONNECTION=mysql 
    DB_HOST=127.0.0.1 (host de nuestra base)
    DB_PORT=3306 (puerto a utlizar, regularmente es el 3306)
    DB_DATABASE=laravel (nombre de la base de datos con la que nos conectaremos)
    DB_USERNAME=root (usuario de conexion)
    DB_PASSWORD= (contraseña del usuario de conexón)

Una vez teniento todo esto modificado para conectar con la base, ejecutaremos el siguiente comando para crear las tablas y almacenar informacion:

    php artisan migrate:fresh --seed

Con esto, crearemos registros en la base.
## Levantando el servidor
Si queremos levantar localmente el servidor y probar las rutas almacenadas en la siguiente [documentación](https://documenter.getpostman.com/view/11275843/UVRBmRps) solo tenemos que ejecutar el siguiente comando:

    php artisan serve