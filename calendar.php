<?php 

session_start();

if(!isset( $_SESSION['user'] ))
{
	header("location:admin-login.php");
}
print_r ($_FILES);
if ($_FILES["new-tentative-calendar"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["new-tentative-calendar"]["error"] . "<br>";
    }
else
    {
    echo $_FILES["new-tentative-calendar"]["name"] . "<br>";
    echo "Type: " . $_FILES["new-tentative-calendar"]["type"] . "<br>";
    echo "Size: " . ($_FILES["new-tentative-calendar"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["new-tentative-calendar"]["tmp_name"] . "<br>";

    if (file_exists("calendar/" . $_FILES["new-tentative-calendar"]["name"]))
      {
      echo $_FILES["new-tentative-calendar"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["new-tentative-calendar"]["tmp_name"],
      "calendar/" . $_FILES["new-tentative-calendar"]["name"]);
      echo "Stored in: " . "calendar/" . $_FILES["new-tentative-calendar"]["name"];
      }
    }
  
?>