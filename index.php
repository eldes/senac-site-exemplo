<?php
require_once __DIR__ . '/include/autoload.php';

Controle_Auth::controla_acesso();
Controle_Interface::exibir_cabecalho( 'Home', Controle_Interface::SECAO_HOME );
?>
    <article>
        <h1>Inicial</h1>
    </article>
</body>
</html>