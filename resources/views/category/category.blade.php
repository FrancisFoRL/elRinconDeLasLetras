@section('page-title')
{{$category->name}} |
@endsection
<x-app-layout>
    <div class="container">
        <h2 class="text-center mt-4 display-6" style="font-family: Ubuntu">Libros de {{$category->name}}</h2>
        <hr>
        <div class="row">
            @forelse($books as $book)
            <div class="col-lg-3 col-md-5 col-10 mb-4 mx-auto">
                <div class="card h-100 wishlist-card">
                    <a href="{{ route('book.show', $book->slug) }}">
                    <img src="{{ $book->image }}" class="card-img-top" alt="Portada libro {{ $book->title }}">
                    </a>
                    <div class="card-body">
                        <h3 class="card-title fs-5 fw-bold" style="font-family: Roboto">{{ $book->title }}</h3>
                        <p class="card-text">{{ $book->price}}€</p>
                    </div>
                    <div class="card-footer d-flex justify-content-center" style="background-color:#212121">

                    </div>
                </div>
            </div>
            @empty
            <div class="d-flex justify-content-center align-books-center">
                <div class="col-md-12 text-center">
                    <p style="font-size: min(5vw, max(40px)); margin-top: 100px; font-weight: bold">No hubo ningun
                        resultado</p>
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
        {{-- {{ $books->withQueryString()->links() }} --}}
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
