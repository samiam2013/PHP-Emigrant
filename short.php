<?php
$subs = array("javascript","Python","java","csharp","cpp",
  "typescript","bash","C_Programming","ruby");
foreach($subs as $sub){
  $links[$sub] = "https://www.reddit.com/r/".$sub."/top.json?t=week&limit=1";}
foreach($links as $sub => $link){
  $res = json_decode(file_get_contents($link));
  $title = html_entity_decode($res->data->children[0]->data->title);
  echo 'r/'.$sub.": ".$title."\n";
}
