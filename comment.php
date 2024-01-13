<?php

session_start();

require_once("bootstrap.php");
include "template/renderComment.php";
require_once ("template/post.php");

$templateParams["titolo"] = "SoundDrift - Commenti";
$templateParams["nome"] = "comment.php";

require("template/base.php");

?>