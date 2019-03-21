<?

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');

// Set the title of the page
$title = "Update Page";

echo_head($title);

echo '
	<div class="container">
		<h2>'.$title.'</h2>';
		

$id = $_GET['id'];
$action = $_GET['action'];

if ($id == '') {
	$result = run_query("SELECT pageid, title FROM j1lamb_pages");
    
    $pages = array();
    while($row = $result->fetch_assoc()) {
        $pages[ $row['pageid'] ] = $row['title'];
    }
    echo '
        <form method="get" action="update_page.php">'.return_option_select('id', $pages, 'Select a page').'<input type="submit"></form>';
}

// If action is update
else if ($action=='update') {

	// Get the posted form data
	$title = $_POST['title'];
	$content = addslashes($_POST['content']);
	$parent = $_POST['parent'];
	
	// Form the query
	$sql = "UPDATE j1lamb_pages SET title = '$title', content = '$content', parent = '$parent' WHERE pageid='$id'";

	// Run the query
	run_query($sql);
	
	// Echo feedback
	echo '
		<p><a href="index.php?pageid='.$id.'">'.$id.'</a> was updated from pages</p>';
}

// If the id is given but action is not update
else {
	
	// Get all the pages to generate the parent drop down
	$result = run_query("SELECT pageid, title FROM j1lamb_pages");
	$pages = array();
	while ($row = $result->fetch_assoc()) {
		$pages[ $row['pageid'] ] = $row['title'];
	}	
	
	// Get the data for the selected page
	$result = run_query("SELECT * FROM j1lamb_pages WHERE pageid='$id'");
	$values = $result->fetch_assoc();
	
	
	// Ouput the edit form
	echo '
		<form action="update_page.php?action=update&id='.$id.'" method="post">
			<label>Page ID: </label> <b>'.$id.'</b><br>'.
			return_input_text('title','Page Title',$values['title'],true).
			return_textarea('content','Page Content',$values['content']). 	
			return_option_select('parent',$pages,'Parent Page',$values['parent']).'
			<input type="submit" class="btn btn-primary" value="Update">
		</form>';	
}

echo '</div>';

echo_foot();

?>