
    <div class="container fliud mx-auto">
        <div class="row">
            @foreach ( $tiendas as $tiendas )
            <div class="col">
                <div>
                    <a href="{{ route('showTiendas', $tiendas->id) }}"> {{ $tiendas->nombre_tienda }}</a>
                </div>
            </div>             
            @endforeach
        </div>

    </div>
