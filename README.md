<p align="center">
<img src="https://raw.githubusercontent.com/FrancisFoRL/
elRinconDeLasLetras/master/Logo.svg" width="120" height="100" style="text-align:center">
</p>

<h1 align="center">
    El Rincón de las Letras
</h1>

El Rincón de las Letras es una tienda en línea de libros que ofrece una amplia variedad de títulos para lectores de todas las edades e intereses. Se dedica a proporcionar una experiencia de compra de libros en línea fácil, accesible y agradable para los clientes.

## 📋 Tabla de Contenidos

- [Descripción](#descripción)
- [Instalación](#instalación)
- [Uso](#uso)
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

Una vez ya añadida nuestra base de datos, ya por ultimo podremos ejecutar las migraciones, para crear las tablas necesarias para el projecto:

    php artisan migrate

## 💡 Uso

- **Explora el catálogo:** Navega por nuestro amplio catálogo de libros para descubrir nuevas lecturas. Utiliza la barra de búsqueda para encontrar libros por título. También puedes explorar las secciones destacadas.

- **Detalles de los libros:** Haz clic en un libro para acceder a su página de detalles. Allí encontrarás información completa sobre el libro, el autor, las reseñas de otros lectores y la disponibilidad.

- **Añadir al carrito:** Cuando encuentres un libro que desees compra, simplemente haz clic en el botón "Añadir al carrito". Puedes ajustar la cantidad deseada y el carrito se actualizará automáticamente. ¿Cual será tu proxima historia?

- **Proceso de compra:** Una vez que hayas seleccionado todos los libros que deseas comprar, ve a tu carrito y revisa los detalles. Confirma tus libros seleccionados y procede al proceso de pago. Proporciona la información de envío requerida y elige el método de pago que prefieras. Nuestro proceso de pago es seguro y protegido, a traves de Paypal o tarjeta de crédito o débito.

- **Historial de pedidos:** Si deseas revisar tus compras anteriores, puedes acceder a tu historial de pedidos. Allí encontrarás información detallada sobre cada compra, incluyendo los libros adquiridos en dicha compra.

## 📝 Licencia

Indica la licencia del proyecto y cualquier información adicional sobre los derechos de autor o las restricciones de uso.

## 📧 Contacto

Si tienes alguna pregunta, comentario o inquietud relacionada con el projecto, te invito a ponerte en contacto a través de los canales de contacto. Estaremos encantados de ayudarte y brindarte la información necesaria.

- **Correo electrónico:** francis.cb12@gmail.com