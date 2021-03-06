<?php require_once('../../../private/initialize.php'); ?>

<?php



////this mimicks page data for the database
//$pages = [
//    ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'About Globe Bank'],
//    ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'Consumer'],
//    ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Small Business'],
//    ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Commercial'],
//];


//this returns back the pages set that we can work with
$page_set = find_all_pages();


?>

<?php $page_title = 'Pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="pages listing">
        <h1>Pages</h1>

        <div class="actions">
            <!--this is a link to create new subjects-->
            <a class="action" href="<?php echo url_for('/staff/pages/new.php') ;?>">Create New Page</a>
        </div>

        <table class="list">
            <tr>
                <th>ID</th>
                <th>Subject ID</th>
                <th>Position</th>
                <th>Visible</th>
                <th>Name</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>

            <?php //this is used for the data pulled form actual database
            while($pages = mysqli_fetch_assoc($page_set)){ ?>
            <?php $subject = find_subject_by_id($pages['subject_id']); ?>

            <?php//used for the mimicked data
                //foreach($pages as $pages) { ;?>

            <!--used the h() custom method to make sure it is safe for html -->
            <tr>
                <td><?php echo h($pages['id']); ?></td>
                <td><?php echo h($subject['menu_name']); ?></td>
                <td><?php echo h($pages['position']); ?></td>
                <td><?php echo $pages['visible'] == 1 ? 'true' : 'false'; ?></td>
                <td><?php echo h($pages['menu_name']); ?></td>
                <td><a class="action" href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($pages['id']))); ?>">View</a></td>
                <td><a class="action" href="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($pages['id']))); ?>">Edit</a></td>
                <td><a class="action" href="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($pages['id']))); ?>">Delete</a></td>
            </tr>
            <?php } ?>
        </table>

        <?php
        //this is used to free up memory where the query was stored , because it will not be used for the remainder of the program
        mysqli_free_result($page_set);
        ?>

    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
