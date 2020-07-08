<?php
if(isset($_GET['play']) && !empty($_GET['play'])){
	play($_GET['play']);
	exit();
}
if(!isset($_GET['id']) && empty($_GET['id'])){
	exit('ID cannot be Empty');
}

$idFembed = $_GET['id'];
$vid = get($idFembed);
if(!is_array($vid[1])){
	exit($vid[1]);
}
$sources = '';
foreach($vid[1] as $k => $v){
	$file = explode('=',$vid[1][$k]['file']);
	$sources .= '<source src="?play='.$file[1].'" type="video/mp4" label="'.$vid[1][$k]['label'].'">'.PHP_EOL;
}
include('play.php');

function get($id){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://feurl.com/api/source/$id");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	$result = json_decode(curl_exec($ch),TRUE);
	$result = array($result['success'],$result['data'],);
	curl_close($ch);
	return $result;
}

function play($token){
	$filename = "https://fvs.io/redirector?token=$token";
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$filename);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 500);
	curl_setopt($ch, CURLOPT_WRITEFUNCTION, function($curl, $data) {
		echo $data;
		return strlen($data);
	});
	curl_exec($ch);
	curl_close($ch);
}