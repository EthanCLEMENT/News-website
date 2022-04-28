<?php
function loadClass($class){
    require "../User/$class.php";
}
spl_autoload_register("loadClass"); 

if ($_POST) {

    $donnees = [
        "title" => $_POST["title"],
        "content" => $_POST["content"],
        "todaydate" => date("Y-m-d H:i:s"),
        "author" => $_POST["author"]
    ];

    $articles = new ArticleManager();
    $articles->add(new Article($donnees));

    foreach($articles as $article){
       ?> <div class="card m-5">
           
        </div> <?php 
    }
     echo "<script>window.location.href='index.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Test</title>
</head>

<style>
    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    .topnav {
        overflow: hidden;
        background-color: #333;
    }

    .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .topnav a:hover {
        background-color: #ddd;
        color: black;
    }

    .topnav a.active {
        background-color: #04AA6D;
        color: white;
    }
</style>
</head>
<header class="site-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MIT CSAIL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Frontend/createarticle.php">publish an article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../Frontend/login.php">Log in</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</header>
<body>
   
    <div>
        <form method="post" enctype="multipart/form-data" class="container">
            <br>
            <div align="center">
                <div class="titre">
                    <input type="text" name="title" id="title" class="form-control" aria-describedby="passwordHelpInline" placeholder="title" required>
                </div>
            </div>
            <br>
            <div class="content">
                <div class="col-auto">
                    <textarea class="form-control" name="content" id="content" placeholder="content" required></textarea>
                </div>
            </div>
            <br>
            <div align="center">
                <div class="author">
                    <input type="text" name="author" id="author" class="form-control" aria-describedby="passwordHelpInline" placeholder="author" required>
                </div>
            </div>
            <br>
            <div align="center">
                <input type="submit" value="makearticle" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>

</html>