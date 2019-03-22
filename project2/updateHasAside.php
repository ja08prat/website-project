<?

require_once('site_core.php');
require_once('site_forms.php');
require_once('site_db.php');

// Set the title of the page
$title = "Update Has_Asides";

// Echo the HTML head with title
echo_head($title);

// Echo Bootstrap container 
echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

// Get the page id and action
$pid = $_GET['pageid'];
$aid = $_GET['asideid'];
$action = $_GET['action'];

// If the id is null/blank
if ($pid == '') {
	
	// Get the pageid and title of all pages
	$result = run_query("SELECT pageid FROM ja08prat_has_aside");
	
	// Transform it into an associative array
	$pages = array();
	while ($row = $result->fetch_assoc()) {
		$pages[ $row['pageid'] ] = $row['pageid'];
	}
    $result = run_query("SELECT asideid FROM ja08prat_has_aside");
    $asides = array();
    while($row = $result->fetch_assoc()){
        $asides[ $row['asideid'] ] = $row['asideid'];
    }
	
	// Generate a dropdown menu of all the asides
	echo '
		<form method="get" action="updateHasAside.php">'.
			return_option_select('pageid',$pages,'Select a page').
            return_option_select('asideid',$asides,'Select an aside').'
			<input type="submit">
		</form>';
}
// If action is update
else if ($action=='update') {

	// Get the posted form data
	$ord = $_POST['ord'];

	
	// Form the query
	$sql = "UPDATE ja08prat_has_aside SET ord = '$ord' WHERE pageid='$pid' AND asideid='aid'";

	// Run the query
	run_query($sql);
	
	// Echo feedback
	echo '
		<p><a href="index.php?pageid='.$pid.'">'.$pid.'</a> was updated from ja08prat_has_aside</p>';
}

// If the id is given but action is not update
else {
	
	// Get all the pages to generate the parent drop down
	$result = run_query("SELECT ord FROM ja08prat_has_aside WHERE asideid='$aid' AND pageid='$pid'");
    $values = $result->fetch_assoc();
	
	echo '
		<form action="updateHasAside.php?action=update&pageid='.$pid.'&asideid='.$aid.'" method="post">
			<label>Aside ID: </label> <b>'.$aid.'</b><br>.
            <label>Page ID: </label> <b>'.$pid.'</b><br>'.
			return_input_text('ord','Order',$values['ord']).'
			<input type="submit" class="btn btn-primary" value="Update">
		</form>';	
}

echo '</div>';

echo_foot();

?>