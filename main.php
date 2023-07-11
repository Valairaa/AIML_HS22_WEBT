<?php
    // Die Cookies werden jetzt erstellt und via Script wird dann die Ansicht gefiltert.
    if ($_POST['filterAlles'] == "true") {
        setcookie("filterAlles", $_POST['filterAlles'], time()+3600);
    } else {
        setcookie("filterAlles", "false", time()+3600);
    }
    if ($_POST['filterFleisch'] == "true") {
        setcookie("filterFleisch", $_POST['filterFleisch'], time()+3600);
    } else {
        setcookie("filterFleisch", "false", time()+3600);
    }
    if ($_POST['filterVegetarisch'] == "true") {
        setcookie("filterVegetarisch", $_POST['filterVegetarisch'], time()+3600);
    } else {
        setcookie("filterVegetarisch", "false", time()+3600);
    }
    if ($_POST['filterKaese'] == "true") {
        setcookie("filterKaese", $_POST['filterKaese'], time()+3600);
    } else {
        setcookie("filterKaese", "false", time()+3600);
    }

function validateUserName($localName) {
    if (preg_match("/^[A-Za-z][A-Za-zäöüÄÖÜ ]{4,29}$/", $localName)) {
        return true;
    } else {
        return false;
    }
}

function validateUserMail($localMail) {
    if (preg_match("/^[^@]+@\w+(\.\w+)+\w$/", $localMail)) {
        return true;
    } else {
        return false;
    }
}

function validateUserAdresse($localAdresse) {
    if (preg_match("/^[A-Za-z][A-Za-zäöüÄÖÜ0-9 ]{4,29}$/", $localAdresse)) {
        return true;
    } else {
        return false;
    }
}

function validateUserPLZ($localPLZ) {
    if (preg_match("/^[0-9]{4}$/", $localPLZ)) {
        return true;
    } else {
        return false;
    }
}

function validateUserOrt($localOrt) {
    if (preg_match("/^[A-Za-z][A-Za-zäöüÄÖÜ ]{4,29}$/", $localOrt)) {
        return true;
    } else {
        return false;
    }
}

?>

<html>
    <head>
        <title>Willkommen</title>
        <meta charset="utf8">
        <link href="css/styleguide.css" rel="stylesheet"/>
    </head>
    <body class='phpText'>
    <?php
    if ($_POST['filterButton'] == "true") {
        echo "<h1>Sie haben sich für die Filterfunktion entschieden.</h1>";
        $iter = 0;
        if ($_POST['filterAlles'] == "true") {
            $iter = $iter + 1;
            echo "<h3>Alle Artikel wurden ausgewählt.</h3>";
        }
        if ($_POST['filterVegetarisch'] == "true") {
            $iter = $iter + 1;
            echo "<h3>Alle vegetarischen Produkte wurden ausgewählt.</h3>";
        }
        if ($_POST['filterFleisch'] == "true") {
            $iter = $iter + 1;
            echo "<h3>Alle Fleischprodukte wurden ausgewählt.</h3>";
        }
        if ($_POST['filterKaese'] == "true") {
            $iter = $iter + 1;
            echo "<h3>Alle Käseprodukte wurden ausgewählt.</h3>";
        }
        if ($iter == 0) {
            echo "<h2>Es wurden keine Filter ausgewählt.</h2>";
        } else {
            echo "<h2>Es wurden " . $iter . " Filter ausgewählt.</h2>";
        }
        echo "<div class='button'>";
        echo "<a id='linkPHP' href='./main.html#onlineShop'>Filter anwenden</a>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
        exit();
    }
    if ($_POST['bestellen'] == "true") {
        $userName = $_POST['userName'];
        $userMail = $_POST['userMail'];
        $userAdresse = $_POST['userAdresse'];
        $userPLZ = $_POST['userPLZ'];
        $userOrt = $_POST['userOrt'];

        // Validierung der Eingabewerte vom Formular
        if (validateUserName($userName) == false || validateUserMail($userMail) == false || validateUserAdresse($userAdresse) == false || validateUserPLZ($userPLZ) == false || validateUserOrt($userOrt) == false) {
            echo "<h3> ;-( </h3>";
            echo "<section>";
            echo "<nav> <h1>Ups. Wir haben leider ein paar Unstimmigkeiten im Formular gefunden.</h1> </nav>";
            echo "<h2>Insgesamt wurden folgende Werte falsch eingegen:</h2>";
            if (validateUserName($userName) == false) {
                echo "<h3>Der eingegebene Name ist nicht korrekt.</h3>";
            }
            if (validateUserMail($userMail) == false) {
                echo "<h3>Die eingegebene E-Mail ist nicht korrekt.</h3>";
            }
            if (validateUserAdresse($userAdresse) == false) {
                echo "<h3>Die eingegebene Adresse ist nicht korrekt.</h3>";
            }
            if (validateUserPLZ($userPLZ) == false) {
                echo "<h3>Die eingegebene Postleitzahl ist nicht korrekt.</h3>";
            }
            if (validateUserOrt($userOrt) == false) {
                echo "<h3>Der eingegebene Ort ist nicht korrekt.</h3>";
            }
            echo "<h2>Bitte gehen Sie zurück zum Online-Shop und geben Sie Ihre korrekten Daten erneut ein.</h2>";
            echo "<div class='button'>";
            echo "<a id='linkPHP' href='./main.html#onlineShop'>Zur Startseite zurückkehren</a>";
            echo "</div>";
            echo "<h3> ;-( </h3>";
            echo "</section>";
            echo "</body>";
            echo "</html>";
            exit();
        }

        echo "<h1>" . $userName ."! Vielen Dank für die Bestellung!</h1>";
        echo "<h3>Wir werden Ihre Bestellung so schnell wie möglich bearbeiten.</h3>";
        // Die gewählten Artikel werden als Cookie abgespeichert und hier ausgelesen.
        echo "<h3>_________________</h3>";
        echo "<div>";
        echo "<div> <h3>Sie haben folgende Produkte bestellt:</h3> </div>";
        echo "</div>";
        $produktAnzahl = 0;
        foreach ($_COOKIE as $cookie_name => $cookie_value) { 
            // Zeigt alle Cookies an, welche ein Produkt repräsentieren.
            echo "<div>";
            if (!preg_match("/^filter/", $cookie_name)) {
                echo "<li> <h3>" . $cookie_name . ", " . $cookie_value . " x Stück </h3> </li>";
                $produktAnzahl = $produktAnzahl + $cookie_value;
            } 
            echo "</div>";
        }
        echo "<h3>_________________</h3>";
        echo "<p> <h3>Die Artikel werden an folgende Adresse gesendet:</h3> </p>";
        echo "<div>";
        echo "<p> <h3>" . $userName . "</h3> </p>";
        echo "<p> <h3>" . $userAdresse . "</h3> </p>";
        echo "<p> <h3>" . $userPLZ . " - " . $userOrt . "</h3> </p>";
        echo "</div>";
        echo "<h3>_________________</h3>";
        echo "<div>";
        echo "<p> <h3>Sobald das Paket versendet wurde, werden wir eine Bestätigung an " . $userMail . " zusenden.</h3> </p>";
        echo "</div>";
        echo "<div> <section>";
        echo "<h2>Wir wünschen Ihnen einen schönen Tag!</h2>";
        echo "</section> </div>";
    }

    // Schaltet die Variabeln um, damit beim PageRefresh die Cookies und Einstellungen übernommen werden.
    $_POST['bestellen'] = "false";
    $_POST['filterButton'] = "false";
    ?>

    <div class="button">
        <a id="linkPHP" href="./main.html#onlineShop">Zur Startseite zurückkehren</a>
    </div>
    </body> 

    <footer>
        <p id="copyright">ONLINE WEBSHOP - Spezialitäten aus Piemont © Lukas Stöckli</p>
    </footer>
</html>
