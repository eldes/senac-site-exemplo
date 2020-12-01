<?php
require_once __DIR__ . '/config.php';

class Controle_Auth {

    public static function controla_acesso() {
        // Se não tem usuário logado então vai para tela de login:
    
        if ( ! isset( $_SESSION[ 'usuario' ] ) ) {
            header( 'Location: login.php' );
            exit(0);
        }
    }
    
}