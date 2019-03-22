<?

require_once('site_core.php');
require_once('site_forms.php');
require_once('site_db.php');

// Set the title of the page
$title = "Update Users";

// Echo the HTML head with title
echo_head($title);

// Echo Bootstrap container 
echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

// Get the page id and action
$id = $_GET['id'];
$action = $_GET['action'];

// If the id is null/blank
if ($id == '') {
	
	// Get the pageid and title of all pages
	$result = run_query("SELECT userid, type FROM ja08prat_users");
	
	// Transform it into an associative array
	$users = array();
	while ($row = $result->fetch_assoc()) {
		$users[ $row['userid'] ] = $row['userid'];
	}
	
	// Generate a dropdown menu of all the pages
	echo '
		<form method="get" action="updateUsers.php">'.
			return_option_select('id',$users,'Select a user').'
			<input type="submit">
		</form>';
}
// If action is update
else if ($action=='update') {

	// Get the posted form data
	$id = $_GET['id'];
	$passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
	$type = $_POST['type'];
	
	// Form the query
	$sql = "UPDATE ja08prat_users SET userid = '$id', passwd = '$passwd', type = '$type' WHERE userid='$id'";


	// Run the query
	run_query($sql);
	
	// Echo feedback
	echo '
		<p><a href="index.php?userid='.$id.'">'.$id.'</a> was updated from ja08prat_users</p>';
}

// If the id is given but action is not update
else {
	
	// Get all the pages to generate the parent drop down
	$result = run_query("SELECT userid, passwd, type FROM ja08prat_users");
	$users = array();
	while ($row = $result->fetch_assoc()) {
		$users[ $row['userid'] ] = $row['userid'];
	}	
	
	// Get the data for the selected page
	$result = run_query("SELECT * FROM ja08prat_users WHERE userid='$id'");
	$values = $result->fetch_assoc();
	
	
	// Ouput the edit form
	echo '
		<form action="updateUsers.php?action=update&id='.$id.'" method="post">
			<label>Page ID: </label> <b>'.$id.'</b><br>'.
			return_input_text('passwd','Password',$values['passwd']).
			return_input_text('type','Type',$values['type']).'
			<input type="submit" class="btn btn-primary" value="Update">
		</form>';	
}

echo '</div>';

echo_foot();

?>