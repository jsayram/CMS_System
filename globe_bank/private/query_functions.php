<?php

//BASIC CRUD functions CREATE,READ,UPDATE,DELETE for subjects and pages

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


    function validate_subject($subject) {

        //array to add errors to
        $errors = [];

        // menu_name
        if(is_blank($subject['menu_name'])) {
            $errors[] = "Name cannot be blank.";
        } elseif(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Name must be between 2 and 255 characters.";
        }

        // position
        // Make sure we are working with an integer becuase by default form data is a string
        $postion_int = (int) $subject['position'];
        if($postion_int <= 0) {
            $errors[] = "Position must be greater than zero.";
        }
        //does not exept a position larger than 999
        if($postion_int > 999) {
            $errors[] = "Position must be less than 999.";
        }

        // visible
        // Make sure we are working with a string
        $visible_str = (string) $subject['visible'];
        if(!has_inclusion_of($visible_str, ["0","1"])) {
            $errors[] = "Visible must be true or false.";
        }

        //returns array of errors
        return $errors;
    }

    function insert_subject($subject){
        //want to make sure we bring in the $db variable form the global scope, modify it directly
        global $db;

        /*custom validation function checks if the data inputed by the user was valid, it will return a list of all the problems, its essentially an array of errors*/
        $errors = validate_subject($subject);
        //if errors is not empty , (if there is errors)
        //the code stops here and it doesnt execute
        if(!empty($errors)){
            return $errors;
        }


        //send the data to the database

        $sql = "INSERT INTO subjects ";
        $sql .= "(menu_name, position, visible) ";
        $sql .= "VALUES (";
        //note the single quotes around each of the variables below, to all values submited to sql
        $sql .= "'" . $subject['menu_name'] . "',";
        $sql .= "'" . $subject['position'] . "',";
        //note that the last one does not have a comma at the end
        $sql .= "'" . $subject['visible'] . "'";
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

        /*custom validation function checks if the data inputed by the user was valid, it will return a list of all the problems, its essentially an array of errors*/
        $errors = validate_subject($subject);
        //if errors is not empty , (if there is errors)
        //the code stops here and it doesnt execute
        if(!empty($errors)){
            return $errors;
        }

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
            exit();
        }


    }

    function delete_subject($id){
        global $db;

        $sql = "DELETE FROM subjects ";
        $sql .= "WHERE id='" .$id . "' ";
        $sql .= "LIMIT 1";


        $result = mysqli_query($db,$sql);

        //NOTE THAT FOR DELETE statements, $result is true/false
        if($result){
            return true;
        }
        else{
            //if the Delete failed its going to spit out where the sql went wrong
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
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

    function find_page_by_id($id){
        //want to make sure we bring in the $db variable form the global scope, modify it directly
        global $db;

        $sql = "SELECT * FROM pages ";
        //notice that theres are '' around the id below
        $sql .= "WHERE id='" . $id . "'";
        $result = mysqli_query($db, $sql);
        //used for error checking making sure that the query is good
        confirm_result_set($result);

        //fetches associative array for the result gathered from the query
        $page = mysqli_fetch_assoc($result);
        //this frees up married
        mysqli_free_result($result);

        //returns the associative array
        return $page;
    }


    function validate_page($page) {

        //array to add errors to
        $errors = [];

        // menu_name
        if(is_blank($page['menu_name'])) {
            $errors[] = "Name cannot be blank.";
        } elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Name must be between 2 and 255 characters.";
        }

        $current_id = $page['id'] ?$page['id']: '0';
        if(!has_unique_page_menu_name($page['menu_name'], $current_id)) {
            $errors[] = "Menu name must be unique.";
        }


        // position
        // Make sure we are working with an integer becuase by default form data is a string
        $postion_int = (int) $page['position'];
        if($postion_int <= 0) {
            $errors[] = "Position must be greater than zero.";
        }
        //does not exept a position larger than 999
        if($postion_int > 999) {
            $errors[] = "Position must be less than 999.";
        }

        // visible
        // Make sure we are working with a string
        $visible_str = (string) $page['visible'];
        if(!has_inclusion_of($visible_str, ["0","1"])) {
            $errors[] = "Visible must be true or false.";
        }

        //content
        if(is_blank($page['content'])){
            $errors[] = "Content cannot be blank.";
        }

        //returns array of errors
        return $errors;
    }

    function insert_page($page){
        //want to make sure we bring in the $db variable form the global scope, modify it directly
        global $db;

        /*custom validation function checks if the data inputed by the user was valid, it will return a list of all the problems, its essentially an array of errors*/
        $errors = validate_page($page);
        //if errors is not empty , (if there is errors)
        //the code stops here and it doesnt execute
        if(!empty($errors)){
            return $errors;
        }

        //send the data to the database

        $sql = "INSERT INTO pages ";
        $sql .= "(subject_id, menu_name, position, visible, content) ";
        $sql .= "VALUES (";
        //note the single quotes around each of the variables below, to all values submited to sql
        $sql .= "'" . $page['subject_id'] . "',";
        $sql .= "'" . $page['menu_name'] . "',";
        $sql .= "'" . $page['position'] . "',";
        $sql .= "'" . $page['visible'] . "',";
        //note that the last one does not have a comma at the end
        $sql .= "'" . $page['content'] . "'";
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

            exit;
        }

    }

    function update_page($page){
        //want to make sure we bring in the $db variable form the global scope, modify it directly
        global $db;

        /*custom validation function checks if the data inputed by the user was valid, it will return a list of all the problems, its essentially an array of errors*/
        $errors = validate_page($page);
        //if errors is not empty , (if there is errors)
        //the code stops here and it doesnt execute
        if(!empty($errors)){
            return $errors;
        }


        $sql = "UPDATE pages SET ";
        //note the single quotes around the variable name
        $sql .= "subject_id='" . $page['subject_id'] . "', ";
        $sql .= "menu_name='" . $page['menu_name'] . "', ";
        $sql .= "position='" . $page['position'] . "', ";
        $sql .= "visible='" . $page['visible'] . "', ";
        //note that the last one does not have a comma at the end before WHERE clause who also doesnt have a comma at the end
        $sql .= "content='" . $page['content'] . "' ";
        $sql .= "WHERE id='" . $page['id'] . "' ";
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
            exit;
        }

    }

    function delete_page($id){
        //want to make sure we bring in the $db variable form the global scope, modify it directly
        global $db;

        $sql = "DELETE FROM pages ";
        $sql .= "WHERE id='" .$id . "' ";
        $sql .= "LIMIT 1";


        $result = mysqli_query($db,$sql);

        //NOTE THAT FOR DELETE statements, $result is true/false
        if($result){
            return true;
        }
        else{
            //if the Delete failed its going to spit out where the sql went wrong
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }

    }

?>
