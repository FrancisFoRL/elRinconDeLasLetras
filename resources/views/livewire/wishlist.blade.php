<div class="container">
    <h2 class="my-lg-4 my-4">Lista de deseos</h2>
    <hr>
    <div class="row">
        @forelse($wishlist as $item)
        <div class="col-lg-4 col-md-6 col-10 mb-4 mx-auto">
            <div class="card h-100 wishlist-card">
                <img src="{{ $item->book->image }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title">{{ $item->book->title }}</h3>
                    <p class="card-text">{{ $item->book->price}}€</p>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <button class="btn w-25 rounded-pill" id="btn-delete" wire:click="removeFromWishlist({{ $item->id }})" aria-label="Eliminar artículo"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>
        @empty
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-md-12 text-center">
                <p style="font-size: min(5vw, max(40px)); margin-top: 100px; font-weight: bold">Tu lista de deseos está
                    vacía</p>
                <div class="d-flex justify-content-center align-items-center">
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

<style>
    .wishlist-card {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        transition: box-shadow 0.3s ease-in-out, opacity 0.3s ease-in-out;
    }

    .wishlist-card:hover {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        opacity: 0.9;
    }

    #btn-delete{
        background-color: #dc3545;
        color: #ffffff;
    }

    #btn-delete:hover{
        background-color: #a71f2b;
        color: #ffffff;
    }

    .card-title{
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-img-top {
        height: 350px;
        object-fit: fill;
    }

    @media (max-width: 992px) {
        .container{
            margin-bottom: 100px;
        }
    }
</style>







{{-- <div class="container">
    <h2 class="my-lg-5 my-3">Lista de deseos</h2>
    <hr>

    <div class="row">
        @forelse($wishlist as $item)
        <div class="col-md-4">
            <div class="card mb-3">
                <img src="{{ $item->book->image }}" class="card-img-top" alt="{{ $item->book->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->book->name }}</h5>
                    <p class="card-text">{{ $item->book->description }}</p>
                    <p class="card-text"><strong>Price:</strong> {{ $item->book->price }}</p>
                    <button type="submit" class="btn btn-danger" wire:click="removeFromWishlist({{ $item->id }})">Remove
                        from Wishlist</button>
                </div>
            </div>
        </div>
        @empty
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-md-12 text-center">
                <p style="font-size: min(5vw, max(40px)); margin-top: 100px; font-weight: bold">Tu lista de deseos está
                    vacía</p>
                <div class="d-flex justify-content-center align-items-center">
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
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script> --}}
