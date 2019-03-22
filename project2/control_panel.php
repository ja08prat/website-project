<?
session_start();
require_once('site_core.php');
$title = "Control Panel";
echo_head($title);

if(!$_SESSION['authenticated']){
    echo'<a href="login.php" class="btn btn-primary">Click here to Login</a>';
}
else{
    echo'
    <h2>Create</h2>
    <ul>
        <li><a href="insert_page.php" class="btn btn-primary">Create Page</a></li>
        <li><a href="insert_aside.php" class="btn btn-primary">Create Aside</a></li>
        <li><a href="insert_has_aside.php" class="btn btn-primary">Create Has Aside</a></li>
        <li><a href="insert_user.php" class="btn btn-primary">Create User</a></li>
    </ul>
    <h3>Edit</h3>
    <ul>
        <li><a href="update.php" class="btn btn-primary">Edit Page</a></li>
        <li><a href="updateAside.php" class="btn btn-primary">Edit Aside</a></li>
        <li><a href="updateHasAside.php" class="btn btn-primary">Edit Has Aside</a></li>
        <li><a href="updateUsers.php" class="btn btn-primary">Edit User</a></li>     
    </ul>
    <h4>Delete</h4>
    <ul>
        <li><a href="delete.php" class="btn btn-primary">Delete Page</a></li>
        <li><a href="delete_aside.php" class="btn btn-primary">Delete Aside</a></li>
        <li><a href="delete_has_aside.php" class="btn btn-primary">Delete Has Aside</a></li>
        <li><a href="delete_user.php" class="btn btn-primary">Delete User</a></li>
     ';
echo_foot();
}


?>