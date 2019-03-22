<?

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');


$id = $_GET['pageid'];
$sql = "SELECT asideid FROM ja08prat_has_aside WHERE pageid = '$id'";
$r = run_query($sql);




while($row = $r -> fetch_assoc()){
    $aid = $row['asideid'];
    
    $sql2 = "SELECT title, content, color FROM ja08prat_asides WHERE asideid='$aid'";
    $r2 = run_query($sql2);
    $aside_content = $r2->fetch_assoc(); 
                      
    echo'<aside>
        <h3>'.$aside_content['title'].'</h3>
        <p>'.$aside_content['content'].'</p>
        </aside>';                  
    
}
                      




?>