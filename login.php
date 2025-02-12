<?php
session_start(); // Start en sesjon for å huske brukeren

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Koble til databasen
    $host = "localhost";
    $user = "julian";
    $pass = "Julian2007!"; 
    $db = "nettbutikk";
    
    $conn = new mysqli($host, $user, $pass, $db);

    // Sjekk tilkobling
    if ($conn->connect_error) {
        die("Tilkoblingsfeil: " . $conn->connect_error);
    }

    // Hent data fra skjemaet
    $epost = $_POST['epost'];
    $telefon = $_POST['telefon'];

    // Sjekk om brukeren finnes i databasen
    $sql = "SELECT * FROM kunder WHERE epost = '$epost' AND telefon = '$telefon'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Bruker finnes, lagre brukerens info i sesjonen
        $row = $result->fetch_assoc();
        $_SESSION['kunde_id'] = $row['kunde_id'];
        $_SESSION['fornavn'] = $row['fornavn'];
        header("Location: welcome.php"); // Omviderer til velkomstside
        exit();
    } else {
        echo "Feil epost eller telefon.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="nettside.css">
    <title>Logg inn</title>
</head>
<body>
    <h1>Logg inn</h1>
    <form action="login.php" method="POST">
        <input type="email" name="epost" placeholder="Epost" required>
        <input type="text" name="telefon" placeholder="Telefon" required>
        <button type="submit">Logg inn</button>
    </form>
</body>
</html>
