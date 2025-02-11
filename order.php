<?php
session_start(); // Start sesjonen for å få tilgang til brukerinformasjon

// Sjekk om brukeren er logget inn
if (!isset($_SESSION['kunde_id'])) {
    header("Location: login.php"); // Hvis ikke logget inn, omdiriger til login-siden
    exit();
}

// Enkel håndtering av handlekurv
if (isset($_POST['add_product'])) {
    $produkt_id = $_POST['add_product']; // Hent produkt-ID fra knappen
    if (!isset($_SESSION['handlekurv'])) {
        $_SESSION['handlekurv'] = array(); // Initialiser handlekurven hvis den ikke finnes
    }
    $_SESSION['handlekurv'][] = $produkt_id; // Legg til produkt-ID i handlekurven
}

// Fullfør bestilling
if (isset($_POST['complete_order'])) {
    // Hent produktene fra handlekurven og beregn totalpris
    $produkter = [];
    $totalpris = 0;

    if (isset($_SESSION['handlekurv'])) {
        $conn = new mysqli("localhost", "julian", "Julian2007!", "nettbutikk");
        foreach ($_SESSION['handlekurv'] as $produkt_id) {
            // Hent produktinformasjon fra databasen
            $sql = "SELECT * FROM produkter WHERE produkt_id = '$produkt_id'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $produkt = $result->fetch_assoc();
                $produkter[] = $produkt['navn']; // Legg til produktnavn
                $totalpris += $produkt['pris'];  // Legg til pris i totalpris
            }
        }
        $conn->close();
    }

    // Sett opp bestillingen i databasen
    if (count($produkter) > 0) {
        $produkter_liste = implode(", ", $produkter); // Lager en kommaseparert liste av produkter

        // Koble til databasen og legg inn bestillingen
        $conn = new mysqli("localhost", "julian", "Julian2007!", "nettbutikk");
        if ($conn->connect_error) {
            die("Tilkoblingsfeil: " . $conn->connect_error);
        }

        $kunde_id = $_SESSION['kunde_id'];
        $sql = "INSERT INTO bestillinger (kunde_id, status) VALUES ('$kunde_id', 'Behandler')";
        if ($conn->query($sql) === TRUE) {
            $bestilling_id = $conn->insert_id; // Få ID for den nye bestillingen

            foreach ($_SESSION['handlekurv'] as $produkt_id) {
                // Legg til bestillingsdetaljer i databasen
                $sql = "INSERT INTO bestillingsdetaljer (bestilling_id, produkt_id, antall, pris) 
                        VALUES ('$bestilling_id', '$produkt_id', 1, (SELECT pris FROM produkter WHERE produkt_id = '$produkt_id'))";
                $conn->query($sql);
            }

            echo "Bestillingen er fullført! <a href='welcome.php'>Tilbake til velkomstside</a>";

            // Tøm handlekurven etter at bestillingen er fullført
            unset($_SESSION['handlekurv']);
        } else {
            echo "Feil med bestillingen: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Handlekurven er tom. Kan ikke fullføre bestilling.";
    }
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Bestill produkter</title>
</head>
<body>
    <h1>Handlekurv</h1>
    <form action="order.php" method="POST">
        <h2>Velg produkter:</h2>
        <?php
        $conn = new mysqli("localhost", "julian", "Julian2007!", "nettbutikk");
        $sql = "SELECT * FROM produkter";
        $result = $conn->query($sql);
        $conn->close();
        
        if ($result->num_rows > 0):
            while($row = $result->fetch_assoc()):
        ?>
                <div>
                    <span><?php echo $row['navn']; ?> - <?php echo $row['pris']; ?> kr</span>
                    <button type="submit" name="add_product" value="<?php echo $row['produkt_id']; ?>">Legg til</button>
                </div>
        <?php
            endwhile;
        else:
            echo "<p>Ingen produkter tilgjengelig.</p>";
        endif;
        ?>
        
        <!-- Fullfør bestilling-knapp -->
        <button type="submit" name="complete_order">Fullfør bestilling</button>
    </form>
</body>
</html>
