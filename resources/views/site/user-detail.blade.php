@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/owlcarousel/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('css/owlcarousel/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
<style type="text/css">
    .nav-link{
        color: #fff;
    }

    .nav-link:hover{
        color: #fff;
    }

    .nav-link.active{
        background-color: rgba(0, 0, 0, 0.0) !important;
        color: #fff !important;
    }

    .nav-item.btn-primary:focus{

    }
</style>
@endsection

@section('content')

<div class="row justify-content-center pt-3">
    <div class="col-md-12" style="overflow-y: auto; height: 90vh">
        <div class="card mb-4">
            <div class="card-header" style="background: #0f0f0f; color: #f0f0f0;">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item btn-info " role="presentation">
                        <a class="nav-link" id="bio-tab" data-toggle="tab" href="#bio" role="tab" aria-controls="bio" aria-selected="false"><i class="fas fa-user"></i> Bio</a>
                    </li>
                    
                    <li class="nav-item btn-primary" role="presentation">
                        <a class="nav-link" id="queroIr-tab" data-toggle="tab" href="#queroIr" role="tab" aria-controls="queroIr" aria-selected="false">Quero Ir</a>
                    </li>
                    <li class="nav-item btn-success" role="presentation">
                        <a class="nav-link" id="jaFui-tab" data-toggle="tab" href="#jaFui" role="tab" aria-controls="jaFui" aria-selected="true">Já fui</a>
                    </li>
                    <li class="nav-item btn-danger" role="presentation">
                        <a class="nav-link" id="naoVoltaria-tab" data-toggle="tab" href="#naoVoltaria" role="tab" aria-controls="naoVoltaria" aria-selected="false">Não voltaria</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="bio" role="tabpanel" aria-labelledby="bio-tab">
                        <h3>{{$user->name}}</h3>
                    </div>
                    <div class="tab-pane fade" id="queroIr" role="tabpanel" aria-labelledby="queroIr-tab">
                        @if(count($user->queroIr)>0)
                            @foreach($user->queroIr as $post)
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <div class="card-header" style="background: #0f0f0f; color: #f0f0f0;">
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <div>
                                                    <span>{{escreverLocalidade($post->post->cidade)}} {!! escreverEstrelas($post->post->avaliacao) !!}</span>                
                                                </div>
                                                @if(Auth::user())
                                                    @if((Auth::user()->type == 2) || (Auth::user()->id == $post->post->owner->id))
                                                        <div>
                                                            <a href="{{route('postDestroy', $post->post->id)}}">
                                                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <a href="{{url('post/' . $post->post->id)}}" style="text-decoration: none; color: #0f0f0f;">
                                                <h3>{{$post->post->titulo}}</h3>
                                            </a>
                                            <div class="owl-carousel">
                                                @if(count($post->post->images)>0)
                                                    @foreach($post->post->images as $image)
                                                    <a href="{{asset('img/post/' . $image->nome)}}" target="blank">
                                                        <div class="item"><img src="{{asset('img/post/' . $image->nome)}}"></div>
                                                    </a>
                                                    @endforeach
                                                @else
                                                    <div class="item">
                                                        <img src="{{asset('img/semfoto.png')}}">
                                                    </div>
                                                @endif
                                            </div>
                                            <h5>{{$post->post->descricao}}</h5>
                                            <div class="p-2" style="background-color: #D3D3D3;">
                                                <div style="display: flex; align-items: flex-start;">
                                                    <div style="padding-right: 10px;">
                                                        <img style="width: 150px;" src="{{asset('img/semfoto.png')}}">
                                                    </div>
                                                    <div style="padding-top: 4px;">
                                                        <h4><a style="text-decoration: none; color: #0f0f0f" href="{{route('userView', $post->post->owner->id)}}"><b>{{$post->post->owner->name}}</b></a></h4>
                                                        <h4>Postado em: {{date('d/m/y h:m', strtotime($post->post->created_at))}} </h4>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3>Sem registros</h3>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="jaFui" role="tabpanel" aria-labelledby="jaFui-tab">
                        @if(count($user->jaFui)>0)
                            @foreach($user->jaFui as $post)
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <div class="card-header" style="background: #0f0f0f; color: #f0f0f0;">
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <div>
                                                    <span>{{escreverLocalidade($post->post->cidade)}} {!! escreverEstrelas($post->post->avaliacao) !!}</span>                
                                                </div>
                                                @if(Auth::user())
                                                    @if((Auth::user()->type == 2) || (Auth::user()->id == $post->post->owner->id))
                                                        <div>
                                                            <a href="{{route('postDestroy', $post->post->id)}}">
                                                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <a href="{{url('post/' . $post->post->id)}}" style="text-decoration: none; color: #0f0f0f;">
                                                <h3>{{$post->post->titulo}}</h3>
                                            </a>
                                            <div class="owl-carousel">
                                                @if(count($post->post->images)>0)
                                                    @foreach($post->post->images as $image)
                                                    <a href="{{asset('img/post/' . $image->nome)}}" target="blank">
                                                        <div class="item"><img src="{{asset('img/post/' . $image->nome)}}"></div>
                                                    </a>
                                                    @endforeach
                                                @else
                                                    <div class="item">
                                                        <img src="{{asset('img/semfoto.png')}}">
                                                    </div>
                                                @endif
                                            </div>
                                            <h5>{{$post->post->descricao}}</h5>
                                            <div class="p-2" style="background-color: #D3D3D3;">
                                                <div style="display: flex; align-items: flex-start;">
                                                    <div style="padding-right: 10px;">
                                                        <img style="width: 150px;" src="{{asset('img/semfoto.png')}}">
                                                    </div>
                                                    <div style="padding-top: 4px;">
                                                        <h4><a style="text-decoration: none; color: #0f0f0f" href="{{route('userView', $post->post->owner->id)}}"><b>{{$post->post->owner->name}}</b></a></h4>
                                                        <h4>Postado em: {{date('d/m/y h:m', strtotime($post->post->created_at))}} </h4>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3>Sem registros</h3>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="naoVoltaria" role="tabpanel" aria-labelledby="naoVoltaria-tab">
                        @if(count($user->naoVoltaria)>0)
                            @foreach($user->naoVoltaria as $post)
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <div class="card-header" style="background: #0f0f0f; color: #f0f0f0;">
                                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                                <div>
                                                    <span>{{escreverLocalidade($post->post->cidade)}} {!! escreverEstrelas($post->post->avaliacao) !!}</span>                
                                                </div>
                                                @if(Auth::user())
                                                    @if((Auth::user()->type == 2) || (Auth::user()->id == $post->post->owner->id))
                                                        <div>
                                                            <a href="{{route('postDestroy', $post->post->id)}}">
                                                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <a href="{{url('post/' . $post->post->id)}}" style="text-decoration: none; color: #0f0f0f;">
                                                <h3>{{$post->post->titulo}}</h3>
                                            </a>
                                            <div class="owl-carousel">
                                                @if(count($post->post->images)>0)
                                                    @foreach($post->post->images as $image)
                                                    <a href="{{asset('img/post/' . $image->nome)}}" target="blank">
                                                        <div class="item"><img src="{{asset('img/post/' . $image->nome)}}"></div>
                                                    </a>
                                                    @endforeach
                                                @else
                                                    <div class="item">
                                                        <img src="{{asset('img/semfoto.png')}}">
                                                    </div>
                                                @endif
                                            </div>
                                            <h5>{{$post->post->descricao}}</h5>
                                            <div class="p-2" style="background-color: #D3D3D3;">
                                                <div style="display: flex; align-items: flex-start;">
                                                    <div style="padding-right: 10px;">
                                                        <img style="width: 150px;" src="{{asset('img/semfoto.png')}}">
                                                    </div>
                                                    <div style="padding-top: 4px;">
                                                        <h4><a style="text-decoration: none; color: #0f0f0f" href="{{route('userView', $post->post->owner->id)}}"><b>{{$post->post->owner->name}}</b></a></h4>
                                                        <h4>Postado em: {{date('d/m/y h:m', strtotime($post->post->created_at))}} </h4>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3>Sem registros</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{asset('js/owlcarousel/owl.carousel.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $(".owl-carousel").owlCarousel({
        items:1,
        autoHeight:true
      });
    });
</script>
@endsection
