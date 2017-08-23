<?php

   // this takes care of figuring out if you have the leading foward slash or not
//then it appends it to the WWW_ROOT and retuns the value

    function url_for($script_path) {
        // add the leading '/' if not present
        if($script_path[0] != '/') {
            $script_path = "/" . $script_path;
        }
        //NOTE THAT THIS DOES NOT ECHO THE PATH JUST RETURNS IT
        return WWW_ROOT . $script_path;
    }


// functions to make my life esier, used to not have to type urlencode or rawurlencode everytime, these make sure we are not using the reserved character in the URL
    function u($string=""){
        return urlencode($string);
    }

    function raw_u($string=""){
    return rawurlencode($string);
    }


   //this encodes html special characters so that they dont cause problems when placed in a script
    function h($string=""){
        return htmlspecialchars($string);
    }

   //these functions will send error messages
   function error_404(){
       header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
       exit();

   }

    function error_500(){
        header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
        exit();
    }

   //used for redirecting to another location
    function redirect_to($location){
        header("Location: " . $location);
        exit();
    }

    //functions for checking if is a get request or post request, used for conditions inside the forms, this will issure we respod appropirately if the user refreshes a form page that it does the approprite action
    function is_post_request(){
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    function is_get_request(){
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    //This will display errors
    function display_errors($errors=array()) {
        $output = '';
        if(!empty($errors)) {
            $output .= "<div class=\"errors\">";
            $output .= "Please fix the following errors:";
            $output .= "<ul>";
            foreach($errors as $error) {
                $output .= "<li>" . h($error) . "</li>";
            }
            $output .= "</ul>";
            $output .= "</div>";
        }
        return $output;
    }



?>
