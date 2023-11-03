<!DOCTYPE html>
<html>

<head>
  <title>Band bij event koppelen - Full Stack</title>
</head>

<body>
  <H1>Band Toevoegen</H1>
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
  $event = $_POST["event"];
  $band = $_POST["band"];

  /* Adding to database */
  try {
    $query = "INSERT INTO event_has_band (event_idevent, band_idband) VALUES (:event_idevent, :band_idband)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":event_idevent", $event, PDO::PARAM_INT);
    $stmt->bindParam(":band_idband", $band, PDO::PARAM_INT);
    $stmt->execute();
    echo "Band en event zijn succesvol gekoppeld!";
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