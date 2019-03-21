<?

require_once('site_core.php');
require_once('site_db.php');
require_once('site_forms.php');

function return_side_content($pageid) {
    $sql = "SELECT asideid FROM j1lamb_has_aside WHERE pageid = '".$pageid."'";
    $result = run_query($sql);
    $output = '';
    while($row = $result->fetch_assoc()) {
        $aid = $row['asideid'];
        $sql = "SELECT title, content, color FROM j1lamb_asides WHERE asideid = '".$aid."'";
        $content = run_query($sql)->fetch_assoc();
        $output .= '
        <aside>
           <h3>'.$content['title'].'</h3>
           '.$content['content'].'           
        </aside>';
    }        
    return $output;        
}

function echo_side_content($pageid) {
    echo return_side_content(pageid);
}
?>