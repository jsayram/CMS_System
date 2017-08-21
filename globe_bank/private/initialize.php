<?php
  //this makes sure output buffering is turned on
  ob_start();

  // Assign file paths to PHP constants
  // __FILE__ returns the current path to this file
  // dirname() returns the path to the parent directory
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

  // Assign the root URL to a PHP constant
  // * Do not need to include the domain
  // * Use same document root as webserver
  // * Can set a hardcoded value:
  // define("WWW_ROOT", '/~joseramirez/CMS/globe_bank/public');
  // define("WWW_ROOT", '');
  // * Can dynamically find everything in URL up to "/public"
  $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);

  //this does it dynamically , this find the root dynamically
   // it is an absolute value we can use on all of our pages
   define("WWW_ROOT", $doc_root);


  require_once('functions.php');

  //this will load up the database.php file and we will have those database function availabe
  require_once('database.php');

  //this makes sure we have access the the query functions
  require_once('query_functions.php');

/*It means that any time any page loads initialize.php, it's going to load in all those database functions and initiate the first connection to the database. And then, I have this variable db available to me that I can use to work with. And so db is going to be the thing I use to connect and to make queries on from then on.*/
  $db = db_connect();

//check the footer for the db_disconnect function

?>
