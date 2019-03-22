<?
session_start();
if (!$_SESSION['authenticated']) die ('Access Denied');
require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');
// Set the title of the page
$title = "Delete User";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$userid = $_GET['userid'];
$action = $_GET['action'];

if ($userid == '') {
    $result = run_query("SELECT userid FROM ja08prat_users");
    $users = array();
    while($row = $result -> fetch_assoc()){
        $users[ $row['userid'] ] = $row['userid'];
    }
    echo '
    <form method="get" action="delete_user.php">'.
        return_option_select('userid',$users, 'Select a user').'
        <input type = "submit">
    </form>';
}
else if ($action=='delete') {
	$sql = "DELETE FROM ja08prat_users WHERE userid='$userid'";
	run_query($sql);

	// $sql = "DELETE FROM asides WHERE asideid='$id'";
	// $sql = "DELETE FROM has_aside WHERE asideid='$aid' AND pageid='$pid'";
	
	echo '<p><b>'.$userid.'</b> was deleted from <b>ja08prat_users</b></p>';
}
else {		
	echo '
		<p>Are you sure you want to delete <b>'.$userid.'</b> from <b>ja08prat_users</b>?</p>
		<p>
			<a href="delete_user.php?action=delete&userid='.$userid.'" class="btn btn-danger">Yes</a>
		</p>';
}

echo '</div>';

echo_foot();

?>