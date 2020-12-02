<?php
require_once __DIR__ . '/include/autoload.php';

Controle_Auth::controla_acesso();
Controle_Interface::exibir_pagina(
    'Lista',
    Controle_Interface::SECAO_LISTA,
    '<ul><li><a href="detalhe.php?id=1">Item 1</a></li><li>Item 2</li></ul>'
);