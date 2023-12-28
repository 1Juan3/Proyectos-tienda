<x-layout>
    <div class="container mx-auto ">
        <h3 class="text-center">Trasferir producto {{ $producto->nombre }}</h3>
        <div class="row">
            <div class="col-6 mx-auto">
                    <form action="{{ route("transfeir.producto", $producto->id) }}" enctype="multipart/form-data" style="width: 100%" method="POST">
                                    @csrf
                                    <div class="form-floating mb-3">
                                                    <input type="text" class="form-control"
                                                                    id="floatingInput2"placeholder="Nombre de la tienda" name="nombre_tienda" value="{{ $producto->nombre }}" readonly>
                                                    <label>Nombre del producto</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                                    <input type="text" class="form-control"
                                                                    id="floatingInput2"placeholder="Direcccion de la tienda" name="direccion_tienda" value="{{ $producto->stock }}" readonly >
                                                    <label>Cant actual</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput2"placeholder="Cant a tranferir" 
                                                                    name="stock">
                                                    <label>Cant a transferir  </label>
                                    </div>

                    
                                    @foreach ($tiendas as $tienda)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $tienda->id }}" id="flexCheckDefault{{ $tienda->id }}" name='tienda_id[]'>
                                        <label class="form-check-label" for="flexCheckDefault{{ $tienda->id }}">
                                            <b>{{ $tienda->nombre_tienda }}</b>
                                        </label>
                                    </div>
                                @endforeach
    
                    <div style="display: flex; justify-content: space-between;">
                        <a  href="{{ route('index.tiendas')}}" style="color:rgb(240, 46, 3)">Regresar</a>
                        <button type="submit"  style="color: white; background-color: rgb(240, 46, 3); border-radius: 10px; border: none; padding: 10px;">Actualizar</button>
                    </div>
             
            </div>
        </div>
    </div>

</x-layout>