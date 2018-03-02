@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <h2>Editar -- {{$video->title}}</h2>
    <hr>
    <form class="col-lg-7" enctype="multipart/form-data" action="{{url('/update-video', ['video_id' => $video->id])}}" method="post">
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
        <input type="text" class="form-control" id="title" name="title" value="{{$video->title}}">
      </div>
      <div class="form-class">
        <label for="description">Descripción</label>
        <textarea name="description" id="description" class="form-control" >{{$video->description}}</textarea>
      </div>
      <div class="form-class">
        <label for="image">Imagen</label>
        @if(Storage::disk('images')->has($video->image))
        <div class="video-image-thumb">
            <div class="video-image-mask">
              <img src="{{url('/miniatura/'.$video->image)}}" class="video-image" />
            </div>
        </div>
        @endif
        <input type="file" class="form-control" id="image" name="image" accept="file_extension|image/jpeg|image/x-png" value="">
      </div>
      <div class="form-class">
        <label for="video">Video</label>
          <video controls id="video-player">
            <source src="{{ url('/video-file', ['filename' => $video->video_path])}}" >
              Tu navegador no es compatible con HTML5
            </video>
        <input type="file" class="form-control" id="video" name="video" accept="file_extension|video/x-mpeg2|video/x-msvideo|video/quicktime" value="">
      </div>
      <div class="form-class">
        <br>
      <button type="submit" name="button" class="btn btn-success">Modificar Video</button>
    </div>
    </form>
  </div>
</div>


@endsection
