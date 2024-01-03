<?php

if(isset($_POST["email"])) {
    $db = new mysqli("127.0.0.1", "root", "", "sounddrift", 3306);
    $stmt = $db->prepare("SELECT * FROM utente WHERE email=?");
    $stmt->bind_param("s", $email);
    $email = $_POST["email"];
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $db->close();
    if(is_null($row)) {
        echo "L'utente non esiste";
    } elseif(!password_verify($_POST["password"], $row["Password"])) {
        echo "Password errata";
    } else {
        $_SESSION["email"] = $row["Email"];
        $_SESSION["username"] = $row["Username"];
        header("Location: index.php");
    }
} else {
?>
<form method="POST" action="login.php">
    <input type="email" name="email" placeholder="email"/>
    <input type="password" name="password" placeholder="password"/>
    <input type="submit" value="login"/>
</form>
<?php
}
?>