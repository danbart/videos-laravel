@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
          @if(session('message'))
          <div class="alert alert-success">
           {{session('message')}}
          </div>
          @endif

          <div id="videos-list">
            @foreach($videos as $video)
            <div class="video-item col-md-10 pull-left panel panel-default">
              <div class="panel-body">
                <!-- Imagen del video -->
                @if(Storage::disk('images')->has($video->image))
                <div class="video-image-thumb col-md-3 pull-left">
                    <div class="video-image-mask">
                      <img src="{{url('/miniatura/'.$video->image)}}" class="video-image" />
                    </div>
                </div>
                @endif
                <div class="data">
                  <h4 class="video-title"><a href="{{ url('/video',['video_id' => $video->id])}}">{{$video->title}}</a></h4>
                  <p>{{$video->user->name.' '.$video->user->surname}}</p>
                </div>

                <!--  Botones de Accion -->
                <a href="{{ url('/video',['video_id' => $video->id])}}" class="btn btn-success">Ver</a>
                  @if(Auth::check() && Auth::user()->id == $video->user->id)
                      <a href="" class="btn btn-warning">Editar</a>
                            <a href="#victorModal{{$video->id}}" role="button" class="btn btn-sm btn-danger" data-toggle="modal">Eliminar</a>

                            <!-- Modal / Ventana / Overlay en HTML -->
                            <div id="victorModal{{$video->id}}" class="modal fade">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">¿Estás seguro?</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>¿Seguro que quieres borrar este Video?</p>
                                    <p class="text-warning"><small>{{$video->title}}</small></p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <a href="{{url('/delete-video/'.$video->id)}}" class="btn btn-danger">Eliminar</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                  @endif
              </div>
            </div>
            @endforeach
          </div>

        </div>
        {{$videos->links()}}
    </div>
</div>
@endsection
