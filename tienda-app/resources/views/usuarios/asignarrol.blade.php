<x-layout>
    <div class="container mt-5">
<form action="{{ route('poner.rol', $id) }}" method="POST">
    @csrf
    <select class="form-select" name="rol">
        <option disabled selected>Seleccione el rol a asignar</option>
        @foreach ($roles as $rol)
                        <option value="{{$rol}}" > {{$rol}}
                        </option>
        @endforeach
        

</select>
<button type="submit"  style="color: white; background-color: rgb(240, 46, 3); border-radius: 10px; border: none; padding: 10px; margin-top: 30px" >
    Asignar rol
</button>
</div>
</form>


</x-layout>