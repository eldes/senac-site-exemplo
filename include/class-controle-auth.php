<?php
class Controle_Auth {

    public static function controla_acesso( bool $adm = FALSE ) {

        // Se não tem usuário logado
        // ou se tem mas não tem permissão
        // então vai para tela de login:
    
        if ( ( ! self::tem_usuario_logado() ) || ( $adm && ( ! self::usuario_logado_eh_adm() ) ) ) {
            header( 'Location: login.php' );
            exit(0);
        }
    }

    private static function tem_usuario_logado(): bool {
        return isset( $_SESSION[ 'usuario' ] );
    }

    private static function usuario_logado_eh_adm(): bool {
        return $_SESSION[ 'usuario' ]->flag_adm === '0';
    }

    /**
     * Efetua o login do usuário
     * 
     * @return bool TRUE em caso de sucesso no login, ou FALSE caso contrário.
     */
    public static function login( string $nome_usuario, string $senha ): bool {
        global $CONFIG;
        
        try {

            $pdo = new PDO( $CONFIG['db_dsn'], $CONFIG['db_username'], $CONFIG['db_password'] );
            
            $senha_cifrada = md5( "$nome_usuario:$senha:oxil" );

            $sql = "SELECT * FROM usuario WHERE nome_usuario = '$nome_usuario' AND senha = '$senha_cifrada'";

            $resultado = $pdo->query( $sql );

            if ( $resultado === FALSE ) {
                echo 'erro no sql';
                return FALSE; //erro no SQL
            }

            $usuario = $resultado->fetchObject();

            if ( $usuario !== FALSE) {
                unset( $usuario->senha );
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