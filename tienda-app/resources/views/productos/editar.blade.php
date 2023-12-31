<x-layout titulo="Editar cliente">
    <div class="container mx-auto ">
        <h1 class="text-center">Actualizar Producto {{ $item->nombre }}</h1>
        <div class="row">
            <div class="col-6 mx-auto">
                <form action="{{ route('updatedProducto', $item->id) }}"method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput1" name="nombre"
                            placeholder="Nombre del producto " value="{{ $item->nombre }}">
                        <label for="floatingInput">Nombre del producto</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput2"placeholder="Cantidad unidades"
                            value="{{ $item->stock }}" name="stock">
                        <label>Unidades</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput2"placeholder="Codigo"
                            name="codigo" value="{{ $item->codigo }}">
                        <label>Codigo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control"
                            id="floatingInput2"placeholder="Precio al que se compra" value="{{ $item->precio_compra }}"
                            name="precio_compra">
                        <label>Precio al que se compra</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control"
                            id="floatingInput2"placeholder="Precio al que se vende" value="{{ $item->precio_venta }}"
                            name="precio_venta">
                        <label>Precio al que se vende</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput2"placeholder="Categoria"
                            name="category_id" value="{{ $item->categoria }}">
                        <label>Categoria</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" placeholder="imagen" name="imagen"
                            value="{{ $item->imagen }}">
                        <label>Imagen del producto</label>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <a  href="{{ route('indexPorduct', ['id' => session('tienda_seleccionada')]) }}" style="color:rgb(240, 46, 3)">Regresar</a>
                        <button type="submit"  style="color: white; background-color: rgb(240, 46, 3); border-radius: 10px; border: none; padding: 10px;">Actualizar</button>
                    </div>
             
            </div>
        </div>
    </div>


</x-layout>
