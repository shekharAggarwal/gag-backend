
<?php 
// PHP program to delete a file named gfg.txt  
// using unlike() function  
   
if( isset($_POST['path']))
{
    $path = $_POST['path']; 
   
// Use unlink() function to delete a file  
if (!unlink($path)) {  
    echo ("$path cannot be deleted due to an error");  
}  
else {  
    echo ("$path has been deleted");  
}  
} 
?>  
