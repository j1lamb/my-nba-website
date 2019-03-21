<?
require_once('site_db.php');
require_once('site_core.php');
require_once('site_nav.php');
	
/* -----------------------------------------------------------------------------
Get the pageid from the URL and generate a page
----------------------------------------------------------------------------- */

// If the page is null, use the default pageid
if ($_GET['pageid'] == null) 
	$idpage = 'home';
else 
	$idpage = $_GET['pageid'];	 

// Echo the major parts of the page from head to foot
echo_head('National Basketball Association');
echo_nav('NBA', $idpage);
echo_content($idpage);
//echo_side_content($idpage);
echo_foot();
?>