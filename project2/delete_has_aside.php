<?

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');
// Set the title of the page
$title = "Delete Aside Relationship";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$pid = $_GET['pid'];
$aid = $_GET['aid'];
$action = $_GET['action'];

if ($pid == '') {
    $result = run_query("SELECT pageid FROM ja08prat_has_aside");
    $pages = array();
    while($row = $result -> fetch_assoc()){
        $pages[ $row['pageid'] ] = $row['pageid'];
    }
    $result = run_query("SELECT asideid FROM ja08prat_has_aside");
    $asides = array();
    while($row = $result -> fetch_assoc()){
        $asides[ $row['asideid'] ] = $row['asideid'];
    }
    echo '
    <form method="get" action="delete_has_aside.php">'.
        return_option_select('pid',$pages, 'Select a page').
        return_option_select('aid',$asides, 'Select an aside').'
        <input type = "submit">
    </form>';
}
else if ($action=='delete') {
	
	
	
    $sql = "DELETE FROM ja08prat_has_aside WHERE asideid='$aid' AND pageid='$pid'";
	run_query($sql);

	echo '<p><b>'.$aid.'</b> was deleted from <b>'.$pid.'</b></p>';
}
else {		
	echo '
		<p>Are you sure you want to delete <b>'.$aid.'</b> from <b>'.$pid.'</b>?</p>
		<p>
			<a href="delete_has_aside.php?action=delete&pid='.$pid.'&aid='.$aid.'" class="btn btn-danger">Yes</a>
            
		</p>';
}

echo '</div>';

echo_foot();

?>