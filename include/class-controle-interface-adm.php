<?php
/**
 * Classe que controla a interface.
 */

class Controle_Interface_Adm {

    const SECAO_HOME = 'HOME';
    const SECAO_LISTA = 'LISTA';

    public static function exibir_pagina( string $titulo, string $secao, string $principal ) {
        $template = new raelgc\view\Template( __DIR__ . '/../partials/pagina.html' );
        $template->NOME_USUARIO_LOGADO = Controle_Auth::get_usuario_logado()->nome_completo;
        $template->TITULO = $titulo;
        $template->SELECIONADO_HOME = ( $secao === self::SECAO_HOME ) ? 'selecionado' : '';
        $template->SELECIONADO_LISTA = ( $secao === self::SECAO_LISTA ) ? 'selecionado' : '';

        $template->PRINCIPAL = $principal;

        $template->show();
    }
}