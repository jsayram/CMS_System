<?php require_once('../../../private/initialize.php'); ?>

<?php


////this returns back the subject set that we can work with
//$sql = "SELECT * FROM subjects ";
//$sql.= "ORDER BY position ASC";
//$subject_set = mysqli_query($db,$squl);

// this calls the custom function created that holds the code from abaove
//this returns back the subject set that we can work with
$subject_set = find_all_subjects();


//this mimicks data that you would find in a database
//$subjects = [
//    ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'About Globe Bank'],
//    ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'Consumer'],
//    ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Small Business'],
//    ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Commercial'],
//];



?>

<?php $page_title = 'Subjects'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="subjects listing">
        <h1>Subjects</h1>

        <div class="actions">
            <!--this is a link to create new subjects-->
            <a class="action" href="<?php echo url_for('/staff/subjects/new.php') ;?>">Create New Subject</a>
        </div>

        <table class="list">
            <tr>
                <th>ID</th>
                <th>Position</th>
                <th>Visible</th>
                <th>Name</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>


        <?php //this is used for the data pulled form actual database
            while($subject = mysqli_fetch_assoc($subject_set)){ ?>
<!--
            <?php
              //this was used for the micked database set
            //foreach($subjects as $subject) { ?>
-->
            <tr>
                <td><?php echo h($subject['id']); ?></td>
                <td><?php echo h($subject['position']); ?></td>
                <td><?php echo $subject['visible'] == 1 ? 'true' : 'false'; ?></td>
                <td><?php echo h($subject['menu_name']); ?></td>
                <td><a class="action" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($subject['id']))); ?>">View</a></td>
                <td><a class="action" href="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($subject['id']))); ?>">Edit</a></td>
                <td><a class="action" href="<?php echo url_for('/staff/subjects/delete.php?id=' . h(u($subject['id']))); ?>">Delete</a></td>
            </tr>
            <?php } ?>
        </table>

        <?php
          //this is used to free up memory where the query was stored , because it will not be used for the remainder of the program
            mysqli_free_result($subject_set);
        ?>

    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
