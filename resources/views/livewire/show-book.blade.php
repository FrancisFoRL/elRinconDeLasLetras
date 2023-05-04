<x-app-layout>
    <div class="container py-4 mt-lg-5">
        <div class="row">
            <div class="col-lg-4 col-12 me-5">
                <h2 class="mb-3 d-md-none d-block">{{ $book->title }}</h2>
                <img src="{{ asset($book->image) }}" id="book-image" class="img-fluid rounded shadow w-100"
                    alt="{{ $book->title }}">
                <div class="d-flex align-items-center mb-4 mt-2">
                    <h2 class="me-3">PVP: {{ $book->price }} €</h2>
                </div>
                <button wire:click.prevent='store({{$book}})' class="btn btn-primary me-2" title="Añadir al carrito">
                    <i class="fa-solid fa-cart-plus"></i> Añadir al carrito
                </button>
                <button wire:click.prevent='addToWishlist({{ $book->id }})' class="btn btn-secondary"
                    title="Añadir a favoritos el libro">
                    <i class="fa-solid fa-heart"></i> Añadir a favoritos
                </button>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0">
                <h2 class="mb-3 d-md-block d-none">{{ $book->title }}</h2>
                <p class="mb-4">{{ $book->description }}</p>
                <p class="mb-1 fw-bold">Autor: {{ $book->author->name }}</p>
                <p class="mb-1"><span class="fw-bold">Género/s:</span>
                <ul>
                    @foreach($book->category as $category)
                    <li>{{ $category->name }}</li>
                    @endforeach
                </ul>

                </p>
                <p class="mb-3"><span class="fw-bold">Editorial:</span> {{ $book->editorial->name }}</p>
                <p class="mb-2"><span class="fw-bold">Número de páginas:</span> {{ $book->pages }}</p>
            </div>
        </div>

        <h3 class="mt-3">Reviews</h3>
        <div class="mt-3">
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
                        <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                    {{-- <div>
                        Boton de likes reviews
                        <button class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-thumbs-up"></i></button>
                        <button class="btn btn-sm btn-outline-secondary"><i
                                class="fa-solid fa-thumbs-down"></i></button>
                    </div> --}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <style>
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

</x-app-layout>
