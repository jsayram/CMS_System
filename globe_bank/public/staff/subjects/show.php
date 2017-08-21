<?php //brought in so that we can use the custom functions made that are found in the initilize directory
require_once('../../../private/initialize.php'); ?>

<?php

//this shows the id based on the items gathered from the subjects/index.php file
//tenary operator that checks if the id is set then it returns the id ,if not then set it to '1', is important when you take a value out from the super globals that you check if is there if not set it or else you can get an error whenever the id is not set.
//code for php less than 7.0
$id = isset($_GET['id']) ? $_GET['id']: '1' ;

//same code as above but for php > 7.0
//$id = $_GET['id'] ?? '1' ;


/* this show what 'id' was retrieved from the global $_GET variable h() is int the custom functions file so that no special characters are rendered
-- this is called escaping so that no special characters get through that could potentially hurt the system */

//echo h($id);


//$sql = "SELECT * FROM subjects ";
////notice that theres are '' around the id below
//$sql .= "WHERE id='" . $id . "'";
//$result = mysqli_query($db, $sql);
////used for error checking making sure that the query is good
//confirm_result_set($result);
//
////fetches associative array for the result gathered from the query
//$subject = mysqli_fetch_assoc($result);
////this frees up married
//mysqli_free_result($result);

//same as the code above just using the custom function made and passing in the id
$subject = find_subject_by_id($id);

?>

<?php $page_tittle = "Show Subject" ;?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id='content'>
    <a class='back-link' href="<?php echo url_for('/staff/subjects/index.php') ;?>">&laquo; Back to List</a>

    <div class= "subject show">

        <h1>Subject: <?php echo h($subject['menu_name']); ?></h1>

        <div class="attributes">
            <dl>
                <dt>Menu Name</dt>
                <dd><?php echo h($subject['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($subject['position']); ?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
            </dl>
        </div>

<!--        Page ID: <?php //echo h($id) ;?>-->

    </div>

</div>
</div>

<?php include(SHARED_PATH . '/staff_fotter.php') ;?>



<!--Adds the necessary url id for each of the links that is displayed-->
<!--
<a href="show.php?name=<?php // echo u('John Doe'); ?>">Link</a><br />
<a href="show.php?company=<?php// echo  u('Widgets&More'); ?>">Link</a><br />
<a href="show.php?query=<?php //echo  u('!#*?'); ?>">Link</a><br />
-->
