<?php
$s = array("javascript","Python","java","csharp","cpp",
  "typescript","bash","C_Programming","ruby");
foreach($s as $b){ $l[$b] = "http://reddit.com/r/".$b."/top.json?t=week";}
foreach($l as $b => $k){
  $r = json_decode(file_get_contents($k))->data->children[0]->data;
  echo 'r/'.$b.": ".html_entity_decode($r->title)."\n".$r->url."\n";}
