<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Samle inn data fra skjemaet
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Enkel validering
    if ($password !== $confirm_password) {
        echo "Passordene matcher ikke.";
        exit();
    }

    // Her vil du normalt koble til databasen og lagre brukeren
    // Eksempel: Koble til databasen med MySQLi eller PDO

    // Tilkobling til MySQL (dette må tilpasses dine databaseinnstillinger)
    $conn = new mysqli("localhost", "brukernavn", "passord", "database");

    // Sjekk om tilkoblingen lykkes
    if ($conn->connect_error) {
        die("Tilkoblingsfeil: " . $conn->connect_error);
    }

    // Krypter passordet
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Sett inn brukeren i databasen
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Bruker opprettet!";
    } else {
        echo "Feil: " . $conn->error;
    }

    $conn->close();
}
?>
