<meta charset="utf-8">
<?php

require_once'database.php';

// Name of the file
$filename = 'forum.sql';

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
  // Skip it if it's a comment
  if (substr($line, 0, 2) == '--' || $line == '')
  continue;

  // Add this line to the current segment
  $templine .= $line;
  // If it has a semicolon at the end, it's the end of the query
  if (substr(trim($line), -1, 1) == ';')
  {
    // Perform the query
    mysqli_query($db,$templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
  }
}
header("Location:install_end.php");
?>
