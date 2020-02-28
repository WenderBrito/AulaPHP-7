<?php

require_once("config.php");
// lista individual
// $root = new Usuario();
// $root->loadById(3);
// echo $root;
// Lista Grupo
// $lista= Usuario::getList();
// echo json_encode($lista);

// Lista por nome
// $search = Usuario::search("Pe");
// echo json_encode($search);

// Carreca Login e Senha
//$Usuario = new Usuario();
//$Usuario -> login("user", "123456");


//echo $Usuario;
// Criar um novo usuario
// $aluno = new Usuario('aluno', '@lun0');
// $aluno->insert();
// echo $aluno;

$usuario = new Usuario();

$usuario->loadById(8);

$usuario->update("professor", "123!@@");

echo $usuario


?>
