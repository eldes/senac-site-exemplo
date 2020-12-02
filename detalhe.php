<?php
require_once __DIR__ . '/include/autoload.php';

Controle_Auth::controla_acesso();

$id = $_GET[ 'id' ];
Controle_Interface::exibir_pagina( "Item $id", Controle_Interface::SECAO_LISTA, '<p>detalhes do produto</p>' );
?>