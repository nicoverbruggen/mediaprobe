<?php

require "../vendor/autoload.php";

use NicoVerbruggen\MediaProbe\MediaProbe;

$path = "./example.mp3"; // any format that ffprobe can read is supported
$info = (new MediaProbe($path))->getMediaInfo();
var_dump($info);

// If the MP3 has album art, we can extract it like this:
(new MediaProbe($path))->extractCover("./cover.jpg");

/*
// For example, let's read some tags
var_dump($info->format->tags->artist);
var_dump($info->format->tags->title);
var_dump($info->format->tags->comment);
*/