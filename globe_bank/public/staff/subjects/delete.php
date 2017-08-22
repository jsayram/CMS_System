<?php
//used to initialize php
require_once('../../../private/initialize.php');

//this makes sure that we have an ID to be able to delete it
if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/subjects/index.php'));
}
$id = $_GET['id'];

//could have this code, to make sure subject is actually in database but is not neccessary
////then is going to find the subject by its id
//$subject = find_subject_by_id($id);

/*just like we did when we were working with Edit.
We're going to display the form and then that form will submit back to this page and if it's a Post request, then in this block will actually delete the code*/
if(is_post_request()) {
    // in this block we will actually delete the subject
    $result = delete_subject($id);
    //if the delete succeed then it will riderect the page back to index.php
    redirect_to(url_for('/staff/subjects/index.php'));

}else{
    //find subject
    $subject = find_subject_by_id($id);
}

?>

<?php $page_title = 'Delete Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>


    <!--   It just comes up and says 'Delete Subject' and it says 'Are you sure you want to delete this subject' and because we've found the subject in the database, we can display its name. We can say, 'Are you sure this is the one you want to delete?' and then they'll have a button that says 'Yes, delete subject' and when they click it, it's going to submit a form and that form doesn't have any attributes on it, it's just a Post request, that's the important part.

    It's just a Post request that goes back to this same page but with an id, with a subject id, to tell it which one to delete. The important part is here we have a form just so we can get that Post request submitted.-->
    <div class="subject delete">
        <h1>Delete Subject</h1>
        <p>Are you sure you want to delete this subject?</p>
<!-- since we got the subject from the database we can display the name below using $subject[menu_name]-->
        <p class="item"><?php echo h($subject['menu_name']); ?></p>

        <form action="<?php echo url_for('/staff/subjects/delete.php?id=' . h(u($subject['id']))); ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete Subject" />
            </div>
        </form>
    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
