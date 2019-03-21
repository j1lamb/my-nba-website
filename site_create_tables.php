<?
	
require_once('site_db.php');

$sql = "CREATE TABLE IF NOT EXISTS `j1lamb_pages` (
  `pageid` varchar(32) NOT NULL,
  `title` varchar(64) NOT NULL,
  `parent` varchar(32) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`pageid`)
)";

run_query($sql);

echo 'SUCCESS: The following query executed: <pre>'.$sql.'</pre>';

$asides = "CREATE TABLE IF NOT EXISTS `j1lamb_asides` (
  `asideid` varchar(32) NOT NULL,
  `title` varchar(64) NOT NULL,
  `color` varchar(32) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`asideid`)
)";

run_query($asides);

echo 'SUCCESS: The following query executed: <pre>'.$asides.'</pre>';

$has = "CREATE TABLE IF NOT EXISTS `j1lamb_has_aside` (
  `pageid` varchar(32) NOT NULL,
  `asideid` varchar(32) NOT NULL,
  `ord` int(11) DEFAULT NULL,
  PRIMARY KEY (`pageid`,`asideid`)
)";

run_query($has);

echo 'SUCCESS: The following query executed: <pre>'.$has.'</pre>';
	
?>