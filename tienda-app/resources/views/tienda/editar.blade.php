<x-layout titulo="Editar tienda">
    <div class="container mx-auto ">
        <h3 class="text-center">Actualizar tienda {{ $tienda->nombre_tienda }}</h3>
        <div class="row">
            <div class="col-6 mx-auto">
                    <form action="{{ route("update.tienda", $tienda->id) }}" enctype="multipart/form-data" style="width: 100%" method="POST">
                                    @csrf
                                    <div class="form-floating mb-3">
                                                    <input type="text" class="form-control"
                                                                    id="floatingInput2"placeholder="Nombre de la tienda" name="nombre_tienda" value="{{ $tienda->nombre_tienda }}">
                                                    <label>Nombre de la tienda</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                                    <input type="text" class="form-control"
                                                                    id="floatingInput2"placeholder="Direcccion de la tienda" name="direccion_tienda" value="{{ $tienda->direccion_tienda }}" >
                                                    <label>Direccion tienda</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput2"placeholder="Telefono" value="{{ $tienda->telefono_tienda }}"
                                                                    name="telefono_tienda">
                                                    <label>Telefoo </label>
                                    </div>
                                    <div class="form-floating mb-3">
                                                    <input type="text" class="form-control"
                                                                    id="floatingInput2"placeholder="Correo electronico" name="email_tienda" value="{{ $tienda->email_tienda }}">
                                                    <label>Correo electronico</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput2"placeholder="Nit tienda" value="{{ $tienda->nit_tienda }}"
                                                                    name="nit_tienda">
                                                    <label>Nit tienda</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                                    <input type="file" class="form-control" placeholder="Logo tienda" name="logo_tienda">
                                                    <label>Logo tienda</label>
                                    </div>

    
                    <div style="display: flex; justify-content: space-between;">
                        <a  href="{{ route('index.tiendas')}}" style="color:rgb(240, 46, 3)">Regresar</a>
                        <button type="submit"  style="color: white; background-color: rgb(240, 46, 3); border-radius: 10px; border: none; padding: 10px;">Actualizar</button>
                    </div>
             
            </div>
        </div>
    </div>


</x-layout>
