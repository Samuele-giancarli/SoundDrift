<?php

$show_form = false;
$err_mess=null;

if(isset($_SESSION["ID"])) {
    $err_mess="L'utente è già loggato";
    echo $err_mess;
} elseif(isset($_POST["email"])) {
    $db = new mysqli("127.0.0.1", "root", "", "sounddrift", 3306);
    $stmt = $db->prepare("SELECT * FROM utente WHERE email=?");
    $stmt->bind_param("s", $email);
    $email = $_POST["email"];
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $db->close();
    if(is_null($row)) {
        $show_form = true;
        $err_mess="L'utente non esiste";
    } elseif(!password_verify($_POST["password"], $row["Password"])) {
        $show_form = true;
        $err_mess= "Password errata";
    } else {
        $_SESSION["ID"] = $row["ID"];
        $_SESSION["username"] = $row["Username"];
        header("Location: index.php");
    }
} else {
    $show_form = true;
}

if($show_form) {
?>
<form method="POST" action="login.php">
    <input type="email" name="email" placeholder="La tua e-mail"/>
    <input type="password" name="password" placeholder="La tua password"/>
    <input type="submit" value="Login"/>
</form>
<?php

if (!is_null($err_mess)){
    echo $err_mess;
}
}
?>
<a href="register.php" style="color: black"><p>Non sei ancora registrato?</p></a>