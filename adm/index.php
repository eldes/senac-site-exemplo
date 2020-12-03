<?php
require_once __DIR__ . '/../include/autoload.php';

Controle_Auth::controla_acesso( TRUE );
Controle_Interface_Adm::exibir_pagina( 'Adm', Controle_Interface_Adm::SECAO_HOME, '<p>Página inicial</p>' );