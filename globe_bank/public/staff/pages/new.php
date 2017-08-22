<!--this is needed so we can use the functions crated-->
<?php
require_once('../../../private/initialize.php');


//---make sure that when ever working with forms thares always default values
//menuName, postion , and visible default values
//$menu_name = '';
//$position = '';
//$visible = '';



//this processes the information if its present if not it will display the page
if(is_post_request()){

    // Handle form values sent by new.php

    //tenary operators for can be used for php >-7.0
    //$menu_name = $_POST['menu_name'] ?? '';
    //$position = $_POST['position'] ?? '';
    //$visible = $_POST['visible'] ?? '';


    //tenary operators used for php < 7.0
    $page = [];
    $page['subject_id'] = isset($_POST['subject_id']) ?$_POST['subject_id']: '';
    $page['menu_name'] = isset($_POST['menu_name']) ? $_POST['menu_name']: '';
    $page['position'] = isset($_POST['position']) ? $_POST['position']: '';
    $page['visible'] = isset($_POST['visible']) ? $_POST['visible']: '';
    $page['content'] = isset($_POST['content']) ?$_POST['content']: '';

    $result = insert_page($page);
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/staff/pages/show.php?id=' . $new_id))


}else{
    //---settting default values here
    $page = [];
    $page['subject_id'] = '';
    $page['menu_name'] = '';
    $page['position'] = '';
    $page['visible'] = '';
    $page['content'] = '';

    $page_set = find_all_pages();
    $page_count = mysqli_num_rows($page_set)+1;
    mysqli_free_result($page_set);

}


;?>



<?php $page_title = 'Create Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

    <div class="subject new">
        <h1>Create Page</h1>

        <form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
            <dl>
                <dt>Subject</dt>
                <dd>
<!--                    creates the drop down menu for all subjects-->
                    <select name="subject_id">
                        <?php
                        $subject_set = find_all_subjects();
                        while($subject = mysqli_fetch_assoc($subject_set)) {
                            echo "<option value=\"" . h($subject['id']) . "\"";
                            if($page["subject_id"] == $subject['id']) {
                                echo " selected";
                            }
                            echo ">" . h($subject['menu_name']) . "</option>";
                        }
                        mysqli_free_result($subject_set);
                        ?>
                    </select>


                </dd>
            </dl>
            <dl>
                <dt>Menu Name</dt>
                <dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <?php
                        for($i=1; $i <= $page_count; $i++) {
                            echo "<option value=\"{$i}\"";
                            if($page["position"] == $i) {
                                echo " selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0" />
                    <input type="checkbox" name="visible" value="1"<?php if($page['subject_id'] == "1") { echo " checked"; } ?> />
                </dd>
            </dl>
            <dl>
                <dt>Content</dt>
                <dd>
                    <textarea name="content" cols="60" rows="10"><?php echo h($page['content']); ?></textarea>
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create Page" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>

