<x-layout>
    <form action="POST">
        @csrf
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput2"placeholder="Nombre de la tienda"
                name="nombre_tienda">
            <label>Nombre de la tienda</label>
        </div>
        <button class="btn btn-primary"> Crear Tienda</button>
    </form>
    <div class="container">
        @foreach($tiendas as $tienda)
            <a type="button" class="btn btn-primary" href="{{ route('indexPorduct', $tienda->id) }}">{{ $tienda->nombre_tienda }}</a>
        @endforeach
       
    </div>
</x-layout>