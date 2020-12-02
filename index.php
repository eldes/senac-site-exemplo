<?php
require_once __DIR__ . '/include/autoload.php';

Controle_Auth::controla_acesso();
Controle_Interface::exibir_pagina( 'Home', Controle_Interface::SECAO_HOME, '<p>Página inicial</p>' );