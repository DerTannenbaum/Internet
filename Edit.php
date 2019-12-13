<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Say Yes</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
</head>

<body>
	<?php 
	    if (!isset($_GET['password']) || $_GET['password'] != "GEHEIM"){
	die("Passwort incorrect");
}
	include('config.php');
	 $link = mysqli_connect("localhost", "root", "", "phrases");
	  if (isset($_GET['delete-id'])){
    $db_query = "DELETE FROM `phrases` WHERE `ID` = " . $_GET['delete-id'] ;
    $delete_result = $link->query($db_query); 	
	// The following line shows how many rows were delted...
	// Can be used for error handling...
	// echo $link->affected_rows;
  // initialize variable $update_result
  $update_result = 0;
  if (isset($_GET['btn-save'])){
    $db_query = "UPDATE `phrases` SET `text` = '" . $_GET['phrase'] . "' WHERE `ID` = " . $_GET['edit-id'] ;
 	// echo $db_query;
     $update_result = $link->query($db_query); 	
	  
  }

  }
  $db_query = "SELECT * FROM `phrases` WHERE `ID` = " . $_GET['edit-id'] ;
  $result = $link->query($db_query);
  $row = mysqli_fetch_row($result);
  $text = $row[1];

  // query database
  $result = $link->query('SELECT * FROM phrases');

	
	   if(isset($_GET['btn-save'])){
	     $name = $_GET['name'];
		 $email = $_GET['email'];
		   $date = date('l jS \of F Y h:i:s');
	      $text = $_GET['name']. " " ."says YES! to:". " " .$_GET['phrase_01'] . " " . $_GET['phrase_02'];
	  	$text = urldecode($text);
		// Connection herstellen
		$conn = new mysqli("localhost", "root", "", "phrases");
		// SQL-Statement zusammenbauen
		$sql = "INSERT INTO phrases (`phrase`, `recipient`, `mail`, `date`) VALUES ('$text','$name','$email','$date')";
		// SQL Query ausführen (Statement an query() übergeben
		// und überprüfen, ob es erfolgreich ausgeführt wurde
		if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
		}
		else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	 // file($statement[0] => "Line 1", $statement[1] => "Line 2" );
		   
  }
	   
     $stmt = "SELECT * FROM `phrases`";
  $result = $link->query($stmt);

 /* if ($result->num_rows > 0){
    while ($row = mysqli_fetch_row($result)){
	echo "<tr>";
	echo "<td>" . $row[0] . "</td>";
	echo "<td>" . $row[1] . "</td>";
	echo "<td>" . $row[2] . "</td>";
	echo "<td><a href='?delete-id=" . $row[0] . "'>delete</a></td>";
	echo "</tr>";
}
               
  }
  
  else {
    // nothing found :-(
  }
  */

      if (isset($_GET['email'])){
      $to      = urldecode($_GET['email']);
      $subject = 'I say YES! to...';
      $message = $text;
      $headers = 'From: internet2@hdmy.de' . "\r\n" .
          'Reply-To: internet2@hdmy.de' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();

      $mailSuccess = mail($to, $subject, $message, $headers);      

      
      // if you want to do some rudimentary error handling...   
      if (!$mailSuccess){
        echo "mail not sent";
      }
      else {
        echo "mail sent to: " . $to;
      }
      
    }
 // switch that to true if you want to do the mailing stuff...
$mailfun = true;
   if ($mailfun == true){
      // email related stuff...
      if (isset($_GET['email'])){
          // ....
      }
    }

?>
    

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Say Yes</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a> 
			</li>
			  <li class="nav-item">
            <a class="nav-link" href="Admin.php?password=password">Admin</a>
          </li>
           
       
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
	 <h1>Admin</h1>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
       
       
		<form method="get">
		<input type="text" name="name">
	 <?php
        if ($mailfun == true){
        ?>
        <div class="form-group">  
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
        </div>    
        <?php    
        }
        ?>
	
	<h1>says YES! to:</h1>
       <form>
           <input type="hidden" name="edit-id" value="<?php echo $_GET['edit-id']?>" >
		   <input type="text" name="phrase" value=$text""></input>
            	<button type="submit" name="btn-save" value="1">Update</button>            	
            </form>
		  
   <button type="submit" class="btn btn-default" name="btn-save" value="1">Say YES!</button>
		
   <table class="table-striped table">
        <th>ID</th>
        <th>Phrase</th>
        <?php
        $link = mysqli_connect("localhost", "root", "", "phrases");
        $stmt = "SELECT * FROM `phrases`";
        $result = $link->query($stmt);

        if ($result->num_rows > 0){
            while ($row = mysqli_fetch_row($result)){
            echo "<tr>\n";
            echo "<td>" . $row[0] . "</td>\n";
            echo "<td>" . $row[1] . "</td>\n";
			echo "<td>" . $row[2] . "</td>";
			echo "<td><a href='?delete-id=" . $row[3] . "'>delete</a></td>";
			echo "<td><a href='Edit.php?edit-id=" . $row[4] . "'>edit</a></td>";
			echo "</tr>";
            }
        }
        else {
            echo "<tr><td colspan='2'>No data found</td></tr>";
		
			
        ?>
    </table>

		  </form>
         
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
 <?php if ($update_result == 1){ ?>
          <div class="alert alert-primary" role="alert">
            Update Success!
            <a href="index.php">Back to dashboard</a>
          </div>
        <?php } ?>


</html>
