<?php
require_once __DIR__ . '/include/autoload.php';
use raelgc\view\Template;

Controle_Auth::controla_acesso();

$id = $_GET[ 'id' ];

try {

    $template = new Template( __DIR__ . '/partials/detalhe.html' );

    $pdo = new PDO( $CONFIG['db_dsn'], $CONFIG['db_username'], $CONFIG['db_password'] );

    $sql = "SELECT * FROM produto WHERE id = $id";
    $resultado = $pdo->query( $sql );

    if ( $resultado === FALSE ) {
        echo 'erro no sql';
        exit(0); //erro no SQL
    }

    $produto = $resultado->fetchObject();

    if ( $produto === FALSE ) {
        echo 'produto não encontrado';
        exit(0);
    }

    $template->PRODUTO_ID = $produto->id;
    $template->PRODUTO_DESCRICAO = $produto->descricao;
    $template->PRODUTO_PRECO = number_format( $produto->preco_centavos/100, 2, ',', '.' );

    $principal = $template->parse();

    Controle_Interface::exibir_pagina( $produto->nome, Controle_Interface::SECAO_LISTA, $principal );

} catch ( PDOException $e ) {
    echo 'erro na conexao';
    exit(0); //erro na conexão
}
?>