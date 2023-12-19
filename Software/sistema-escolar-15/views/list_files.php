<?php
$dir = "uploads/";

if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      if ($file != "." && $file != "..") {
        echo "<a href='$dir$file'>$file</a><br>";
      }
    }
    closedir($dh);
  }
}
?>
