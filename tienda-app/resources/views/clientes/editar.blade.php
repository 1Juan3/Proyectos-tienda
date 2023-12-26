<x-layout titulo="Editar clientes">
    <div class="container mx-auto ">
        <h4 class="text-center">Actualizar cliente {{ $cliente->nombre_completo }}</h4>
        <div class="row">
            <div class="col-6 mx-auto">
                <form action="{{ route('updatedClient', $cliente->id) }}"method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput1" name="nombre_completo"
                            value="{{ $cliente->nombre_completo }}" placeholder="Nombre completo del cliente ">
                        <label for="floatingInput">Nombre completo del cliente </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput2"placeholder="Razon social"
                            value="{{ $cliente->razon_social }}" name="razon_social">
                        <label>Razon social</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput2"placeholder="Correo electronico"
                        value="{{ $cliente->correo }}"
                            name="correo">
                        <label>Correo electronico</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput2"placeholder="Nit" value="{{ $cliente->nit }}"
                            name="nit">
                        <label>Nit</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput2"placeholder="Direccion"
                            value="{{ $cliente->direccion }}" name="direccion">
                        <label>Dirección del cliente</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="phone" class="form-control" id="floatingInput2"placeholder="Celular"
                            value="{{ $cliente->celular }}" name="celular">
                        <label>Celular</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput2"placeholder="Categoria"
                            value="{{ $cliente->category_id }}" name="category_id">
                        <label>Categoria</label>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-3">
                                <a href="{{ route('indexClient') }}">regresar</a>
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-info">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</x-layout>
