document.addEventListener("DOMContentLoaded", function() {
    console.log("Nettbutikk lastet!");

    // Finn bestillingsskjemaet hvis det finnes på siden
    let bestillingsSkjema = document.getElementById("bestillingsSkjema");
    if (bestillingsSkjema) {
        bestillingsSkjema.addEventListener("submit", function(event) {
            event.preventDefault(); // Hindrer siden fra å laste på nytt

            // Henter brukerinput
            let navn = document.getElementById("navn").value.trim();
            let adresse = document.getElementById("adresse").value.trim();

            if (navn === "" || adresse === "") {
                alert("Vennligst fyll ut alle feltene!");
                return;
            }

            // Viser en bekreftelsesmelding
            alert("Bestilling sendt! Vi kontakter deg snart.");
            
            // Send skjemaet
            bestillingsSkjema.submit();
        });
    }
});
