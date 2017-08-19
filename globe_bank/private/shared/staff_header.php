<?php
  if(!isset($page_title)) { $page_title = 'Staff Area'; }
?>

<!doctype html>

<html lang="en">
  <head>
    <title>GBI - <?php echo $page_title; ?></title>
    <meta charset="utf-8">

<!-- THIS IS WHERE WE USE THE url_for function found in the functions.php file-->
      <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css')?>" />
  </head>

  <body>
    <header>
      <h1>GBI Staff Area</h1>
    </header>

    <navigation>
      <ul>
          <!-- THIS IS WHERE WE USE THE url_for function found in the functions.php file-->
          <li><a href="<?php echo url_for('/staff/index.php') ;?>">Menu</a></li>

       </ul>
    </navigation>
