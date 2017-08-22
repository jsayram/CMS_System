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

//for debuggin purposes shos the $id on the page
//echo h($id);

//this returns an associate array with all values in the database
$page = find_page_by_id($id);


?>

<?php $page_tittle = "Show Page" ;?>
<?php include(SHARED_PATH . '/staff_header.php');?>

<div id='content'>
    <a class='back-link' href="<?php echo url_for('/staff/pages/index.php') ;?>">&laquo; Back to List</a>

    <div class="page show">

        <h1>Page: <?php echo h($page['menu_name']); ?></h1>

        <div class="attributes">
            <?php $subject = find_subject_by_id($page['subject_id']); ?>
            <dl>
                <dt>Subject</dt>
                <dd><?php echo h($subject['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Menu Name</dt>
                <dd><?php echo h($page['menu_name']); ?></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd><?php echo h($page['position']); ?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd><?php echo h($page['content']); ?></dd>
            </dl>
        </div>

    </div>

</div>


<?php include(SHARED_PATH . '/staff_fotter.php') ;?>



<!--Adds the necessary url id for each of the links that is displayed-->
<!--
<a href="show.php?name=<?//php echo u('John Doe'); ?>">Link</a><br />
<a href="show.php?company=<?//php echo  u('Widgets&More'); ?>">Link</a><br />
<a href="show.php?query=<?php //echo  u('!#*?'); ?>">Link</a><br />
-->
