<?php
// make a list of the subreddits to pull news from
$subreddits = array(
  "javascript",
  "Python",
  "java",
  "csharp",
  "cpp",
  "typescript",
  "bash",
  "C_Programming",
  "ruby");

// build the reddit links for those $subreddits
$sub_links = array();
$query = http_build_query(
                    array(
                      't'     => 'week',
                      'limit' => 1
                    )
                  );
foreach($subreddits as $sub){
  $sub_links[] = "https://www.reddit.com/r/".$sub."/top.json?".$query;
}

// set up the curl session
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Github.com/samiam2013/PHP-Emigrant");
foreach($sub_links as $link){
  // pull the top post from each subreddit
  curl_setopt($ch, CURLOPT_URL, $link);
  echo "\n";
  // make sure there are no errors
  if(($result = curl_exec($ch)) === false){
    echo "Curl error!: ".curl_error($ch)."\n";
    die();
  }
  $rjson = json_decode($result);
  // parse the JSON data
  $top = $rjson->data->children[0]->data;
  //print_r($top);
  $title_text = html_entity_decode($top->title);
  $title_wrapped = wordwrap($title_text,80);
  // print the top post title and url for user
  echo 'from r/'.$top->subreddit.":\n".$title_wrapped."\n";
  echo "\turl: ".$top->url."\n";
}
curl_close($ch);

?>
