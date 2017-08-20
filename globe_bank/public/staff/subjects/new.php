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
else{
    echo 'No Error';
}
;?>
