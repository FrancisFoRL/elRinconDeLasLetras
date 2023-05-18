<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 d-none d-lg-block">
                <x-nav-perfil />
            </div>
            <div class="col-12 col-lg-10">
                <div class="mx-auto m-4 p-4" id="contendor-princ">
                    <h2 class="display-6 mb-4">Mis Opiniones</h2>
                    <div class="mt-5">
                        @foreach ($reviews as $review)
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between  align-items-center text-white" style="background-color: #212121;">
                                <div>
                                    <span>Opinión del libro <b>{{$review->book_title}}</b></span>
                                </div>
                                <p class="mb-0 flex-row-reverse">
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
                                    <p class="mb-0 fw-bold">{{ $review->user->name }}</p>
                                    <small>{{ $review->created_at->diffForHumans() }}</small>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
     #contendor-princ {
        border: 2px solid #222222;
        border-radius: 15px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    }

    h2 {
        font-family: 'Ubuntu', sans-serif;
    }
</style>
