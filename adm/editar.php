<?php
require_once __DIR__ . '/../include/autoload.php';
use raelgc\view\Template;

Controle_Auth::controla_acesso( TRUE );

if ( isset( $_POST['acao'] ) && ( $_POST['acao'] === 'SALVAR' ) ) {
    
    try {

        $pdo = new PDO( $CONFIG['db_dsn'], $CONFIG['db_username'], $CONFIG['db_password'] );
        
        $nome = $_POST[ 'nome' ];
        $descricao = $_POST[ 'descricao' ];
        $preco_centavos = $_POST[ 'preco_centavos' ];
        
        $sql = "INSERT INTO produto
        (nome, descricao, preco_centavos)
        VALUES ( '$nome', '$descricao', $preco_centavos )";

        $resultado = $pdo->exec( $sql );

        if ( $resultado === FALSE ) {
            echo 'erro no sql';
            exit(0); //erro no SQL
        }

        $id = $pdo->lastInsertId();

        header( "Location: detalhe.php?id=$id" );
        exit(0);

    } catch ( PDOException $e ) {

        echo 'erro na conexao';
        exit(0); //erro na conexão

    }
}

$template = new Template( __DIR__ . '/partials/editar.html' );
$principal = $template->parse();

Controle_Interface_Adm::exibir_pagina( 'Novo produto', Controle_Interface_Adm::SECAO_LISTA, $principal );