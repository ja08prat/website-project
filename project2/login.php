<?
session_start();
	
require_once('site_core.php');
require_once('site_db.php');
echo_head("Login");
echo '<div class="container">';
if ($_SESSION['authenticated']) {
  echo '
    <div class="alert alert-info">Already logged in</div>
    <a href="admin_logout.php" class="btn btn-primary">Logout</a>';
}
else {
  // Add the login code, i.e., if statement to check the key matches, otherwise print the form
    
    
    if ($_POST[user] != null) {
        $sql = "SELECT passwd FROM ja08prat_users WHERE userid = '$_POST[user]'";
        $result = run_query($sql);
        //getting necessary information
         $row = $result -> fetch_assoc();
         $hashed_password = $row[passwd];   
         
        if (password_verify($_POST[passwd], $hashed_password)) {
            $_SESSION['authenticated'] = true;
            echo 'Password is valid!';
        } 
        else {
            echo 'Invalid password.';
        }
        
        
        }
    else {
        echo '
            <form action="login.php" method="post">
            <label>username: <input type="text" class="form-control" name="user"></label>
            <label>password: <input type="password" class="form-control" name="passwd"></label>
            <input type="submit" class="btn btn-primary">	
            </form>';
    }
}
echo '</div>';
echo_foot();	
?>