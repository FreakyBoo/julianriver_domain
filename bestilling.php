<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
include 'db_connect.php';

if (isset($_GET['produkt_id']) && is_numeric($_GET['produkt_id'])) {
    $produkt_id = (int) $_GET['produkt_id'];  // Sørger for at produkt_id er et heltall

    // Forbered SQL-spørringen
    $stmt = $conn->prepare("SELECT * FROM produkter WHERE produkt_id = ?");
    $stmt->bind_param("i", $produkt_id);  // 'i' betyr at vi forventer en integer

    // Utfør spørringen
    $stmt->execute();
    $result = $stmt->get_result();

    // Hent produktet
    $produkt = $result->fetch_assoc();

    // Hvis produktet ikke finnes, vis en feilmelding
    if (!$produkt) {
        echo "Produkt ikke funnet.";
        exit;
    }
} else {
    echo "Ugyldig produkt-ID.";
    exit;
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Bestilling</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bestill <?php echo $produkt['navn']; ?></h1>
    <form action="admin.php" method="POST">
        <input type="hidden" name="produkt_id" value="<?php echo $produkt['id']; ?>">
        <label for="navn">Navn:</label>
        <input type="text" name="navn" required>
        <label for="adresse">Adresse:</label>
        <input type="text" name="adresse" required>
        <button type="submit">Send Bestilling</button>
    </form>
</body>
</html>
