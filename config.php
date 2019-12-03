<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- TemplateBeginEditable name="doctitle" -->
<title>Unbenanntes Dokument</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>
	<?php
  // name of the file that we store data to
  // we want to use this information in different files 
  $filename = "file.txt";
	 // DB configuration
  $db_host = "localhost";
  $db_user = "root";
  $db_password = "";
  $db_name = "phrases";
  $link = mysqli_connect($db_host, $db_user, $db_password, $db_name); 

?>

</body>
</html>
