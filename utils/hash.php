<?php

echo "hash(".$_GET["password"].") = ".password_hash($_GET["password"], PASSWORD_DEFAULT);

?>