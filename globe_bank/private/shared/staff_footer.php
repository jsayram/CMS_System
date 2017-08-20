<footer>
 <?php date_default_timezone_set('UTC') ?>
  &copy; <?php echo date('Y'); ?> Globe Bank
</footer>

</body>
</html>

<?php
/*This passes in that db variable, that was created int the initialize.php file which made the connection or called the db_connect function, here is disconnecting*/
    db_disconnect($db);

;?>
