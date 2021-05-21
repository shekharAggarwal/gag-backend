<?php

//Name of our directory
$dir_name ='cab_image/'+$driver;

//Check if the directory with the name already exists
if (!is_dir($dir_name)) {
//Create our directory if it does not exist
mkdir($dir_name);
echo "Directory created";
}

?>