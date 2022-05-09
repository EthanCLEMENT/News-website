<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Log In</title>
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

<?php
    session_start();
    
    function loadClass($class)
    {
        require "../User/$class.php";
    }

    spl_autoload_register("loadClass");

    if ($_POST) {

        $userData = [
            "username" => $_POST['username'],
            "pwd" => $_POST['pwd'],
            "email" => $_POST['email']
        ];

        $existingAccount = False;
        $findExistingUser = new UserManager();
        $users = $findExistingUser->getAll();

        if (empty($userData['username'])) {
    ?> <script href="javascript:;">
                alert("Name is required")
            </script> <?php
                        $existingAccount = True;
                    }

                    if (!preg_match("/^[a-zA-Z-' ]*$/", $userData['username'])) {
                        ?> <script href="javascript:;">
                alert("Only letters and white spaces allowed")
            </script> <?php
                        $existingAccount = True;
                    }

                    if (empty($userData['email'])) {
                        ?> <script href="javascript:;">
                alert("Email is required")
            </script> <?php
                        $existingAccount = True;
                    }

                    if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
                        ?> <script href="javascript:;">
                alert("Invalid email format")
            </script> <?php
                        $existingAccount = True;
                    }

                    foreach ($users as $user) {
                        if ($user->getUsername() == $userData['username']) {
                        ?> <script href="javascript:;">
                    alert("This username is already taken !")
                </script> <?php
                            $existingAccount = True;
                            break;
                        }
                    }
                    foreach ($users as $user) {
                        if ($user->getEmail() == $userData['email'] && $existingAccount == False) {
                            ?> <script href="javascript:;">
                    alert("This email address is already taken !")
                </script> <?php
                            $existingAccount = True;
                            break;
                        }
                    }
                    if ($existingAccount == False) {
                        $findExistingUser->add(new User($userData));
                        echo "<script>window.location.href= '../Frontend/index.php'</script>";
                    }
                }
                    ?>

<body>

</body>

</html>