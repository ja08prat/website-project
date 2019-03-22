<?

/* -----------------------------------------------------------------------------
Returns start of HTML document from <!doctype> to <body> with Bootstrap 4.0 link
and custom style.css link. Slices title into head	

Input: Webpage title (string)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_head($title) {
	return '
		<!doctype html>
		<html lang="en">
		  <head>
		    <meta charset="utf-8">
		    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		    <link rel="stylesheet" href="style.css">
		    <title>'.$title.'</title>
		  </head>
		  <body>';
}
/* -----------------------------------------------------------------------------
Echo return_head
----------------------------------------------------------------------------- */
function echo_head($title) {
	echo return_head($title);
}


/* -----------------------------------------------------------------------------
Returns end of HTML document from </body> to </html> with Bootstrap 4.0 scripts
jquery 3.2, popper 1.12 and boostrap 4.0

Input: None
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_foot() {
	return '
		    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
            <a href="login.php" class="btn btn-primary">User Login</a>
            <a href="admin_login.php" class="btn btn-primary">Admin Login</a>
            <a href="admin_logout.php" class="btn btn-primary">Logout</a>
            <a href="control_panel.php" class="btn btn-primary">Control Panel</a>
            <a href="http://sienasellbacks.com/ja08prat/project2" class="btn btn-primary">Main Site</a>
		  </body>
		</html>';
}
/* -----------------------------------------------------------------------------
Echo  return_foot
----------------------------------------------------------------------------- */
function echo_foot() {
	echo return_foot();
}	
	

/* -----------------------------------------------------------------------------
Returns HTML document content from content database

Input: The current page id (string)
Output: HTML text (string)	
----------------------------------------------------------------------------- */
function return_content($pageid) {   	
	$sql = "SELECT title, content, parent FROM ja08prat_pages WHERE pageid = '".$pageid."'";
	$content = run_query($sql)->fetch_assoc();
	  	
	return '
		<div class="container">
		  <h1>'.$content['title'].'</h1>
			<div class="row">
				<div class="col-sm">
					<main>'.$content['content'].'</main>
				</div>
				<div class="col-sm-4">
					'.return_side_content($pageid).'
				</div>
			</div>
			<footer>
				<a class="btn btn-primary float-left" href="?pageid='.$content['parent'].'">Back to parent</a>
				<p class="float-right copy-right">&copy; '.date("Y").'</p>
			</footer>		  
	  </div>';	
}
/* -----------------------------------------------------------------------------
Echo  return_content
----------------------------------------------------------------------------- */
function echo_content($pageid) {
	echo return_content($pageid);
}	
function echo_side_content($pageid) {
	echo return_side_content($pageid);
}	

function return_side_content($pageid) {   	


	$sql = "SELECT asideid FROM ja08prat_has_aside WHERE pageid = '".$pageid."'";
	$result = run_query($sql);
	$out = '';
	while ($row = $result->fetch_assoc()) {
		$aid = $row['asideid'];
		$sql2 = "SELECT title, content, color FROM ja08prat_asides WHERE asideid = '".$aid."'";
		$result2 = run_query($sql2);
		$aside_content = $result2->fetch_assoc();
		
		$out = $out . '<aside style="background-color: '.$aside_content['color'].'; color: black">
        <h3>'.$aside_content['title'].'</h3>
        <p>'.$aside_content['content'].'</p>
        </aside>';
	}
	return $out;

	
}








?>