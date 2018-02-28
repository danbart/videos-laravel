@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <h2>Crear Video</h2>
    <hr>
    <form class="col-lg-7" enctype="multipart/form-data" action="{{url('/guardar-video')}}" method="post">
      {{-- Metodo para validar los formularios ya que laravel los protege --}}
      {!! csrf_field() !!}

      @if($errors->any())
      <div class="alert alert-danger">
        <h5>Errores encontrados</h5>
          <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
      </div>
      @endif
      <div class="form-class">
        <label for="title">Titulo</label>
        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
      </div>
      <div class="form-class">
        <label for="description">Descripción</label>
        <textarea name="description" id="description" class="form-control" >{{old('description')}}</textarea>
      </div>
      <div class="form-class">
        <label for="image">Imagen</label>
        <input type="file" class="form-control" id="image" name="image" accept="file_extension|image/jpeg|image/x-png" value="">
      </div>
      <div class="form-class">
        <label for="video">Video</label>
        <input type="file" class="form-control" id="video" name="video" accept="file_extension|video/x-mpeg2|video/x-msvideo|video/quicktime" value="">
      </div>
      <div class="form-class">
        <br>
      <button type="submit" name="button" class="btn btn-success">Crear Video</button>
    </div>
    </form>

  </div>
</div>


@endsection
