<?php
require '../../common.php';
require '../../../MyLife/models/Entry.php';
$t_entry = new Entry;

$date = i($QUERY, 'date', date('Y-m-d'));

$entry = $t_entry->getByDate($date);
$tags = array();
if($entry) $tags = $t_entry->getTagNames($entry['id']);

print json_encode($tags);