var request = new XMLHttpRequest(); // RequestObject anlegen


function init() {
    document.getElementById("urlform").addEventListener("input", sendData);

}


function sendData() {
    "use strict";
    let elem = event.target;

    request.open("GET", "CalculateHash.php?url=" + elem.value); // definiert URL für Datenabfrage
    request.onreadystatechange = processData; // Callback-Handler zuordnen
    request.send();
    console.log(elem.value);
}


function processData() {
    //console.log("angekommen");
    if (request.readyState == 4) { // Uebertragung = DONE
        if (request.status == 200) {   // HTTP-Status = OK
            if (request.responseText != null)
                process(JSON.parse(request.responseText));// Daten verarbeiten
            else console.error("Dokument ist leer");
        }
        else console.error("Uebertragung fehlgeschlagen");
    } else;          // Uebertragung laeuft noch
}

function process(hash) {
    console.log("hash: " + hash);
    let inputHash = document.getElementById("inputHash");
    inputHash.value = hash;

}
