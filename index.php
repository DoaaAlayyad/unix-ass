<?php
$mysqli = new mysqli("localhost", "root", "", "dictionary");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $word = $_POST['word'];
    $query = $mysqli->prepare("SELECT definition = ?");
    $query->bind_param("s", $word);
    $query->execute();
    $result = $query->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "def: " . htmlspecialchars($row['definition']);
    } else {
        echo "Sorry, the word you entered is not in the dictionary!";
    }
}
?>

<form method="POST">
    <input type="text" name="word" placeholder="Enter a word">
    <button type="submit">Search</button>
</form>
