<?php
include_once __DIR__ . '/include/autoload.php';

use raelgc\view\Template;

Controle_Auth::controla_acesso();

$template = new Template( __DIR__ . '/partials/lista.html');
        
try {

    $pdo = new PDO( $CONFIG['db_dsn'], $CONFIG['db_username'], $CONFIG['db_password'] );

    $sql = "SELECT * FROM produto ORDER BY nome";

    $resultado = $pdo->query( $sql );

    if ( $resultado === FALSE ) {
        echo 'erro no sql';
        return FALSE; //erro no SQL
    }

    while ( $produto = $resultado->fetchObject() ) {
        $template->PRODUTO_ID = $produto->id;
        $template->PRODUTO_NOME = $produto->nome;
        $template->block( 'BLOCK_PRODUTO' );
    }

} catch ( PDOException $e ) {
    echo 'erro na conexao';
    return FALSE; //erro na conexão
}

$principal = $template->parse();

Controle_Interface::exibir_pagina(
    'Lista',
    Controle_Interface::SECAO_LISTA,
    $principal
);