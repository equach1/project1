<?
include "utility_functions.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);

// Suppress PHP auto warning.
ini_set( "display_errors", 0);  

// Get input from dept_update.php and update the record.
$dnumber = $_POST["dnumber"];
$dname = $_POST["dname"];
$location = $_POST["location"];

// the sql string
$sql = "update dept set dname = '$dname', location = '$location' where dnumber = $dnumber";
//echo($sql);

$result_array = execute_sql_in_oracle ($sql);
$result = $result_array["flag"];
$cursor = $result_array["cursor"];

if ($result == false){
  // Error handling interface.
  echo "<B>Update Failed.</B> <BR />";

  display_oracle_error_message($cursor);

  die("<i> 

  <form method=\"post\" action=\"dept_update?sessionid=$sessionid\">

  <input type=\"hidden\" value = \"$dnumber\" name=\"dnumber\">
  <input type=\"hidden\" value = \"$dname\" name=\"dname\">
  <input type=\"hidden\" value = \"$location\" name=\"location\">
  <input type=\"hidden\" value = \"1\" name=\"update_fail\">
  
  Read the error message, and then try again:
  <input type=\"submit\" value=\"Go Back\">
  </form>

  </i>
  ");
}

// Record updated.  Go back.
Header("Location:department.php?sessionid=$sessionid");
?>