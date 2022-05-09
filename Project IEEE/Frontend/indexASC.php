<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Home Page | MIT CSAIL</title>
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
                        <a class="nav-link active" aria-current="page" href="../Frontend/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Frontend/createarticle.php">publish an article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../Frontend/login.php">Log in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../Frontend/index.php">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../Frontend/signup.php">Sign up</a>
                    </li>
                </ul>
                <form class="d-flex" method="POST">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="title" id="title">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</header>
<body>
    
    <?php 
    function loadClass($class){
        require "../User/$class.php";
    }
    spl_autoload_register("loadClass"); 

    $articleManager = new ArticleManager();

    $articles = $articleManager->getAll();

    if ($_POST) {
        $datas = [
            "title" => $_POST["title"],  
        ];
        foreach($articles as $article){
            // display article from search bar
            if($article->getTitle() == $datas['title']){
                ?>
                <div class="card m-5" style="width: 15%;border: solid; border-radius: 10px;">
                
                <div class="card-body">
                    <h5 class="card-title"><?= $article->getTitle() ?></h5>
                    <p class="card-text"><?= $article->getContent() ?><br><?= $article->getAuthor() ?>
                    <br><?= $article->getTodaydate()?></p>
                    <a href="../User/read.php?id=<?= $article->getId() ?>" class="btn btn-primary">Read Article</a>
                    <a href="../Frontend/delete.php?id=<?= $article->getId() ?>" class="btn btn-danger">delete</a>
                    <a href="../Frontend/modify.php?id=<?= $article->getId() ?>" class="btn btn-success">modify</a>
                </div>
            </div>
          <?php  } ?>
     <?php   } ?>
 <?php } ?>
 <?php //display articles ?>
 <a href="../Frontend/index.php" class="btn btn-primary">Sort by the oldest articles first</a>
 <a href="../Frontend/indexTitlesASC.php" class="btn btn-primary"> sort by A-Z</a>
 <a href="../Frontend/indexTitlesDESC.php" class="btn btn-primary"> sort by Z-A</a>
    <div class="d-flex flex-wrap justify-content-around">
        <?php foreach ($articles as $article) { ?>
            <div class="card m-5" style="min-width: 200px !important; width: 15%;border: solid; border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title"><?= $article->getTitle() ?></h5>
                    <p class="card-text"><?= $article->getContent() ?><br><?= $article->getAuthor() ?>
                    <br><?= $article->getTodaydate()?></p>
                    <a href="../User/read.php?id=<?= $article->getId() ?>" class="btn btn-primary">Read Article</a>
                    <a href="../Frontend/delete.php?id=<?= $article->getId() ?>" class="btn btn-danger">delete</a>
                    <a href="../Frontend/modify.php?id=<?= $article->getId() ?>" class="btn btn-success">modify</a>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>