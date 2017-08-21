<?php

    function find_all_subjects(){
        //want to make sure we bring in the $db variable form the global scope, modify it directly
        global $db;

        //this returns back the subject set that we can work with
        $sql = "SELECT * FROM subjects ";
        $sql.= "ORDER BY position ASC";
        //echo $sql;
        $result = mysqli_query($db,$sql);
        //this custom function will confirm if we do get back a query
        confirm_result_set($result);
        return $result;
    }

?>
