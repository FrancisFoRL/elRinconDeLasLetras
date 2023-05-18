<div class="list-group sticky-top">
    <a href="{{route('profile.show')}}"
        class="list-group-item list-group-item-action fs-5 {{ Request::is('user/profile') ? 'active' : '' }}"
        aria-current="true">
        Perfil
    </a>
    <a href="{{route('pedidos')}}"
        class="list-group-item list-group-item-action fs-5 {{ Request::is('user/pedidos') ? 'active' : '' }}">Mis
        pedidos</a>
    <a href="{{route('opiniones')}}" class="list-group-item list-group-item-action fs-5 {{ Request::is('user/review') ? 'active' : '' }}">Mis Opiniones</a>
    <a href="#" class="list-group-item list-group-item-action fs-5">A fourth link item</a>
</div>
<style>
    .list-group {
        top: 100px;
        background: rgba(109, 152, 134, 0.72);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10.6px);
        -webkit-backdrop-filter: blur(10.6px);
        border: 1px solid rgba(109, 152, 134, 0.5);
        font-family: 'Roboto', sans-serif;
    }

    .list-group-item {
        background: transparent;
        color: #262626;
    }

    .list-group-item.active {
        background-color: #262626;
        border: none;
    }
</style>
