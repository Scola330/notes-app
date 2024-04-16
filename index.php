
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="insertIn">
        <form method="POST">
            <div class="text">
                <form><input type="text" name="text" placeholder="tekst"></input>
            </div><br>
            <div class="tag">
                <form><input type="text" name="tag" placeholder="tag"></input>
            </div><br>
            <input type="submit" name="zapisz">
        </form> <br>
    </div>
    <div class="sherch">
        <form method="POST">
            <div class="sherchItem"><input type="text" name="term" placeholder="wyszukaj"></input></div><br>
            <input type="submit" name="wyszukaj"></input>
        </form>
    </div>
    <div class="edytuj">
        <form method="POST">
            <div class="edit_text"><input type="text" name="edit_text" placeholder="usun z strony"></div><br>
            <div class="edit_tag"><input type="text" name="edit_tag" placeholder="usun z strony"></div><br>
            <input type="submit" name="usun_z_tabeli"></input>
        </form>
    </div>
    <div class="messages"></div>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli = new mysqli("localhost", "root", "", "notess");
    //echo "polaczenie nawiazano";
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL database: " . $mysqli->connect_error;
        exit();
    }
    //echo "polaczenie nawiazano";
    if (isset($_POST["zapisz"])) {
        $stmt = $mysqli->prepare("INSERT INTO notepad(text_iserted, time_sent, tag) VALUES (?, ?, ?);");
        //echo "wyslano zapytanie";
        $stmt->bind_param("sss", $text, $time_sent, $tag);
        $text = $_POST["text"];
        $tag = $_POST["tag"];
        $time_sent = date("H:i:s");
        $stmt->execute();
        $stmt->close();
    } else
        if (isset($_POST["wyszukaj"])) {
            echo "wyszukiwanie";
            $zapytanie = $_POST["term"];
                $sherch = $mysqli->query("SELECT text_iserted, time_sent, tag FROM notepad WHERE text_iserted LIKE '%$zapytanie%';");
                while ($row = mysqli_fetch_array($sherch)) {
                    echo $row["time_sent"] . "<br>" . $row["text_iserted"] . "<br>" . $row["tag"] . "<br><br>";
                }
        } else
        if (isset($_POST["edytuj"])){
            $edycja
        }
    $mysqli->close();
}
?>
</body>

</html>