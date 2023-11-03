<!DOCTYPE html>
<html>

<head>
  <title>Band toevoegen - Full Stack</title>
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
  $band_name = $_POST["band-name"];
  $genre = $_POST["genre"];

  /* Adding to database */
  try {
    $query = "INSERT INTO band (band_name, genre) VALUES (:band_name, :genre)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":band_name", $band_name);
    $stmt->bindParam(":genre", $genre);
    $stmt->execute();
    echo "Band is succesvol toegevoegd!";
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