@if ($paginator->hasPages())
<nav class="d-flex justify-items-center justify-content-between">
    <div class="d-flex justify-content-center flex-fill d-sm-none">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link" style="background-color: #212121; color:#F2F2F2"><i class="fa-solid fa-chevron-left"></i> Anterior</span>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                    rel="prev" style="background-color: #212121; color:#F2F2F2"><i class="fa-solid fa-chevron-left"></i> Anterior</a>
            </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" style="background-color: #212121; color:#F2F2F2" href="{{ $paginator->nextPageUrl() }}" rel="next">Siguiente <i class="fa-solid fa-chevron-right"></i></a>
            </li>
            @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link" style="background-color: #212121; color:#F2F2F2">Siguiente <i class="fa-solid fa-chevron-right"></i></span>
            </li>
            @endif
        </ul>
    </div>

    <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
        <div>
            <p class="border border-dark border-2 p-2 rounded" style="color:#212121">
                {!! __('Viendo') !!}
                <span class="fw-bold" style="color:#8B0000">{{ $paginator->firstItem() }}</span>
                {!! __('a') !!}
                <span class="fw-bold" style="color:#8B0000">{{ $paginator->lastItem() }}</span>
                {!! __('de los') !!}
                <span class="fw-bold" style="color:#8B0000">{{ $paginator->total() }}</span>
                {!! __('resultados') !!}
            </p>
        </div>

        <div>
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="Página anterior">
                    <span class="page-link" style="color:#212121; border: 1px solid #212121;" aria-hidden="true" ><i class="fa-solid fa-chevron-left"></i></span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" style="color:#212121; border: 1px solid #212121;" rel="prev"
                        aria-label="Página anterior">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li class="page-item active" aria-current="page"><span class="page-link fw-bold fs-5"
                        style="background-color: #8B0000; color:#F2F2F2; border: 2px solid #B8860B; border-radius:5px">{{
                        $page }}</span></li>
                @else
                <li class="page-item"><a class="page-link" style="background-color: #212121; color:#F2F2F2"
                        href="{{ $url }}">{{ $page }}</a></li>
                @endif
                @endforeach
                @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        style="color:#212121; border: 1px solid #212121;" aria-label="Siguiente Pagina">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </li>
                @else
                <li class="page-item disabled" aria-disabled="true" aria-label="Siguiente Pagina"
                    style="color:#212121; border: 1px solid #212121;">
                    <span class="page-link" aria-hidden="true"><i class="fa-solid fa-chevron-right"></i></span>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@endif
