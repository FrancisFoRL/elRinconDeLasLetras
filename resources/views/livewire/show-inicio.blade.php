<main>
    <x-messages/>
    <section>
        <article>
            <div id="carouselExampleIndicators" class="carousel slide   " data-bs-ride="carousel">
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
            <h2 class="mb-5 display-6" style="font-family: 'Ubuntu', sans-serif;">Productos Destacados</h2>
            <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-6 g-2 g-md-4">
                @foreach ($books as $book)
                <div class="col-md-4">
                    <div class="card shadow">
                        <a href="{{ route('book.show', $book->slug) }}">
                            <div class="card-img-container">
                                <img src="{{ asset($book->image) }}" class="card-img-top" alt="{{$book->title}}">
                            </div>
                        </a>
                        <div class="card-body text-center">
                            <h3 class="card-title book-title" style="font-family: 'Ubuntu', sans-serif;">{{ $book->title
                                }}</h3>
                            <p class="card-text text-muted" style="color:#3f3f3f !important;">{{ $book->author->name }}
                            </p>
                            <p class="card-text">{{ $book->price }}€</p>
                        </div>
                        <div class="card-footer d-flex justify-content-center align-items-center">
                            <button wire:click.prevent="store({{ $book }})" class="btn btn-cart me-2"
                                title="Añadir al carrito">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                            <button wire:click.prevent="addToWishlist({{ $book->id }})" class="btn btn-fav"
                                title="Añadir a favoritos el libro">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </article>
    </section>
</main>

<x-footer/>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<!-- Styles -->
<style>
    .card {
        color: #212121;
        overflow: hidden;
        transition: all 0.3s ease;
        background: rgba(248, 250, 252, 0);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(0px);
        -webkit-backdrop-filter: blur(0px);
        border: 1px solid rgba(248, 250, 252, 1);
    }

    .card:hover {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.4) !important;
        transform: translateY(-5px);
    }

    .card-img-container {
        position: relative;
    }

    .card-img-container::before {
        content: "";
        display: block;
        padding-top: 100%;
    }

    .card-img-top {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .book-title,
    .card-text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .btn-cart {
        background-color: #6D9886;
        color: #f8fafc;
    }

    .btn-cart:hover {
        background-color: #4F766B;
        color: #f8fafc;
    }

    .btn-fav {
        background-color: #212121;
        color: #f8fafc;
    }

    .btn-fav:hover {
        background-color: #5a6268;
        color: #DC143C;
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

    #flash-message-success {
        position: fixed;
        top: 100px;
        right: 20px;
        background-color: #333;
        color: #fff;
        padding: 20px;
        border-radius: 5px;
        font-family: Arial, sans-serif;
        font-size: 18px;
        z-index: 999;
    }

    @keyframes slideOutRight {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            transform: translateX(100%);
        }
    }
</style>
{{-- <script>
    window.onload = function() {
            let bookTitle = document.getElementsByClassName("card-title");
            let limiteCaracteres = 30;

            for (var i = 0; i < bookTitle.length; i++) {
                if (bookTitle[i].textContent.length > 30){
                    bookTitle[i].textContent = bookTitle[i].textContent.slice(0, limiteCaracteres) + "...";
                }
            }
        }
</script> --}}
