<?php
    // caminho absoluto para a pasta do sistema
    if ( !defined('ABSPATH') ) {
    	define('ABSPATH', dirname(__FILE__) . '/');
    }

    // caminho no server para o sistema
    if ( !defined('BASEURL') ) {
    	define('BASEURL', '/7thorsystems');
    }

    // caminho do arquivo de banco de dados
    if ( !defined('DBAPI') ) {
    	define('DBAPI', ABSPATH . '/system/pdo.php');
    }

    /* PDO: https://www.php.net/manual/pt_BR/book.pdo.php
           Variáveis PDO 
    */                       

    define('DB_HOST', 'localhost');
    define('DB_NAME', '7thorsystems');
    define('DB_USER', 'root');
    define('DB_PASSW', '');
    define('INSTALL_TIMEOUT', 10);

    /* Concatenação das variáveis para detalhes da classe PDO                                 
          -- Data Source Name ( DSN )
    */

    define('DB_DSN', 'mysql:dbname='. DB_NAME . ';host=' . DB_HOST);


    // caminhos dos templates de header e footer
    define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');
    define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');
    define('LOGO_TEMPLATE', ABSPATH . 'inc/logo.php');
    define('NAVMENU_TEMPLATE', ABSPATH . 'inc/nav_menu.php');

?>
