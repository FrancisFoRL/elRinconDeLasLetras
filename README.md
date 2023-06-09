<p align="center">
<img src="https://raw.githubusercontent.com/FrancisFoRL/elRinconDeLasLetras/master/img/Logo.svg" width="120" height="100" style="text-align:center">
</p>

<h1 align="center">
    El Rincón de las Letras
</h1>

El Rincón de las Letras es una tienda en línea de libros que ofrece una amplia variedad de títulos para lectores de todas las edades e intereses. Se dedica a proporcionar una experiencia de compra de libros en línea fácil, accesible y agradable para los clientes.

## 📋 Tabla de Contenidos

- [Descripción](#descripción)
- [Instalación](#instalación)
- [Uso](#uso)
- [Posibles errores](#⚠️-posibles-errores)
- [Licencia](#licencia)
- [Contacto](#contacto)

## 📖 Descripción

El Rincón de las Letras es una plataforma web dedicada a la venta de libros en línea. Nuestro objetivo es brindar a los amantes de la lectura una experiencia única y conveniente para explorar, descubrir y adquirir una amplia variedad de libros de diferentes géneros y autores.

## 🚀 Instalación

Para la instalación y puesta en marcha de projecto nos hara falta lo siguiente: 

- PHP 8.0 o superior.
- Laravel 9.5.2 o superior.
- Jetstream y Livewire.
- Composer
- MySQL

Cuando se cumplan todos los requisitos anteriores y se clone en projecto habra hacerlos siguientes comandos:
    
    composer install
    composer update 

Con esto tendriamos ya todas las dependencias necesarias para que el projecto funcione. 
Paso seguido tendremos que indicar la demas configuraciones en el .env de projecto:

    cp .env.example .env

Generaremos una key nueva para el projecto: 

    php artisan key:generate

Crearemos también un enlace simbolico, ya que usamos como almacenamiento storage:

    php artisan storage:link

Una vez ya añadida nuestra base de datos, ya por ultimo podremos ejecutar las migraciones, para crear las tablas necesarias para el projecto:

    php artisan migrate

## 💡 Uso

- **Explora el catálogo:** Navega por nuestro amplio catálogo de libros para descubrir nuevas lecturas. Utiliza la barra de búsqueda para encontrar libros por título. También puedes explorar las secciones destacadas.

- **Detalles de los libros:** Haz clic en un libro para acceder a su página de detalles. Allí encontrarás información completa sobre el libro, el autor, las reseñas de otros lectores y la disponibilidad.

- **Añadir al carrito:** Cuando encuentres un libro que desees compra, simplemente haz clic en el botón "Añadir al carrito". Puedes ajustar la cantidad deseada y el carrito se actualizará automáticamente. ¿Cual será tu proxima historia?

- **Proceso de compra:** Una vez que hayas seleccionado todos los libros que deseas comprar, ve a tu carrito y revisa los detalles. Confirma tus libros seleccionados y procede al proceso de pago. Proporciona la información de envío requerida y elige el método de pago que prefieras. Nuestro proceso de pago es seguro y protegido, a traves de Paypal o tarjeta de crédito o débito.

- **Historial de pedidos:** Si deseas revisar tus compras anteriores, puedes acceder a tu historial de pedidos. Allí encontrarás información detallada sobre cada compra, incluyendo los libros adquiridos en dicha compra.

## ⚠️ Posibles errores

### Bootstrap 5 no carga los estilos

Puede ocurrir el caso en el que después de clonar el proyecto y lo despleguemos, no se muestren correctamente los estilos de este. Esto es debido a que Bootstrap no se cargó correctamente.
Para solucionar este error, deberemos volver a instalar Bootstrap 5 en el proyecto.

Comenzamos abriendo una terminal y ejecutamos el siguiente comando para instalar Boostrap 5:

    composer require twbs/bootstrap:5.3.0-alpha1 

Ahora instalamos Laravel UI ejecutando el siguiente comando en la consola de comandos:

    composer require laravel/ui:* 

Tendremos que usar scaffolding ui bootstrap, para ello ejecuto el siguiente comando en la consola:

    php artisan ui bootstrap

Paso seguido ejecutamos el siguiente comando para instalar las dependencias necesarias:

    npm install 

Cuando ejecutamos el comando anterior, se nos ha creará un directorio llamado node_modules en el directorio principal del proyecto.

Ahora vamos ha importar Bootstrap 5 en el archivo vite.config.js. Este archivo se encuentra en el directorio principal del proyecto:

    import { defineConfig } from 'vite';
    import laravel from 'laravel-vite-plugin';
    import path from 'path';
    
    export default defineConfig({
        plugins: [
            laravel({
                input: [
                    'resources/sass/app.scss',
                    'resources/js/app.js',
                ],
                refresh: true,
                // Importamos Bootstrap 5 
                resolve:{
                    alias:{
                        '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
                    }
                },
                // Fin Importamos Bootstrap 5 
            }),
        ],
    });

Paso seguido abrimos el archivo bootstrap.js e importamos el archivo app.scss. El archivo bootstrap.js se encuentra en resources > js > bootstrap.js:

    // importamos el archivo app.scss 
    import '../sass/app.scss';

Luego ejecutamos el siguiente comando para compilar todo lo configurado:

    npm run build

Se nos habran creado algunos archivos necesarios como el CSS y JS de Bootstrap 5 en el directorio public.

Con esto, nuestro projecto deberia detectar correctamente Bootstrap 5 y mostrar el diseño de la web correctamente.

## 📝 Licencia

Este proyecto está licenciado bajo la Licencia MIT. Consulte el archivo [LICENSE](LICENSE.md) para obtener más información.

## 📧 Soporte

Si tienes algún problema o necesitas ayuda con este proyecto, puedes abrir un nuevo issue en el repositorio de GitHub o contactarme por correo electrónico a [francis.cb12@gmail.com](mailto:support@example.com).