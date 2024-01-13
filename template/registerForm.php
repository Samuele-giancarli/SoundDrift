<?php

$err_mess = null;
$show_form = false;

if(isset($_SESSION["ID"])) {
    $err_mess="OPS! Sei già registrato";
} elseif(isset($_POST["email"])) {
    $username=$_POST["username"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $password2=$_POST["password2"];

    $db = new mysqli("127.0.0.1", "root", "", "sounddrift", 3306);
    if($password!=$password2){
        $err_mess="Le due password non corrispondono";
        $show_form=true;
    }elseif(strlen($username) < 1){
        $err_mess="Il nome utente deve avere almeno un carattere";
        $show_form=true;
    }elseif(strlen($email) < 5){
        $err_mess="La mail non è valida";
        $show_form=true;
    }elseif(strlen($password) < 3){
        $err_mess="La password deve essere lunga almeno 3 caratteri";
        $show_form=true;
    }else{
        $pwhash=password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO utente(Email,Password,Username) VALUES(?,?,?)");
        $stmt->bind_param("sss", $email, $pwhash,$username);
        try {
            if($stmt->execute()) {
                $err_mess="<a href=\"login.php\" style=\"color:black\">Registrazione effettuata con successo, ora puoi fare il login</a>";
            } else {
                $err_mess="Errore sconosciuto";
                $show_form=true;
            }
        } catch(mysqli_sql_exception $e) {
            $err_mess="Nome utente o e-mail già utilizzati";
            $show_form=true;
        }
    }
    $db->close();
}else{
    $show_form=true;
}

if($show_form) {
?>
<form action="register.php" method="post">
    <h2>Registrazione</h2>
    <div>
        <label for="username">Nome utente:</label>
        <input type="text" name="username" id="username" autocomplete="off" placeholder="Inserisci nome utente">
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Inserisci email">
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Inserisci password">
    </div>
    <div>
        <label for="password2">Conferma password:</label>
        <input type="password" name="password2" id="password2" placeholder="Ripeti password">
    </div>
    <button type="submit">Registrati</button>
    </form>
    <a href="login.php" style="color:black">Sei già registrato?</a>
<?php
}
if(!is_null($err_mess)) {
    echo $err_mess;
}
?>
