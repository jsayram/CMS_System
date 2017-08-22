<?php
//used to initialize php
require_once('../../../private/initialize.php');

//this makes sure that we have an ID to be able to delete it
if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}
$id = $_GET['id'];

//could have this code, to make sure page is actually in database but is not neccessary
////then is going to find the page by its id
//$page = find_page_by_id($id);

/*just like we did when we were working with Edit.
We're going to display the form and then that form will submit back to this page and if it's a Post request, then in this block will actually delete the code*/
if(is_post_request()) {
    // in this block we will actually delete the page
    $result = delete_page($id);
    //if the delete succeed then it will riderect the link back to index.php
    redirect_to(url_for('/staff/pages/index.php'));

}else{
    //find page, returns associative array of the pages
    $page = find_page_by_id($id);
}

?>

<?php $page_title = 'Delete Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>


    <!--   It just comes up and says 'Delete page' and it says 'Are you sure you want to delete this page' and because we've found the page in the database, we can display its name. We can say, 'Are you sure this is the one you want to delete?' and then they'll have a button that says 'Yes, delete page' and when they click it, it's going to submit a form and that form doesn't have any attributes on it, it's just a Post request, that's the important part.

It's just a Post request that goes back to this same page but with an id, with a page id, to tell it which one to delete. The important part is here we have a form just so we can get that Post request submitted.-->
    <div class="page delete">
        <h1>Delete Page</h1>
        <p>Are you sure you want to delete this page?</p>
        <!-- since we got the page from the database we can display the name below using $page[menu_name]-->
        <p class="item"><?php echo h($page['menu_name']); ?></p>

        <form action="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id']))); ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete Page" />
            </div>
        </form>
    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
