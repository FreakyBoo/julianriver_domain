<?php
// Koble til databasen
include 'db_connect.php';

// Spørring for å hente alle produkter fra databasen
$query = "SELECT * FROM produkter";
$result = mysqli_query($conn, $query);

// Sjekk om spørringen har returnert resultater
if (!$result) {
    die("Feil ved henting av produkter: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nettbutikk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Velkommen til Nettbutikken</h1>
    <div class="produkter">
        <?php 
        // Looper gjennom alle produkter og lager lenker for hvert produkt
        while ($row = mysqli_fetch_assoc($result)) { 
            $produkt_id = $row['produkt_id']; // Hent produkt_id fra databasen
            $produkt_navn = $row['navn']; // Hent produktnavn fra databasen
            $produkt_pris = $row['pris']; // Hent produktpris fra databasen
        ?>
            <div class="produkt">
                <h2><?php echo $produkt_navn; ?></h2>
                <p>Pris: <?php echo number_format($produkt_pris, 2, ',', ' '); ?> NOK</p>
                <!-- Dynamisk generering av lenke basert på produkt_id -->
                <a href="bestilling.php?produkt_id=<?php echo $produkt_id; ?>">Bestill <?php echo $produkt_navn; ?></a>
            </div>
        <?php } ?>
    </div>
</body>
</html>
