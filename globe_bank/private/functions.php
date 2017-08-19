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
?>
