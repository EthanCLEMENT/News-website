<?php

// call classes
function loadClass(string $class)
    {
        require "../User/$class.php";
    }
    spl_autoload_register("loadClass");

$manager = new ArticleManager();

// delete article 
if ($_GET) {
    $manager->delete($_GET['id']);
    echo "<script>window.location.href='index.php'</script>";
}
?>