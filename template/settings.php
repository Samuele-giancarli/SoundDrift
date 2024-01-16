<?php
$show_form = false;
$err_mess=null;
$success=null;

if (!isset($_SESSION["ID"])){
    die();
}

$userInfo=$dbh->getUserInfo($_SESSION["ID"]);
//vecchia hash effettiva
$hRoldpw=$userInfo["Password"];


if (isset($_POST["oldPassword"]) && isset($_POST["newPassword"]) ){
//vecchia password scritta
$Toldpw=$_POST["oldPassword"];
//nuova password scritta
$Tnewpw=$_POST["newPassword"];
//nuova hash scritta
$hTnewpw=password_hash($Tnewpw,PASSWORD_DEFAULT);

if(strlen($Tnewpw) < 3){
    $err_mess="La nuova password non può avere meno di 3 caratteri";
    $show_form=true;
}elseif (!password_verify($Toldpw, $hRoldpw)){
    $err_mess="La password inserita non corrisponde a quella nel database";
    $show_form=true;
}elseif ($Tnewpw==$Toldpw){
    $err_mess="La nuova password non può essere uguale alla vecchia";
}else{
    $dbh->updatePassword($userInfo["ID"],$hTnewpw);
    $success="La password è stata cambiata con successo";
    $show_form=false;
}
}

if ($show_form=true){
?>
<form action="settings.php" method="POST" id="passwordchange" autocomplete="off" class="mt-5">
<legend>Vuoi cambiare la tua password?</legend>
    <div class="mb-3">
            <label for="oldPassword" class="form-label">La tua vecchia password:</label>
            <input type="password" name="oldPassword" id="oldPassword" class="form-control" placeholder="La tua vecchia password" required>
        </div>
        <div class="mb-3">
            <label for="newPassword" class="form-label">La tua nuova password:</label>
            <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="La tua nuova password" required>
        </div>
        <button type="submit" class="btn btn-dark">Login</button>
</form>
<?php

}
if (!is_null($err_mess)) { ?>
    <div class="alert alert-danger mt-4">
        <?php echo $err_mess; ?>
    </div>
<?php } elseif (!is_null($success)){ ?>
    <div class="alert alert-primary mt-4">
    <?php echo $success; ?>
    </div>
<?php } 
?>