<main>
    <section>
        <article>
            <div id="carouselExampleIndicators" class="carousel slide h-" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ Storage::url('welcome/carrusel1.jpeg') }}" class="d-block w-100 h-100"
                            alt="ImagenSalon">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ Storage::url('welcome/carrusel1.jpeg') }}" class="d-block w-100 h-100"
                            alt="ImagenSalon">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ Storage::url('welcome/carrusel1.jpeg') }}" class="d-block w-100 h-100"
                            alt="ImagenSalon">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ Storage::url('welcome/carrusel1.jpeg') }}" class="d-block w-100 h-100 "
                            alt="ImagenSalon">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior Imagen</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente Imagen</span>
                </a>
            </div>
        </article>
    </section>

    <section class="my-md-5 my-4">
        <article class="col-11 col-md-10 mx-auto">
            <h2 class="mb-4">Productos Destacados</h2>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-6 g-2 g-md-4">
                @foreach ($books as $book)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset($book->image) }}" class="card-img-top" alt="...">
                        <div class="card-body pb-0 pt-2">
                            <h3 class="card-title book-title">{{$book->title}}</h3>
                        </div>
                        <div class="card-footer p-2 align-items-center d-flex justify-content-between"
                            style="background-color: #212121">
                            <p class="card-text m-0 fw-bold">{{$book->price}}€</p>
                            <div class="d-flex ">
                                <button wire:click.prevent='store({{$book}})' class="card-button p-2 px-3 me-1" title="Añadir al carrito">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>
                                <button wire:click.prevent='addToWishlist({{ $book->id }})' class="card-button p-2 px-3" title="Añadir a favoritos el libro">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </article>
    </section>
</main>

<footer>
    footer
</footer>

<!-- Styles -->
<style>
    .card-body {
        background-color: #e9e9e9;
    }

    .card img {
        height: 210px;
    }

    .card-title {
        font-weight: bold;
    }

    .card-text {
        color: #6D9886;
    }

    .card-button {
        background-color: #6D9886;
        border: none;
        color: white;
        padding: 5px 15px 5px 15px;
        border-radius: 5px;
    }

    footer {
        background-color: #212121;
    }

    @media (min-width: 992px) {
        .carousel-item {
            height: 500px;
        }

        .card-title {
            font-size: 20px
        }

        article h2 {
            font-size: 35px;
        }
    }
</style>
<script>
    window.onload = function() {
            let bookTitle = document.getElementsByClassName("card-title");
            let limiteCaracteres = 30;

            for (var i = 0; i < bookTitle.length; i++) {
                if (bookTitle[i].textContent.length > 30){
                    bookTitle[i].textContent = bookTitle[i].textContent.slice(0, limiteCaracteres) + "...";
                }
            }
        }
</script>
