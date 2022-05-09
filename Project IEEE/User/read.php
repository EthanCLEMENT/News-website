<!DOCTYPE html>
<html lang="eng">
<?php
// code to write a comment + CRUD
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Read</title>
</head>
<!-- navbar -->
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
                        <a class="nav-link active" aria-current="page" href="../Frontend/signup.php">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../Frontend/index.php">Articles</a>
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

    <?php
    // load managers and controllers
    function loadClass(string $class){
        require "$class.php";
    }
    spl_autoload_register("loadClass");
    // find a specific article
    $manager = new ArticleManager();

    $article = $manager->get($_GET["id"]);
    
    $manager = new CommentManager();
    $comments = $manager->getAllByArticleId($_GET["id"]);
    // add comment
    if ($_POST) {
            $manager = new CommentManager();
    
            $newComment = new Comment($_POST);
            $newComment->setArticleId($_GET["id"]);
    
            $manager->add($newComment);
    
            echo "<script>window.location.href='read.php?id={$_GET["id"]}'</script>";
        }
    ?>
    <?php 
    // display comment
    ?>
    <div class="d-flex justify-content-center">
        <div class="card m-5" style="width: 18rem;" style="display: flex;">
            <div class="card-body">
                <h5 class="card-title"><?= $article->getTitle() ?></h5>
                <p class="card-text"><?= $article->getContent() ?> </p>
                <?= $article->getTodaydate() ?>
                <p><?= $article->getAuthor() ?> </p>
                <br>
                <div class="d-flex justify-content-center">
                    <a href="../Frontend/delete.php ?id=<?= $article->getId() ?>" class="btn btn-danger"> Delete </a>
                    <a href="javascript:;" onclick="toggleCommentForm()" class="btn btn-primary">New Comment</a>
                </div>
                <button id="mask">Hide comments</button>
                <div id ="comments">
                <?php foreach ($comments as $comment) { ?>
                    <div>
                        <br>
                        <p class="card-text"><?= $comment->getContent() ?></p>
                        <p><?= $comment->getTodayDate() ?></p>
                        <p><?= $comment->getAuthor() ?> </p>
                        <br>
                        <a href="../Frontend/deletecomment.php?id=<?= $comment->getId($_GET["id"]) ?>" class="btn btn-danger"> Delete </a>
                        <a href="../Frontend/modifycomment.php?id=<?= $comment->getId($_GET["id"]) ?>" class="btn btn-success"> Modify </a>
                    </div>
                </div>
                <?php }

                ?>
                
                <form method="POST" class="container" id="comment-form" style="display: none">
                    <!-- <label>Title :</label>
                <input type="text" name="title" id="title" class="form-control"> -->
                    <label>Content :</label>
                    <textarea type="text" name="content" id="content" class="form-control"></textarea>
                    <label>Author :</label>
                    <input type="text" name="author" id="author" class="form-control">
                    <input type="submit" value="Publier" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

    <script src="./script.js"></script>

    <?php
    // hide and show comment
    ?>
    <script type="text/javascript">
        let mask = document.getElementById("mask");
        let comments = document.getElementById("comments");
        mask.addEventListener("click", () => {
          if(getComputedStyle(comments).display != "none"){
            comments.style.display = "none";
          } else {
        comments.style.display = "block";
  }
})

</script>

</body>

</html>