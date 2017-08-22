<!--this is needed so we can use the functions crated-->
<?php
require_once('../../../private/initialize.php');


//We need to have a variable for the ID. So we need something that's going to read that in.So in every case, not just when it's a post request, we're always to want to have ID equals and get ID. Now if ID's not set, we know we could do something like this

//if is not set then go back to the index.php
if(!isset($_GET['id'])){
    redirect_to(url_for('/staff/pages/index.php'));
}
$id = $_GET['id'];

//make sure that when ever working with forms thares always default values
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

   // THIS UPDATES THE DATABASE
    //tenary operators used for php < 7.0
    $page = [];
    $page['subject_id'] = isset($_POST['subject_id']) ?$_POST['subject_id']: '';
    $page['menu_name'] = isset($_POST['menu_name']) ? $_POST['menu_name']: '';
    $page['position'] = isset($_POST['position']) ? $_POST['position']: '';
    $page['visible'] = isset($_POST['visible']) ? $_POST['visible']: '';
    $page['content'] = isset($_POST['content']) ?$_POST['content']: '';

    $result = update_page($page);
    redirect_to(url_for('/staff/pages/show.php?id=' . $id));


}else{

    $page = find_page_by_id($id);

    $page_set = find_all_pages();
    $page_count = mysqli_num_rows($page_set);
    mysqli_free_result($page_set);

}


;?>



<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

    <div class="Page edit">
        <h1>Edit Page</h1>

        <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($id))); ?>" method="post">
            <dl>
                <dt>Subject</dt>
                <dd>

<!--                   this create an option list-->
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
                <input type="submit" value="Edit Page" />
            </div>
        </form>

    </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>

