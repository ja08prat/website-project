<?

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');
// Set the title of the page
$title = "Delete Aside";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$id = $_GET['id'];
$action = $_GET['action'];

if ($id == '') {
    $result = run_query("SELECT asideid, title FROM ja08prat_asides");
    $pages = array();
    while($row = $result -> fetch_assoc()){
        $pages[ $row['asideid'] ] = $row['title'];
    }
    echo '
    <form method="get" action="delete_aside.php">'.
        return_option_select('id',$pages, 'Select an aside').'
        <input type = "submit">
    </form>';
}
else if ($action=='delete') {
	
	

    $sql = "DELETE FROM ja08prat_asides WHERE asideid='$id'";
    run_query($sql);
	// $sql = "DELETE FROM has_aside WHERE asideid='$aid' AND pageid='$pid'";
	
	echo '<p><b>'.$id.'</b> was deleted from <b>ja08prat_asides</b></p>';
}
else {		
	echo '
		<p>Are you sure you want to delete <b>'.$id.'</b> from <b>ja08prat_asides</b>?</p>
		<p>
			<a href="delete_aside.php?action=delete&id='.$id.'" class="btn btn-danger">Yes</a>
		</p>';
}

echo '</div>';

echo_foot();

?>