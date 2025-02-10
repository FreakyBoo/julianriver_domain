<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<?php
include 'db_connect.php';
$query = "SELECT * FROM produkter";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Nettbutikk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Velkommen til Nettbutikken</h1>
    <h2>(Trykk på Produktene under for å komme til bestilling siden)</h2>
    <div class="produkter">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="produkt">
                <h2><?php echo $row['navn']; ?></h2>
                <p>Pris: <?php echo $row['pris']; ?> NOK</p>
                <a href="bestilling.php?produkt_id=<?php echo $row['id']; ?>">Bestill</a>
            </div>
        <?php } ?>
    </div>
    <h1>Produkter</h1>
    
    <!-- Lenke til bestilling av iPhone 15 -->
    <a href="bestilling.php?produkt_id=4">iPhone 15</a><br>
    
    <!-- Lenke til bestilling av MacBook Air -->
    <a href="bestilling.php?produkt_id=5">MacBook Air</a><br>
    
    <!-- Lenke til bestilling av Apple Watch -->
    <a href="bestilling.php?produkt_id=6">Apple Watch</a><br>
</body>
</html>