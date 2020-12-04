<?php
require_once __DIR__ . '/../include/autoload.php';
use raelgc\view\Template;

const ACAO_INSERIR = 'INSERIR';
const ACAO_ALTERAR = 'ALTERAR';

Controle_Auth::controla_acesso( TRUE );

$template = new Template( __DIR__ . '/partials/editar.html' );
$titulo = 'Novo produto';

if ( isset( $_GET[ 'id' ] ) ) {

    $template->ACAO = ACAO_ALTERAR;
    $titulo = 'Editar';

    try {
        $pdo = new PDO( $CONFIG['db_dsn'], $CONFIG['db_username'], $CONFIG['db_password'] );
        
        $sql = "SELECT * FROM produto WHERE id = $_GET[id]";
        $resultado = $pdo->query( $sql );

        if ( $resultado === FALSE ) {
            echo 'erro no sql';
            exit(0); //erro no SQL
        }

        $produto = $resultado->fetchObject();

        if ( $produto === FALSE) {
            echo 'produto inexistente';
            exit(0);
        }

        $template->PRODUTO_ID = $produto->id;
        $template->PRODUTO_NOME = $produto->nome;
        $template->PRODUTO_DESCRICAO = $produto->descricao;
        $template->PRODUTO_PRECO_CENTAVOS = $produto->preco_centavos;

    } catch ( PDOException $e ) {
        echo 'erro na conexao';
        exit(0); //erro na conexão
    }

} else {
    $template->ACAO = ACAO_INSERIR;
}

if ( isset( $_POST['acao'] ) ) {
    
    try {
        $pdo = new PDO( $CONFIG['db_dsn'], $CONFIG['db_username'], $CONFIG['db_password'] );
        
        $nome = $_POST[ 'nome' ];
        $descricao = $_POST[ 'descricao' ];
        $preco_centavos = $_POST[ 'preco_centavos' ];
        
        if ( $_POST['acao'] === ACAO_INSERIR ) {
            $sql = "INSERT INTO produto
            (nome, descricao, preco_centavos)
            VALUES ( '$nome', '$descricao', $preco_centavos )";
        } elseif ( $_POST['acao'] === ACAO_ALTERAR ) {
            $sql = "UPDATE produto
            SET nome = '$nome', descricao = '$descricao', preco_centavos = $preco_centavos
            WHERE id = $_POST[id]";
        } else {
            echo 'acao invalida';
            exit(0);
        }
        
        $resultado = $pdo->exec( $sql );

        if ( $resultado === FALSE ) {
            echo 'erro no sql';
            exit(0); //erro no SQL
        }

        if ( $_POST['acao'] === ACAO_INSERIR ) {
            $id = $pdo->lastInsertId();
        } elseif ( $_POST['acao'] === ACAO_ALTERAR ) {
            $id = $_POST[id];
        } else {
            echo 'acao invalida';
            exit(0);
        }

        header( "Location: detalhe.php?id=$id" );
        exit(0);

    } catch ( PDOException $e ) {

        echo 'erro na conexao';
        exit(0); //erro na conexão

    }
}

$principal = $template->parse();
Controle_Interface_Adm::exibir_pagina( $titulo, Controle_Interface_Adm::SECAO_LISTA, $principal );