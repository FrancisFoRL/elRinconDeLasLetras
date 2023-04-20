<div class="container">
    <h2 class="mt-5">Lista de deseos</h2>
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
                <p style="font-size: 40px">Tu lista de deseos está vacía</p>
                <div class="d-flex justify-content-center align-items-center">
                    <lottie-player src="https://assets5.lottiefiles.com/private_files/lf30_x8aowqs9.json"
                        background="transparent" speed="1" style="width: 500px; height: 500px; margin-top:-100px" loop autoplay>
                    </lottie-player>
                </div>
            </div>
        </div>

        @endforelse
    </div>

</div>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
