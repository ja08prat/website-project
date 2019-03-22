<?

require_once('site_db.php');

$sql = "CREATE TABLE IF NOT EXISTS `ja08prat_pages` (
  `pageid` varchar(32) NOT NULL,
  `title` varchar(64) NOT NULL,
  `parent` varchar(32) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`pageid`)
)";

run_query($sql);

echo 'SUCCESS: The following query executed: <pre>'.$sql.'</pre>';

$sql = "CREATE TABLE IF NOT EXISTS `ja08prat_asides` (
  `asideid` varchar(32) NOT NULL,
  `title` varchar(64) NOT NULL,
  `color` varchar(32) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`asideid`)
)";

run_query($sql);

echo 'SUCCESS: The following query executed: <pre>'.$sql.'</pre>';

$sql = "CREATE TABLE IF NOT EXISTS `ja08prat_has_aside` (
  `pageid` varchar(32) NOT NULL,
  `asideid` varchar(32) NOT NULL,
  `ord` int(11) DEFAULT NULL,
  PRIMARY KEY (`pageid`,`asideid`)
)";

run_query($sql);

echo 'SUCCESS: The following query executed: <pre>'.$sql.'</pre>';

?>