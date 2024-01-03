<?php

session_start();

session_destroy();

header("Location: index.php");

?>

<!-- fare header e footer a parte e metterli static in index, poi inclusi nelle singole pagine -->