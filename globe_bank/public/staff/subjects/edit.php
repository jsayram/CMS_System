<!--this is needed so we can use the functions crated-->
<?php
require_once('../../../private/initialize.php');
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
//}
;?>


<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject edit">
        <h1>Edit Subject</h1>

        <form action="" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <option value="1">1</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1" />
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Edit Subject" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
