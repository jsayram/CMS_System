<!--this is needed so we can use the functions crated-->
<?php
require_once('../../../private/initialize.php');
//this tenary operator is used for PHP < 7.0

//$test = isset($_GET['test']) ? $_GET['test']: '';

//tenary operator used after PHP >=7.0
//$test = $_GET['test'] ??  '';


/* This is code for testing the error messages*/
//if($test == '404'){
//    //custom function created
//    error_404();
//}elseif($test == '500'){
//    //custom function created
//    error_500();
//}elseif($test == 'redirect'){
//    //page redirection using the custom function
//    redirect_to(url_for('/staff/subjects/index.php'));
//}
//else{
//    //echo 'No Error';
//}


//We need to have a variable for the ID. So we need something that's going to read that in.So in every case, not just when it's a post request, we're always to want to have ID equals and get ID. Now if ID's not set, we know we could do something like this

//if is not set then go back to the index.php
if(!isset($_GET['id'])){
    redirect_to(url_for('/staff/subjects/index.php'));
}
$id = $_GET['id'];

/*make sure that when ever working with forms thares always default values
menuName, postion , and visible default values, this is used for testing purposes */
//$menu_name = '';
//$position = '';
//$visible = '';


//this processes the information if its present if not find the one that is already in the database
if(is_post_request()){

    // Handle form values sent by new.php

    //tenary operators for can be used for php >-7.0
    //$menu_name = $_POST['menu_name'] ?? '';
    //$position = $_POST['position'] ?? '';
    //$visible = $_POST['visible'] ?? '';

    $subject = [];
    $subject['id'] = $id;
    //tenary operators used for php <7.0
    $subject['menu_name'] = isset($_POST['menu_name']) ? $_POST['menu_name']: '';
    $subject['position'] = isset($_POST['position']) ? $_POST['position']: '';
    $subject['visible'] = isset($_POST['visible']) ? $_POST['visible']: '';

    //update the subject if there is no errors
    $result = update_subject($subject);

    if($result === true){
        //redirect to go back to show.php to look at the work of what was just editied and we need the id
        redirect_to(url_for('/staff/subjects/show.php?id=' . $id ));
    }else{
        $errors = $result;
        //this displays the errors on the screen good for debugging
        //var_dump($errors);
    }



}

else{ //if is a GET request and not a post request

    //this returns an associative array to us that contains all the attributes we need for that subject
    $subject = find_subject_by_id($id); // used to display the form
    //redirect_to(url_for('/staff/subjects/new.php'));

    //find subjects in the database , and it will return all subjects to us
    $subject_set = find_all_subjects();

    //this will tell us how many rows there are , that will give us a subject count
    $subject_count = mysqli_num_rows($subject_set);
    mysqli_free_result($subject_set);

}

;?>


<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject edit">
        <h1>Edit Subject</h1>

<!--       DISPLAYING THE ERRORS -->
       <?php echo display_errors($errors) ;?>


        <form action="<?php echo url_for('/staff/subjects/edit.php?id=') . h(u($id)); ?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="<?php echo h($subject['menu_name']) ;?>" /></dd>
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
                        <option value="1"<?php //if($subject['position'] == "1") {echo " selected";} ?>>1</option>
                    </select>
-->
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1"<?php if($subject['visible'] == "1") {echo " checked";} ?> />
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Subject" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
