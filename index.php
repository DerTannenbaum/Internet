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
	include('config.php');
	 $link = mysqli_connect("localhost", "root", "", "phrases");
	
	
	   if(isset($_GET['btn-save'])){
	     $name = $_GET['name'];
		 //$email = $_GET['email'];
		   $date = date('l jS \of F Y h:i:s');
	      $text = $_GET['name']. " " ."says YES! to:". " " .$_GET['phrase_01'] . " " . $_GET['phrase_02'];
	  	$text = urldecode($text);
		// Connection herstellen
		$conn = new mysqli("localhost", "root", "", "phrases");
		// SQL-Statement zusammenbauen
		$sql = "INSERT INTO phrases ('phrase', 'recipient', 'date')
		VALUES ('$text','$name',$date)";
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

  if ($result->num_rows > 0){
    while ($row = mysqli_fetch_row($result)){
        echo $row[0];
        echo $row[1];
    }                
  }
  else {
    // nothing found :-(
  }

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
$mailfun = false;
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
       
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
       
       
		<form method="get">
		<input type="text" name="name">
	 <?php
        if ($mailfun == true){
        ?>
        <div class="form-group">
            <label for="email">Send this message to:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
        </div>    
        <?php    
        }
        ?>
	
	<h1>says YES! to:</h1>
    <select class="custom-select" name="phrase_01">
        <option selected>Open this select menu</option>
        <option value="learning">learning</option>
        <option value="exploring">exploring</option>
        <option value="finding">finding</option>
	 	<option value="enjoying">enjoying</option>
    </select>
		<select class="custom-select" name="phrase_02">
        <option selected>Open this select menu</option>
        <option value="math">math</option>
        <option value="the world">the world</option>
        <option value="nemo">nemo</option>
	 	<option value="nature">nature</option>
    </select>
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
            echo "</tr>";
            }
        }
        else {
            echo "<tr><td colspan='2'>No data found</td></tr>";
        }
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

</html>
