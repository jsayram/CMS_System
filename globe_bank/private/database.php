<!--this is needed so we can use the functions created-->
<?php
    require_once('db_credentials.php');

   // this function takes care of all the bussiness of getting us connected to the database, it will look for the constants it will create a connection for me and ill have it ready to use
    function db_connect(){
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        return $connection;
    }

    //this function is used to close the data base connection
    function db_disconnect($connection){
        if(isset($connection)){
            mysqli_close($connection);
        }

    }

?>
