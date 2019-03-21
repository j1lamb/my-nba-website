<?

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');

// Set the title of the page
$title = "Delete  Has Aside";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$aid = $_GET['aid'];
$pid = $_GET['pid'];
$action = $_GET['action'];

if ($aid == '') {
		$result = run_query("SELECT asideid, pageid FROM j1lamb_has_aside");
    
    $asides = array();
    $pages= array();
    while($row = $result->fetch_assoc()) {
        $asides[ $row['asideid'] ] = $row['asideid'];
        $pages[ $row['pageid'] ] = $row['pageid'];
    }
    echo '
        <form method="get" action="delete_has_aside.php">'
        	.return_option_select('aid', $asides, 'Select an aside')
        	.return_option_select('pid', $pages, 'Select a page').'
        	<input type="submit">
        </form>';
}
else if ($action=='delete') {
	$sql = "DELETE FROM j1lamb_has_aside WHERE asideid='$aid' AND pageid='$pid'";
	run_query($sql);

	// $sql = "DELETE FROM asides WHERE asideid='$id'";
	// $sql = "DELETE FROM has_aside WHERE asideid='$aid' AND pageid='$pid'";
	
	echo '<p><b>'.$pid.'</b> was deleted from <b>'.$table.'</b></p>';
}
else {		
	echo '
		<p>Are you sure you want to delete <b>'.$id.'</b> from <b>'.$table.'</b>?</p>
		<p>
			<a href="delete_has_aside.php?action=delete&pid='.$pid.'&aid='.$aid.'" class="btn btn-danger">Yes</a>
		</p>';
}

echo '</div>';

echo_foot();

?>