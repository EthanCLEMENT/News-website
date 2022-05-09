<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Create</title>
</head>

<body>
<?php
    // modify comment
    function loadClass($class){
        require "../User/$class.php";
    }

    spl_autoload_register('loadClass');

    $manager = new CommentManager();

    if ($_GET) {
        $comment = $manager->get($_GET['id']);

    }

    if ($_POST) {
        $donnees = [
            "id" => $_GET["id"],
            "content" => $_POST["content"],
            "author" => $_POST["author"]
        ];

        $article_id = $comment->getArticleid(); 
        

        $manager->update(new Comment($donnees));
        header("Location: ../Frontend/index.php");

        //header("Location: ./read.php?id={$_GET["id"]}");
    }


?>

<form method="POST" class="container">
    <h2>Modify Comment</h2>
        <label>Content :</label>
        <textarea type="text" name="content" id="content" class="form-control"><?= $comment->getContent(); ?></textarea>
        <label>Author :</label>
        <input type="text" name="author" id="author" class="form-control" value="<?= $comment->getAuthor(); ?>">
        <input type="submit" value="update" class="btn btn-primary">
    </form>
</body>

</html>