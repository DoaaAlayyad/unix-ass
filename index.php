<?php
$mysqli = new mysqli("localhost", "root", "", "dictionary");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $word = $_POST['word'];
    $query = $mysqli->prepare("SELECT definition FROM words WHERE word = ?");
    $query->bind_param("s", $word);
    $query->execute();
    $result = $query->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Definition: " . htmlspecialchars($row['definition']);
    } else {
        echo "Word not found!";
    }
}
?>

<form method="POST">
    <input type="text" name="word" placeholder="Enter a word">
    <button type="submit">Search</button>
</form>
