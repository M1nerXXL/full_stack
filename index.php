<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Schema - Full Stack</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="resources/css/style.css" />
</head>

<body>
  <!-- Header -->
  <div class="header-container">
    <h1 class="header-container__item header-container__page-title">
      Schema
    </h1>
    <a class="header-container__item" href="add.php">
      <button class="header-container__page-switcher">
        Toevoegen aan database
      </button>
    </a>
  </div>

  <!-- Schedule -->
  <div class="index__schedule">
    <!-- PHP code generating schedule -->
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

    /* Fetching info from database */
    $query = "SELECT event.*, band.* FROM event
              LEFT JOIN event_has_band ON event.idevent = event_has_band.event_idevent
              LEFT JOIN band ON band.idband = event_has_band.band_idband
              ORDER BY event.date, event.time, band.band_name";
    $result = $conn->query($query);

    /* Creating array and storing data inside */
    $events = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $idevent = $row["idevent"];

      if (!isset($events[$idevent])) {
        $events[$idevent] = [
          "event_name" => $row["event_name"],
          "date" => date_format(date_create($row["date"]), "j F Y"),
          "time" => date_format(date_create($row["time"]), "H:i"),
          "entrance_fee" => number_format($row["entrance_fee"], 2, ",", "."),
          "bands" => []
        ];
      }

      if (!empty($row['band_name']) && !empty($row['genre'])) {
        $events[$idevent]["bands"][] = [
          "band_name" => $row["band_name"],
          "genre" => $row["genre"]
        ];
      }
    }

    if (!empty($events)) {
      foreach ($events as $event) {
        echo "<div class='index__schedule__entry'>";
        echo "<p class='index__schedule__entry__text index__schedule__entry__text-datetime'>" . $event["date"] . " | " . $event["time"] . "</p>";
        echo "<p class='index__schedule__entry__text index__schedule__entry__text-eventname'>" . $event["event_name"] . "</p>";
        echo "<p class='index__schedule__entry__text index__schedule__entry__text-entrancefee'>&euro;" . $event["entrance_fee"] . "</p>";
        if (!empty($event['bands'])) {
          echo "<p class='index__schedule__entry__text index__schedule__entry__text-bands'>Bands die komen optreden:</p>";
          foreach ($event["bands"] as $band) {
            echo "<p class='index__schedule__entry__text index__schedule__entry__text-bandentry'>" . $band["band_name"] . " - " . $band["genre"] . "</p>";
          }
        } else {
          echo "<p class='index__schedule__entry__text index__schedule__entry__text-nobands'>Er komen geen bands optreden.</p>";
        }
        echo "</div>";
      }
    } else {
      echo "<p class='index__schedule__no-plans'>There are no events planned.</p>";
    }
    ?>
  </div>
  <!-- JS -->
  <script src="resources/js/script.js"></script>
</body>

</html>