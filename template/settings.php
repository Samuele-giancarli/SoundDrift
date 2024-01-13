<p>Vuoi cambiare la tua password?</p>
<?php
$show_form = false;
$err_mess=null;

if (!isset($_SESSION["ID"])){
    die();
}

$userInfo=$dbh->getUserInfo($_SESSION["ID"]);
//vecchia hash effettiva
$hRoldpw=$userInfo["Password"];


if (isset($_POST["oldPassword"]) && isset($_POST["newPassword"])){
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
    $err_mess="La password è stata cambiata con successo";
    $show_form=false;
}
}

if ($show_form=true){
?>
<form action="settings.php" method="POST" id="passwordchange" autocomplete="off">
    <div>
    <input type="password" autocomplete="new-password" name="oldPassword" id="oldPassword" placeholder="La tua vecchia password"/>
    </div>
    <div>
    <input type="password" autocomplete="new-password" name="newPassword" id="newPassword" placeholder="La tua nuova password"/>
    </div>
    <div>
    <input type="submit" value="Cambia password"/>
    </div>
</form>
<?php
}
if (!is_null($err_mess)){
    echo $err_mess;
}
?>