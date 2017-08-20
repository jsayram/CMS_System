<!--this is needed so we can use the functions crated-->
<?php
require_once('../../../private/initialize.php');







//make sure that when ever working with forms thares always default values
//menuName, postion , and visible default values
$menu_name = '';
$position = '';
$visible = '';



//this processes the information if its present if not it will display the page
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


    echo "Form parameters<br />";
    echo "Menu name: " . $menu_name . "<br />";
    echo "Position: " . $position . "<br />";
    echo "Visible: " . $visible . "<br />";
}


;?>



<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create Page</h1>

        <form action="<?php echo url_for('/staff/pages/new.php') ;?>" method="post">
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="<?php echo h($menu_name) ;?>" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <option value="1"<?php if($position == "1") {echo " selected";} ?>>1</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1"<?php if($visible == "1") {echo " checked";} ?>  />
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Page" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>

