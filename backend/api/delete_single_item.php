<?php

require 'database.php';

// Extract, validate and sanitize the id.
$id = ($_GET['id'] !== null && (int)$_GET['id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['id']) : false;

$table = ($_GET['table'] !== null)? mysqli_real_escape_string($con, $_GET['table']): "";

if(!$id)
{
  return http_response_code(400);
}

// Delete
$sql = "DELETE FROM '{$table}' WHERE '{$table}'+`_id` ='{$id}' LIMIT 1";

if(mysqli_query($con, $sql))
{
  http_response_code(204);
}
else
{
  return http_response_code(422);
}
?>
