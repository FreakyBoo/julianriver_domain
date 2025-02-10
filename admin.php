<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Valider produkt_id
    if (isset($_POST['produkt_id']) && is_numeric($_POST['produkt_id'])) {
        $produkt_id = (int) $_POST['produkt_id']; // Konverterer til heltall
        
        // Sjekk om produkt_id finnes i databasen
        $query = "SELECT id FROM produkter WHERE id = $produkt_id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {
            echo "Ugyldig produkt_id!";
            exit();
        }
    } else {
        echo "Ugyldig produkt_id!";
        exit();
    }

    // Valider kunde_id
    if (isset($_POST['kunde_id']) && is_numeric($_POST['kunde_id'])) {
        $kunde_id = (int) $_POST['kunde_id']; // Konverterer til heltall
        
        // Sjekk om kunde_id finnes i databasen (for eksempel i en tabell som heter 'kunder')
        $query = "SELECT id FROM kunder WHERE id = $kunde_id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {
            echo "Ugyldig kunde_id!";
            exit();
        }
    } else {
        echo "Ugyldig kunde_id!";
        exit();
    }

    // Hent navn og adresse fra skjema
    $navn = mysqli_real_escape_string($conn, $_POST['navn']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);

    // Sett inn bestillingen i databasen
    $query = "INSERT INTO bestillinger (kunde_id, produkt_id, navn, adresse) VALUES ('$kunde_id', '$produkt_id', '$navn', '$adresse')";

    // Utfør spørringen
    if (mysqli_query($conn, $query)) {
        echo "Bestilling registrert!";
    } else {
        echo "Feil ved registrering av bestilling: " . mysqli_error($conn);
    }
}
?>

<?php
// Database tilkobling
$host = "localhost";
$user = "julian";
$password = "Julian2007!";
$database = "nettbutikk";

// Opprett tilkobling til MySQL-databasen
$conn = mysqli_connect($host, $user, $password, $database);

// Sjekk om tilkoblingen mislykkes
if (!$conn) {
    die("Tilkobling mislyktes: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Registrer Bestilling</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Registrer Bestilling</h1>

    <!-- Skjema for bestilling -->
    <form action="admin.php" method="GET">
    <label for="produkt_id">Produkt ID:</label>
    <input type="number" name="produkt_id" id="produkt_id" required><br><br>

    <label for="navn">Navn:</label>
    <input type="text" name="navn" id="navn" required><br><br>

    <label for="adresse">Adresse:</label>
    <input type="text" name="adresse" id="adresse" required><br><br>

    <button type="submit">Registrer Bestilling</button>
</form>


    <br><br>
    <a href="index.php">Tilbake til forsiden</a>

</body>
</html>
