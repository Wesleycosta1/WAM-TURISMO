@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/owlcarousel/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('css/owlcarousel/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
@endsection

@section('content')
<div class="row justify-content-center pt-3">
    <div class="col-md-12" style="overflow-y: auto; height: 100%">
        @foreach($results as $result)
            @if(isset($cidade))
            <div class="card mb-4">
                <div class="card-header" style="background: #0f0f0f; color: #f0f0f0;">
                    <div style="display: flex; justify-content: space-between;">
                        <span>{{$result->nomeEstado}}</span>                
                    </div>                  
                </div>

                <div class="card-body">
                    <a href="{{route('search', ['search' => $result->nomeCidade])}}" style="text-decoration: none; color: #0f0f0f;">
                        <h3>{{$result->nomeCidade}} {!!escreverEstrelas($result->avaliacao)!!} {{isset($result->visitas) ? '(' . $result->visitas . ')' : ''}}<i class="fas fa-angle-right"></i></h3>
                    </a>
                </div>
            </div>
            @elseif(isset($estado))
            <div class="card mb-4">
                <div class="card-header" style="background: #0f0f0f; color: #f0f0f0;">
                    <div style="display: flex; justify-content: space-between;">
                        <span>{{$result->nomeEstado}}</span>                
                    </div>                  
                </div>

                <div class="card-body">
                    <a href="{{route('search', ['search' => $result->nomeEstado])}}" style="text-decoration: none; color: #0f0f0f;">
                        <h3>{{$result->nomeEstado}} {!!escreverEstrelas($result->avaliacao)!!} {{isset($result->visitas) ? '('.$result->visitas.')' : ''}}<i class="fas fa-angle-right"></i></h3>
                    </a>
                </div>
            </div>
            @elseif(isset($titulo))
                <div class="card mb-4">
                    <div class="card-header" style="background: #0f0f0f; color: #f0f0f0;">
                        <div style="display: flex; justify-content: space-between;">
                            <span>{{$titulo}}{{$result->total}}</span>                
                        </div>                  
                    </div>

                    <div class="card-body">
                        <a href="{{route('search', ['search' => $result->nomeCidade])}}" style="text-decoration: none; color: #0f0f0f;">
                            <h3>{{$result->nomeCidade}} - ({{$result->nomeEstado}})<i class="fas fa-angle-right"></i></h3>
                        </a>
                        <h3>{!!escreverEstrelas($result->avaliacao)!!} {{isset($result->visitas) ? '('.$result->visitas.')' : ''}}</h3>
                    </div>
                </div>
            @endif
        @endforeach
        @if(isset($titulo))
            {{$results->links()}}
        @endif
    </div>
</div>
@endsection
