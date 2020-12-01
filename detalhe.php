<?php
require_once __DIR__ . '/include/autoload.php';

controla_acesso();

$id = $_GET[ 'id' ];
Controle_Interface::exibir_cabecalho( "Item $id", Controle_Interface::SECAO_LISTA );
?>