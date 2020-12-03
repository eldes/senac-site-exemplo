<?php
require_once __DIR__ . '/../include/autoload.php';

$erro = false;
$nome_usuario = '';

// Se é um submit do form de login:
if ( isset( $_POST['a'] ) && ( $_POST['a'] === 'entrar' ) ) {

    // Consegue os dados de login do form:
        
    $nome_usuario = $_POST[ 'u' ];
    $senha = $_POST[ 's' ];

    $erro = ! Controle_Auth::login( $nome_usuario, $senha );

    if ( ! $erro ) {
        header( 'Location: index.php' );
        exit(0);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php if ( $erro ) : ?>
    <p class="erro"><i class="material-icons">error</i> <span>Login inválido!</span></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <input type="text" name="u" placeholder="Nome de usuário" value="<?php echo $nome_usuario ?>">
        <input type="password" name="s" placeholder="Senha">
        <button type="submit" name="a" value="entrar">Entrar</button>
    </form>
</body>
</html>