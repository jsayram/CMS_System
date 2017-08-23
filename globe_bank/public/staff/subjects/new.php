<!--this is needed so we can use the functions crated-->
<?php
require_once('../../../private/initialize.php');

/* //CODE USED FOR TESTING PURPOSES
    //this tenary operator is used for PHP < 7.0
    $test = isset($_GET['test']) ? $_GET['test']: '';
    //tenary operator used after PHP >=7.0
    //$test = $_GET['test'] ??  '';

    if($test == '404'){
        //custom function created
        error_404();
    }elseif($test == '500'){
        //custom function created
        error_500();
    }elseif($test == 'redirect'){
        //page redirection using the custom function
        redirect_to(url_for('/staff/subjects/index.php'));
    }
    //else{
    //    //echo 'No Error';
    //}*/

if(is_post_request()){

    // Handle form values sent by new.php

    //tenary operators for can be used for php >-7.0
    //$menu_name = $_POST['menu_name'] ?? '';
    //$position = $_POST['position'] ?? '';
    //$visible = $_POST['visible'] ?? '';


    //tenary operators used for php <7.0
    $subject=[];

    $subject['menu_name'] = isset($_POST['menu_name']) ? $_POST['menu_name']: '';
    $subject['position'] = isset($_POST['position']) ? $_POST['position']: '';
    $subject['visible'] = isset($_POST['visible']) ? $_POST['visible']: '';

    //send the data to the database using custom function
    $result = insert_subject($subject);
    if($result === true){
        //find out what that new id is
        $new_id = mysqli_insert_id($db);
        //redirect the user to the show.php page showcasing the new id
        redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));
    }else{

        $errors = $result;

    }



    /* code for displaying the values of database, used for testing*/
    //    echo "Form parameters<br />";
    //    echo "Menu name: " . $menu_name . "<br />";
    //    echo "Position: " . $position . "<br />";
    //    echo "Visible: " . $visible . "<br />";


}else{

    //else display the blank form

   // redirect_to(url_for('/staff/subjects/new.php'));
}



//find subjects in the database , and it will return all subjects to us
$subject_set = find_all_subjects();

//this will tell us how many rows there are , that will give us a subject count, but since we are adding a subject in this file (new.php) we will add +1
$subject_count = mysqli_num_rows($subject_set) + 1;
//free up memory
mysqli_free_result($subject_set);


$subject=[];
//so the new position the subject is placed is by default subject count created above
$subject["position"]= $subject_count;


;?>


<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create Subject</h1>
<!--DIPLAYING OUR ERRORS -->
        <?php echo display_errors($errors) ;?>

        <form action="<?php echo url_for('/staff/subjects/new.php') ;?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>

                    <select name="position">
                        <?php
                        for($i=1; $i <= $subject_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if($subject["position"] == $i) {
                                echo " selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                    </select>
<!--
                    <select name="position">
                        <option value="1">1</option>
                    </select>
-->
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1"/>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Subject" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
