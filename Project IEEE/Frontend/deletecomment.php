<?php

// call classes
function loadClass(string $class)
    {
        require "../User/$class.php";
    }
    spl_autoload_register("loadClass");

$manager = new CommentManager();

// delete article 
if ($_GET) {
    $comment = $manager->get($_GET['id']);
    $test = $comment->getArticleid();
    $manager->delete($_GET['id']);
    header("Location: ../Frontend/index.php");
}
?>