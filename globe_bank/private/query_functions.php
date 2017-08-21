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


    function find_subject_by_id($id){
        //want to make sure we bring in the $db variable form the global scope, modify it directly
        global $db;

        $sql = "SELECT * FROM subjects ";
        //notice that theres are '' around the id below
        $sql .= "WHERE id='" . $id . "'";
        $result = mysqli_query($db, $sql);
        //used for error checking making sure that the query is good
        confirm_result_set($result);

        //fetches associative array for the result gathered from the query
        $subject = mysqli_fetch_assoc($result);
        //this frees up married
        mysqli_free_result($result);

        //returns the associative array
        return $subject;
    }

    function insert_subject($menu_name, $position, $visible){
        //want to make sure we bring in the $db variable form the global scope, modify it directly
        global $db;

        //send the data to the database

        $sql = "INSERT INTO subjects ";
        $sql .= "(menu_name, position, visible) ";
        $sql .= "VALUES (";
        //note the single quotes around each of the variables below, to all values submited to sql
        $sql .= "'" . $menu_name . "',";
        $sql .= "'" . $position . "',";
        //note that the last one does not have a comma at the end
        $sql .= "'" . $visible . "'";
        $sql .= ")";

        $result = mysqli_query($db,$sql);
        // REMEBER That for INSERT statements, $result is true/false
        //this just checks if it succeded or not for the INSERT
        if ($result){

            //if it works just return true
            return true;

        }else{
            //in case INSERT fails
            //this reports back what is the problem
            echo mysqli_error($db);
            //custom function that diconnects the database
            db_disconnect($db);
            //and quit

            exit();
        }

    }

    function update_subject($subject){
        //want to make sure we bring in the $db variable form the global scope, modify it directly
        global $db;

        $sql = "UPDATE subjects SET ";
        //note the single quotes around the variable name
        $sql .= "menu_name='" . $subject['menu_name'] . "', ";
        $sql .= "position='" . $subject['position'] . "', ";
        $sql .= "visible='" . $subject['visible'] . "' ";
        $sql .= "WHERE id='" . $subject['id'] ."' ";
        //this is a safety measure to LIMIT to one item of the database
        $sql .= "LIMIT 1";

        $result = mysqli_query($db,$sql);
        //FOR UPDATE statement  THE result is either true or false
        if($result){
            //return true if UPDATE was successful
            return true;

        }else{
            //in case INSERT fails
            //this reports back what is the problem
            echo mysqli_error($db);
            //custom function that diconnects the database
            db_disconnect($db);
            //and quit
            echo "   SHIITTTT";
            exit();
        }


    }

    function find_all_pages(){
        //want to make sure we bring in the $db variable form the global scope, modify it directly
        global $db;

        //this returns back the page set that we can work with
        $sql = "SELECT * FROM pages ";
        $sql.= "ORDER BY subject_id ASC, position ASC";
        //echo $sql;
        $result = mysqli_query($db,$sql);
        //this custom function will confirm if we do get back a query
        confirm_result_set($result);
        return $result;
    }

?>
