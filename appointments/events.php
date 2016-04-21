<?php
require($_SERVER['DOCUMENT_ROOT']."/config.php"); 	
	
// List of events
 $json = array();

 // Query that retrieves events
$sql = "SELECT * FROM events ORDER BY id";

$out = array();
foreach($db->query($sql) as $row) {
	echo $row->id;
	
    $out[] = array(
        'id' => $row['id'],
        'title' => $row['title'],
        'url' => $row['url'],
        'start' => strtotime($row['start']) . '000',
        'end' => strtotime($row['end']) .'000'
    );
}

echo json_encode(array('success' => 1, 'result' => $out));

?>