@section('page-title')
Sobre Nosotros |
@endsection
<x-app-layout>
    <div class="container">
        <h2 class="text-center mt-4 display-6" style="font-family: Ubuntu">Sobre Nosotros</h2>
        <hr>
        <div class="row p-5 pt-4">
            <div class="col-12 col-md-6 p-5" style="background-color: #212121; color:#D9D9D9">
                <h3>
                    Nuestra Tienda Online: Tu Puerta al Mundo de la Literatura
                </h3>
                <p class="pt-3 ">
                    En el Rincón de los Libros, creemos en la importancia de ofrecer una experiencia de compra cómoda y
                    accesible para nuestros clientes. Nuestra tienda online es tu puerta de entrada al fascinante mundo
                    de la literatura. Desde la comodidad de tu hogar, puedes explorar nuestro amplio catálogo, obtener
                    información detallada sobre cada libro y realizar tus compras de manera rápida y segura. ¡Te
                    invitamos a sumergirte en la diversidad de géneros, autores y títulos que tenemos para ti!
                </p>
            </div>
            <div class="col-12 col-md-6 p-5" id="col2">
                <h3>
                    Un Catálogo para Todos los Gustos y Necesidades
                </h3>
                <p class="pt-3 ">
                    En el Rincón de los Libros, creemos en la importancia de ofrecer una experiencia de compra cómoda y
                    accesible para nuestros clientes. Nuestra tienda online es tu puerta de entrada al fascinante mundo
                    de la literatura. Desde la comodidad de tu hogar, puedes explorar nuestro amplio catálogo, obtener
                    información detallada sobre cada libro y realizar tus compras de manera rápida y segura. ¡Te
                    invitamos a sumergirte en la diversidad de géneros, autores y títulos que tenemos para ti!
                </p>
            </div>
            <div class="col-12 col-md-6 p-5" id="col3">
                <h3>
                    Pasión por la Lectura y Atención al Cliente
                </h3>
                <p class="pt-3 ">
                    En el Rincón de los Libros, compartimos una pasión profunda por la lectura y queremos transmitirla a
                    nuestros clientes. Nuestro equipo de expertos en literatura está listo para brindarte atención
                    personalizada y recomendaciones únicas. Si tienes alguna pregunta, inquietud o necesitas
                    orientación, estamos aquí para ayudarte en cada paso del camino. Queremos asegurarnos de que
                    encuentres los libros perfectos que enriquecerán tu experiencia de lectura.
                </p>
            </div>
            <div class="col-12 col-md-6 p-5" style="background-color: #212121; color:#D9D9D9" id="col4">
                <h3>
                    Apoyo a la Literatura y a los Escritores
                </h3>
                <p class="pt-3 ">
                    En el Rincón de los Libros, creemos en el poder de las palabras y en la importancia de apoyar a los
                    escritores y a la industria editorial. Trabajamos estrechamente con autores independientes y
                    editoriales emergentes para dar a conocer nuevas voces y obras literarias. Cada libro tiene una
                    historia que contar, y nos enorgullece ser una plataforma para difundir esas historias al mundo. Al
                    elegir el Rincón de los Libros, estás apoyando a la comunidad literaria y contribuyendo al
                    florecimiento de la creatividad y la diversidad en la escritura.
                </p>
            </div>
            <div class="col-12 col-md-6 p-5" style="background-color: #212121; color:#D9D9D9">
                <h3>
                    Comprometidos con la Sostenibilidad
                </h3>
                <p class="pt-3 ">
                    En el Rincón de los Libros, nos preocupamos por el impacto ambiental y nos esforzamos por adoptar
                    prácticas sostenibles en nuestra operación diaria. Trabajamos con proveedores comprometidos con la
                    preservación del medio ambiente y utilizamos materiales de embalaje reciclables. Nuestro objetivo es
                    minimizar nuestro consumo de energía y reducir nuestra huella ecológica, para que puedas disfrutar
                    de tus libros favoritos sabiendo que también estás contribuyendo a un mundo más verde.
                </p>
            </div>
            <div class="col-12 col-md-6 p-5" id="col6">
                <h3>
                    Únete a Nosotros en este Viaje Literario
                </h3>
                <p class="pt-3 ">
                    En el Rincón de los Libros, estamos emocionados de ser parte de tu viaje literario. Queremos ser tu
                    compañero de confianza en la búsqueda de exploración literaria y descubrimiento de nuevos
                    horizontes. Nuestro objetivo es crear un espacio virtual donde puedas sumergirte en historias
                    cautivadoras, ampliar tus conocimientos y encontrar inspiración en cada página.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
<x-footer />

<style>
    h3 {
        font-family: 'Ubuntu';
    }

    .container p {
        text-align: justify;
    }

    #col2 {
        border-right: 2px solid #212121;
        border-top: 2px solid #212121;
    }

    #col3 {
        border-left: 2px solid #212121;
    }

    #col6 {
        border-right: 2px solid #212121;
        border-bottom: 2px solid #212121;
    }

    @media(max-width:767px) {
        #col2, #col6{
            border-right: 2px solid #212121;
            border-left: 2px solid #212121;
        }

        #col3{
            border: none;
            background-color: #212121;
            color: #D9D9D9;
        }

        #col4{
            background-color: transparent !important;
            color: black !important;
            border-right: 2px solid #212121;
            border-left: 2px solid #212121;
        }
    }
</style>
