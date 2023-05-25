<div class="container py-4 mt-lg-5">
    <div class="row">
        <div class="col-lg-4 col-12 me-5">
            <h2 class="mb-3 d-md-none d-block text-center" style="font-family: Ubuntu">{{ $book->title }}</h2>
            <hr>
            <img src="{{ asset($book->image) }}" id="book-image" class="img-fluid rounded w-100"
                alt="Portada de {{ $book->title }}">
        </div>
        <div class="col-lg-6 mt-4 mt-lg-0">
            <h2 class="mb-3 d-md-block d-none" style="font-family: Ubuntu">{{ $book->title }}</h2>
            <hr>
            <p class="mb-4 p-4" id="desc">{{ $book->description }}</p>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h3 class="mx-lg-1" style="font-family: Ubuntu">Ficha técnica</h3>
                    <div class="p-3 blocks">
                        <p class="mb-2"><span class="fs-5 fw-bold">Autor:</span> {{ $book->author->name }}</p>
                        <p class="mb-2 fw-bold fs-5">Género/s:</p>
                        <ul>
                            @foreach($book->category as $category)
                            <li>{{ $category->name }}</li>
                            @endforeach
                        </ul>

                        </p>
                        <p class="mb-3"><span class="fw-bold fs-5">Editorial:</span> {{ $book->editorial->name }}
                        </p>
                        <p class="mb-2"><span class="fw-bold fs-5">Número de páginas:</span> {{ $book->pages }}</p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mt-5 px-lg-5 ">
                    <div class="d-flex align-items-center mb-4 mt-2">
                        <h2 class="display-6" style="font-family:Ubuntu">PVP: {{ $book->price }} €</h2>
                    </div>
                    <div>
                    <button wire:click.prevent="store({{ $book }})" class="btn buttons" id="compra"
                        title="Añadir al carrito">
                        <i class="fa-solid fa-cart-plus me-1"></i> Añadir al carrito
                    </button>
                    <button wire:click.prevent="addToWishlist({{ $book->id }})" class="btn mt-lg-3 mx-2 mx-lg-0 buttons" id="wishlist" title="Añadir a favoritos el libro">
                        <i class="fa-solid fa-heart m-1"></i> Añadir a favoritos
                    </button>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mt-5 display-6" style="font-family: Ubuntu">Reviews</h3>
    <div class="mt-4">
        @foreach ($book->reviews as $review)
        <div class="card mb-4">
            <div class="card-header d-flex flex-row-reverse align-items-center text-white">
                <p class="mb-0">
                    @for($i = 1; $i <= 5; $i++) <i
                        class="fa-solid fa-star{{ $i <= $review->rating ? '' : '-regular' }}"></i>
                        @endfor
                </p>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $review->comment }}</p>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center bg-light">
                <div>
                    <p class="mb-0">{{ $review->user->name }}</p>
                    <small style="color:#3a3a3a">{{ $review->created_at->diffForHumans() }}</small>
                </div>
                {{-- <div>
                    Boton de likes reviews
                    <button class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-thumbs-up"></i></button>
                    <button class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-thumbs-down"></i></button>
                </div> --}}
            </div>
        </div>
        @endforeach
    </div>
</div>
<style>
    .container {
        font-family: 'Roboto', sans-serif;
    }

    #desc {
        border: 2px solid #212121;
        border-radius: 10px;
    }

    .blocks {
        border: 2px solid #212121;
        border-radius: 10px;
    }

    .buttons {
        width: 200px;
        height: 50px;
    }

    #book-image {
        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px,
            rgba(0, 0, 0, 0.3) 0px 7px 13px -3px,
            rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
    }

    #compra {
        background-color: #6D9886;
        border: 2px solid #212121;
        color: #212121;
    }

    #compra:hover {
        background-color: transparent;
    }

    #wishlist {
        background-color: #B44F3D;
        border: 2px solid #212121;
        color: #FFFFFF;
    }

    #wishlist:hover {
        background-color: transparent;
        color: #212121;
    }

    @media (max-width: 650px) {
        #book-image {
            height: 530px;
        }
    }

    @media (max-width: 990px) {
        #book-image {
            height: 650px;
        }
    }

    .card-header {
        background-color: #212121;
    }
</style>
