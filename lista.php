<?php
require_once __DIR__ . '/include/autoload.php';

controla_acesso();
Controle_Interface::exibir_cabecalho( 'Lista', Controle_Interface::SECAO_LISTA );
?>
    <article>
        <h1>Lista</h1>
        <ul>
            <li><a href="detalhe.php?id=1">item 1</a></li>
            <li><a href="detalhe.php?id=2">item 2</a></li>
            <li><a href="detalhe.php?id=3">item 3</a></li>
            <li><a href="detalhe.php?id=4">item 4</a></li>
            <li><a href="detalhe.php?id=5">item 5</a></li>
        </ul>
    </article>
</body>
</html>