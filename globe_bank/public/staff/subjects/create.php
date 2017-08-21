<?php

require_once('../../../private/initialize.php');

if(is_post_request()){

    // Handle form values sent by new.php

    //tenary operators for can be used for php >-7.0
    //$menu_name = $_POST['menu_name'] ?? '';
    //$position = $_POST['position'] ?? '';
    //$visible = $_POST['visible'] ?? '';


    //tenary operators used for php <7.0
    $menu_name = isset($_POST['menu_name']) ? $_POST['menu_name']: '';
    $position = isset($_POST['position']) ? $_POST['position']: '';
    $visible = isset($_POST['visible']) ? $_POST['visible']: '';

    //send the data to the database using custom function
    $result = insert_subject($menu_name,$position,$visible);

     //find out what that new id is
     $new_id = mysqli_insert_id($db);
     //redirect the user to the show.php page showcasing the new id
     redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));


/* code for displaying the values of database, used for testing*/
//    echo "Form parameters<br />";
//    echo "Menu name: " . $menu_name . "<br />";
//    echo "Position: " . $position . "<br />";
//    echo "Visible: " . $visible . "<br />";


}else{
    redirect_to(url_for('/staff/subjects/new.php'));
}

?>
