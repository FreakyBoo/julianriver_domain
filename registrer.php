<?php
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
    $fornavn = $_POST['fornavn'];
    $etternavn = $_POST['etternavn'];
    $epost = $_POST['epost'];
    $telefon = $_POST['telefon'];
    $adresse = $_POST['adresse'];
    
    // Sett inn bruker i databasen
    $sql = "INSERT INTO kunder (fornavn, etternavn, epost, telefon, adresse) VALUES ('$fornavn', '$etternavn', '$epost', '$telefon', '$adresse')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Bruker registrert! <a href='login.php'>Logg inn her</a>";
    } else {
        echo "Feil: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Registrering</title>
</head>
<body>
    <h1>Registrer deg</h1>
    <form action="registrer.php" method="POST">
        <input type="text" name="fornavn" placeholder="Fornavn" required>
        <input type="text" name="etternavn" placeholder="Etternavn" required>
        <input type="email" name="epost" placeholder="Epost" required>
        <input type="text" name="telefon" placeholder="Telefon" required>
        <textarea name="adresse" placeholder="Adresse" required></textarea>
        <button type="submit">Registrer</button>
    </form>
</body>
</html>
