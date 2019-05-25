<?php
//download
$filename = 'comp_screen.jpg'; // don't accept other directories 
   $size = @getimagesize($filename); 
   $fp = @fopen($filename, "rb"); 
   if ($size && $fp) 
   { 
      header("Content-type: {$size['mime']}"); 
      header("Content-Length: " . filesize($filename)); 
      header("Content-Disposition: attachment; filename=$filename"); 
      header('Content-Transfer-Encoding: binary'); 
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0'); 
      fpassthru($fp); 
      exit; 
   } 
?>
