<x-app-layout>
<div class="container">
    <h2 class="my-lg-4 my-4">Se han encontrado {{$books->count()}} libro/s</h2>
    <hr>
    <div class="row">
        @forelse($books as $book)
        <div class="col-lg-4 col-md-6 col-10 mb-4 mx-auto">
            <div class="card h-100 wishlist-card">
                <img src="{{ $book->image }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title">{{ $book->title }}</h3>
                    <p class="card-text">{{ $book->price}}€</p>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <button class="btn w-25 rounded-pill" id="btn-delete"
                        wire:click="removeFromWishlist({{ $book->id }})" aria-label="Eliminar artículo"><i
                            class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>
        @empty
        <div class="d-flex justify-content-center align-books-center">
            <div class="col-md-12 text-center">
                <p style="font-size: min(5vw, max(40px)); margin-top: 100px; font-weight: bold">Tu lista de deseos está
                    vacía</p>
                <div class="d-flex justify-content-center align-books-center">
                    <lottie-player src="https://assets5.lottiefiles.com/private_files/lf30_x8aowqs9.json"
                        background="transparent" speed="1" style="width: 60vw; height: 20vw; min-height: 200px" loop
                        autoplay>
                    </lottie-player>
                </div>
            </div>
        </div>

        @endforelse
    </div>
</div>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<style>
    .wishlist-card {
        /* From https://css.glass */
        background: rgba(255, 255, 255, 0.2);
        border-radius: 6px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        border: 1px solid rgba(0, 0, 0, 0.4);

        transition: box-shadow 0.3s ease-in-out, opacity 0.3s ease-in-out;
    }

    .wishlist-card:hover {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        opacity: 0.9;
    }

    #btn-delete {
        background-color: #dc3545;
        color: #ffffff;
    }

    #btn-delete:hover {
        background-color: #a71f2b;
        color: #ffffff;
    }

    .card-title {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-img-top {
        height: 350px;
        object-fit: fill;
    }

    @media (max-width: 992px) {
        .container {
            margin-bottom: 100px;
        }
    }
</style>

</x-app-layout>