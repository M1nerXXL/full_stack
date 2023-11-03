<!DOCTYPE html>
<html>

<head>
  <title>Event toevoegen - Full Stack</title>
</head>

<body>
  <H1>Event Toevoegen</H1>
  <?php

  /* Defining variables */
  $servername = "localhost";
  $username = "id21482185_root";
  $password = "RootRoot1!";
  $dbname = "id21482185_schedule";

  /* Establishing connection to database */
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

  /* Fetching form */
  $date = $_POST["date"];
  $time = $_POST["time"];
  $event_name = $_POST["event-name"];
  $entrance_fee = $_POST["entrance-fee"];

  /* Adding to database */
  try {
    $query = "INSERT INTO event (date, time, event_name, entrance_fee) VALUES (:date, :time, :event_name, :entrance_fee)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":date", $date);
    $stmt->bindParam(":time", $time);
    $stmt->bindParam(":event_name", $event_name);
    $stmt->bindParam(":entrance_fee", $entrance_fee);
    $stmt->execute();
    echo "Event is succesvol toegevoegd!";
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

  /* Breaking connection to database */
  $conn = null;

  ?>
  <br>
  <a href="add.php">Klik om terug te gaan</a>
</body>

</html>