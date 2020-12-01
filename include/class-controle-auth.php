<?php
require_once __DIR__ . '/autoload.php';

class Controle_Auth {

    public static function controla_acesso() {
        // Se não tem usuário logado então vai para tela de login:
    
        if ( ! isset( $_SESSION[ 'usuario' ] ) ) {
            header( 'Location: login.php' );
            exit(0);
        }
    }

    /**
     * Efetua o login do usuário
     * 
     * @return bool TRUE em caso de sucesso no login, ou FALSE caso contrário.
     */
    public static function login( string $nome_usuario, string $senha ): bool {

        $db_type     = 'mysql';
        $db_database = 'eldes_progweb_login';
        $db_hostname = 'localhost';
        $db_username = 'eldes_progweb_login';
        $db_password = '123';

        $dsn = "$db_type:dbname=$db_database;host=$db_hostname";
        
        try {

            $pdo = new PDO( $dsn, $db_username, $db_password );
            $senha_cifrada = md5( "$nome_usuario:$senha:oxil" );

            $sql = "SELECT * FROM usuario WHERE nome_usuario = '$nome_usuario' AND senha = '$senha_cifrada'";

            $resultado = $pdo->query( $sql );

            if ( $resultado === FALSE ) {
                echo 'erro no sql';
                return FALSE; //erro no SQL
            }

            $usuario = $resultado->fetchObject();

            if ( $usuario !== FALSE) {
                $_SESSION[ 'usuario' ] = $usuario;

                return TRUE;

            } else {

                return FALSE;
            }

        } catch ( PDOException $e ) {

            echo 'erro na conexao';
            return FALSE; //erro na conexão

        }
    }

    public static function get_usuario_logado(): ?object {
        if ( ! isset($_SESSION[ 'usuario' ]) ) {
            return NULL;
        }
        
        return $_SESSION[ 'usuario' ];
    }

}