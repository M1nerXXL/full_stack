<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Toevoegen aan database - Full Stack</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="resources/css/style.css" />
</head>

<body>
  <!-- Header -->
  <div class="header-container">
    <h1 class="header-container__item header-container__page-title">
      Toevoegen aan database
    </h1>
    <a class="header-container__item" href="index.php">
      <button class="header-container__page-switcher">Schema</button>
    </a>
  </div>

  <!-- Forms -->
  <div class="add__grid-container">
    <!-- Event -->
    <div class="add__grid-container__item add__grid-container__event">
      <form id="event-form" class="add__grid-container__form" action="event.php" method="post">
        <h2 class="event-form__title">Event</h2>
        <label class="add__grid-container__form__label" for="input-date">
          Datum
        </label>
        <input id="input-date" class="add__grid-container__form__input" name="date" type="date" autocomplete="off" required />
        <label class="add__grid-container__form__label" for="input-time">
          Tijd
        </label>
        <input id="input-time" class="add__grid-container__form__input" name="time" type="time" autocomplete="off" required />
        <label class="add__grid-container__form__label" for="input-event-name">Naam van event</label>
        <input id="input-event-name" class="add__grid-container__form__input" name="event-name" type="text" maxlength="45" autocomplete="off" required />
        <label class="add__grid-container__form__label" for="input-entrance-fee">
          Prijs
        </label>
        <div class="flex">
          <p>&euro;</p>
          <input id="input-entrance-fee" class="add__grid-container__form__input" name="entrance-fee" type="number" min="0" step="0.01" autocomplete="off" required />
        </div>
      </form>
      <button class="add__grid-container__form__submit" form="event-form" type="submit">
        Submit
      </button>
    </div>

    <!-- Band -->
    <div class="add__grid-container__item add__grid-container__event">
      <form id="band-form" class="add__grid-container__form" action="band.php" method="post">
        <h2 class="event-form__title">Band</h2>
        <label class="add__grid-container__form__label" for="input-band-name">
          Naam van band
        </label>
        <input id="input-band-name" class="add__grid-container__form__input" name="band-name" type="text" maxlength="45" autocomplete="off" required />
        <label class="add__grid-container__form__label" for="input-genre">
          Genre
        </label>
        <input id="input-genre" class="add__grid-container__form__input" name="genre" type="text" maxlength="45" autocomplete="off" required />
      </form>
      <button class="add__grid-container__form__submit" form="band-form" type="submit">
        Submit
      </button>
    </div>

    <!-- Band at event -->
    <div class="add__grid-container__item add__grid-container__event">
      <form id="band-at-event-form" class="add__grid-container__form" action="band-at-event.php" method="post">
        <h2 class="event-form__title">Band bij event</h2>
        <!-- Event select -->
        <label class="add__grid-container__form__label" for="select-event">
          Event
        </label>
        <select id="select-event" class="add__grid-container__form__input" name="event" required>
          <option disabled selected hidden>Kies event</option>
          <!-- PHP code generating options for event-->
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
          $query = "SELECT idevent, date, time, event_name FROM event ORDER BY date, time";
          $stmt = $conn->query($query);

          /* Generating options for event selector */
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $row["idevent"] . "'>" . $row["event_name"] . " | " . date_format(date_create($row["date"]), "j F Y") . " - " . date_format(date_create($row["time"]), "H:i") . "</option>";
          }
          ?>
        </select>
        <!-- Band select -->
        <label class="add__grid-container__form__label" for="select-band">
          Band
        </label>
        <select id="select-band" class="add__grid-container__form__input" name="band" required>
          <option disabled selected hidden>Kies band</option>
          <!-- PHP code generating options for band-->
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
          $query = "SELECT idband, band_name, genre FROM band ORDER BY band_name";
          $stmt = $conn->query($query);

          /* Generating options for band selector */
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $row["idband"] . "'>" . $row["band_name"] . " | " . $row["genre"] . "</option>";
          }
          ?>
        </select>
      </form>
      <button class="add__grid-container__form__submit" form="band-at-event-form" type="submit">
        Submit
      </button>
    </div>
  </div>
  <!-- JS -->
  <script src="resources/js/script.js"></script>
</body>

</html>