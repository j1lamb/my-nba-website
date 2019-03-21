<?

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');

// Set the title of the page
$title = "Update Aside";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$id = $_GET['id'];
$action = $_GET['action'];

if ($id == '') {
	$result = run_query("SELECT asideid, title FROM j1lamb_asides");
    
    $asides = array();
    while($row = $result->fetch_assoc()) {
        $asides[ $row['asideid'] ] = $row['title'];
    }
    echo '
        <form method="get" action="update_aside.php">'.return_option_select('id', $asides, 'Select an aside').'<input type="submit"></form>';
}
else if ($action=='update') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $color = $_POST['color'];
	$sql = "UPDATE j1lamb_asides SET title = '$title', content = '$content', color = '$color' WHERE asideid='$id'";
	run_query($sql);

	// $sql = "EDIT FROM asides WHERE asideid='$id'";
	// $sql = "EDIT FROM has_aside WHERE asideid='$aid' AND pageid='$pid'";
	
	echo '
		<p><a href="index.php?asideid='.$id.'">'.$id.'</a> was updated from asides</p>';
}
else {
	
	// Get all the asides to generate the parent drop down
	$result = run_query("SELECT asideid, title FROM j1lamb_asides");
	$asides = array();
	while ($row = $result->fetch_assoc()) {
		$asides[ $row['asideid'] ] = $row['title'];
	}	
	
	// Get the data for the selected page
	$result = run_query("SELECT * FROM j1lamb_asides WHERE asideid='$id'");
	$values = $result->fetch_assoc();
	
	
	// Ouput the edit form
	echo '
		<form action="update_aside.php?action=update&id='.$id.'" method="post">
			<label>Aside ID: </label> <b>'.$id.'</b><br>'.
			return_input_text('title','Page Title',$values['title'],true).
			return_textarea('content','Page Content',$values['content']). 	
			return_input_text('color','Color',$values['color']).'
			<input type="submit" class="btn btn-primary" value="Update">
		</form>';	
}

echo '</div>';

echo_foot();

?>