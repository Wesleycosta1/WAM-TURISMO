<?php

use App\Models\Image;

function moverImagens($idPost, $path, $imagens){
	$total = 0;
	foreach($imagens['fotos'] as $imagem){
		$destino = public_path($path);
		$nome = time().'-'.$total.'.'.$imagem->getClientOriginalExtension();
		$caminhoGuardar = $imagem->move($destino, $nome);
		$image = new Image;
		$image = $image->create(['nome' => $nome, 'idPost' => $idPost]);
		$total++;
	}
}

function escreverEstrelas($avaliacao){
	$icones = '';
	$estrelas = explode('.', $avaliacao);
	$quantidade = $estrelas[0];
	for ($i=0; $i < $quantidade; $i++) { 
		$icones .= "<i style='color: #FFDA33;' class='fas fa-star'></i>";
	}
	if (isset($estrelas[1]) && ($estrelas[1] == '5')) {
		$icones .= "<i style='color: #FFDA33' class='fas fa-star-half-alt'></i>";
	}

	return($icones);
}


function escreverLocalidade($municipio){
	$json = file_get_contents('https://servicodados.ibge.gov.br/api/v1/localidades/municipios/' . $municipio);
	$data = json_decode($json, true);
	// dd($data);
	$localidade = $data['nome'] . ' (' . $data['regiao-imediata']['regiao-intermediaria']['UF']['sigla'] . ')';
	return $localidade;
}