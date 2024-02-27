<?php

$show_form = false;
$err_mess=null;
$success=null;

$err_password = false;
$err_utente = false;

if(isset($_SESSION["ID"])) {
    $err_mess="L'utente è già loggato";
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
        //$err_mess="L'utente non esiste";
        $err_utente = true;
    } elseif(!password_verify($_POST["password"], $row["Password"])) {
        $show_form = true;
        //$err_mess= "Password errata";
        $err_password = true;
    } else {
        $_SESSION["ID"] = $row["ID"];
        $_SESSION["username"] = $row["Username"];
        header("Location: home.php");
    }
} else {
    $show_form = true;
}

if($show_form){
?>
 <form method="POST" action="login.php" class="mt-5">
    <fieldset>
        <legend>Login</legend>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input title="email" type="email" name="email" id="email" class="form-control" placeholder="La tua e-mail" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input title="password" type="password" name="password" id="password" class="form-control" placeholder="La tua password" required>
        </div>
        <button title="invia" type="submit" class="btn btn-dark">Login</button>
</fieldset>
    </form>

    <?php if (!is_null($err_mess)){ ?>
        <div class="alert alert-danger mt-3" role="alert">
            <?php echo $err_mess; ?>
        </div>
        <?php
    }

if ($err_utente) { ?>
    <div class="alert alert-danger mt-4">
        <?php echo "utente non trovato"; ?>
    </div>
<?php } elseif ($err_password){ ?>
    <div class="alert alert-danger mt-4">
    <?php echo "password errata"; ?>
    </div>
<?php } 
}
?>
<p class="mt-3 text-center">Non sei ancora registrato? <a title="registrati" class="link-primary" href="register.php">Registrati</a></p>
