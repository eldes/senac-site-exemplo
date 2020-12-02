<?php
session_start();

$CONFIG = [];
$CONFIG['db_type']     = 'mysql';
$CONFIG['db_database'] = 'eldes_progweb_login';
$CONFIG['db_hostname'] = 'localhost';
$CONFIG['db_username'] = 'eldes_progweb_login';
$CONFIG['db_password'] = '123';
$CONFIG['db_dsn']      = "$CONFIG[db_type]:dbname=$CONFIG[db_database];host=$CONFIG[db_hostname]";