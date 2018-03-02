@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
          <div class="col-md-4">
            <h2>Busqueda: {{$search}}</h2>
            <br>
          </div>
          <div class="col-md-8 ">
          <form class="col-md-3 pull-right" action="{{url('/buscar/'.$search)}}" method="get">
            <label for="filter">Ordenar</label>
            <select class="form-control" name="filter">
              <option value="new">Mas nuevos Primeros</option>
              <option value="old">Mas antiguos Primero</option>
              <option value="alfa">De la A a la Z</option>
            </select>
            <input type="submit" value="Ordenar" class="btn-filter btn btn-sm btn-primary">
          </form>
        </div>
        <div class="clearfix"></div>
          @include('video.videoslist')
        </div>
    </div>
</div>
@endsection
