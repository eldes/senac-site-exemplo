<?php
/**
 * Faz o logout do usuário atual.
 * 
 * Redireciona para a página inicial após o logout.
 */
require_once __DIR__ . '/include/config.php';

unset( $_SESSION[ 'usuario' ] );
header( 'Location: index.php' );