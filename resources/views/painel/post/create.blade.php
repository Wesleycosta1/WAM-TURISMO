@extends('adminlte::page')

@section('content')
<style type="text/css">
	@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

	fieldset, label { margin: 0; padding: 0; }

	/****** Style Star Rating Widget *****/

	.rating { 
	  border: none;
	  float: left;
	}

	.rating > input { opacity: 0; position: absolute; top: 15px; left:  70px; z-index: -10;} 
	.rating > label:before { 
	  margin: 5px;
	  font-size: 1.25em;
	  font-family: FontAwesome;
	  display: inline-block;
	  content: "\f005";
	}

	.rating > .half:before { 
	  content: "\f089";
	  position: absolute;
	}

	.rating > label { 
	  color: #ddd; 
	 float: right; 
	}

	/***** CSS Magic to Highlight Stars on Hover *****/

	.rating > input:checked ~ label, /* show gold star when clicked */
	.rating:not(:checked) > label:hover, /* hover current star */
	.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

	.rating > input:checked + label:hover, /* hover current star when changing rating */
	.rating > input:checked ~ label:hover,
	.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
	.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
</style>
<div class="erros">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<form action="{{route('painel.postStore')}}" method="POST" enctype='multipart/form-data' id="formulario">
	@csrf
	<div class="form-row">
		<div class="col">
			<label for="estados">Estado:</label>
			<select class="form-control" name="estado" id="estados" required>
			</select>
		</div>
		<div class="col">
			<label>Cidade:</label>
			<select class="form-control" name="cidade" id="cidades" required>
			</select>
		</div>
		<div class="form-group" style="display: none;">
			<input class="form-control" type="hidden" id="nomeCidade" name="nomeCidade">
			<input class="form-control" type="hidden" id="nomeEstado" name="nomeEstado">
		</div>
	</div>
	<div class="form-group">
		<label>Título:</label>
		<input class="form-control" type="text" name="titulo">
	</div>
	<div class="form-group">
		<label>Descrição:</label>
		<textarea class="form-control" name="descricao"></textarea>
	</div>
	<div class="form-group">
		<div class="form-row" style="align-items: center; padding-right: 5px; padding-left: 5px;">
			<label>Sua avaliação:</label>
			<div class="col">
				<fieldset class="rating">
				    <input type="radio" id="star5" name="avaliacao" value="5" required /><label class = "full" for="star5" ></label>
				    <input type="radio" id="star4half" name="avaliacao" value="4.5" /><label class="half" for="star4half"></label>
				    <input type="radio" id="star4" name="avaliacao" value="4" /><label class = "full" for="star4"></label>
				    <input type="radio" id="star3half" name="avaliacao" value="3.5" /><label class="half" for="star3half"></label>
				    <input type="radio" id="star3" name="avaliacao" value="3" /><label class = "full" for="star3" ></label>
				    <input type="radio" id="star2half" name="avaliacao" value="2.5" /><label class="half" for="star2half"></label>
				    <input type="radio" id="star2" name="avaliacao" value="2" /><label class = "full" for="star2"></label>
				    <input type="radio" id="star1half" name="avaliacao" value="1.5" /><label class="half" for="star1half"></label>
				    <input type="radio" id="star1" name="avaliacao" value="1" /><label class = "full" for="star1"></label>
				    <input type="radio" id="starhalf" name="avaliacao" value="0.5" /><label class="half" for="starhalf"></label>
				</fieldset>
				<br>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label>Anexar Fotos:</label>
		<input type="file" name="fotos[]" multiple="multiple">
	</div>
	<div class="form-group pt-3">
		<button type="submit" class="btn btn-primary btn-block">Criar Post</button>
	</div>
</form>
@endsection


@section('js')
<script type="text/javascript">

	$.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados/', {id: 10, }, function (json) {
 
        var options = '<option value="">–  –</option>';
 
        for (var i = 0; i < json.length; i++) {
 
            options += '<option data-id="' + json[i].id + '" value="' + json[i].id + '" >' + json[i].nome + '</option>';
 
        }

        $("#estados").html(options);
    });
 
 
    $("#estados").change(function () {
 
        if ($(this).val()) {
            $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'+$(this).find("option:selected").attr('data-id')+'/municipios', {id: $(this).find("option:selected").attr('data-id')}, function (json) {
 
                var options = '<option value="">–  –</option>';
 
                for (var i = 0; i < json.length; i++) {
 
                    options += '<option data-nome-estado="' + json[i].microrregiao.mesorregiao.UF.nome + '" data-nome-cidade="' + json[i].nome + '" value="' + json[i].id + '" >' + json[i].nome + '</option>';
 
                }
 
                $("#cidades").html(options);
 
            });
 
        } else {
 
            $("#cidades").html('<option value="">–  –</option>');
 
        }

    });

    $("#cidades").change(function () {
    	$("#nomeCidade").val($(this).find("option:selected").attr('data-nome-cidade'));
    	$("#nomeEstado").val($(this).find("option:selected").attr('data-nome-estado'));
	 	
    });

</script>
@endsection