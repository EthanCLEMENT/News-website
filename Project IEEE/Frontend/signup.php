<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIT CSAIL | Sign up</title>
</head>

<body>

    <?php
    // start the session
    session_start();
    
    // load managers and controllers
    function loadClass($class)
    {
        require "../User/$class.php";
    }

    spl_autoload_register("loadClass");

    // get user info
    if ($_POST) {

        $userData = [
            "username" => $_POST['username'],
            "pwd" => $_POST['pwd'],
            "email" => $_POST['email']
        ];

        // get all user
        $existingAccount = False;
        $findExistingUser = new UserManager();
        $users = $findExistingUser->getAll();

        // make sure no empty string can be posted
        if (empty($userData['username'])) {
    ?> <script href="javascript:;">
                alert("Name is required")
            </script> <?php
                        $existingAccount = True;
                    }
                    // make sure no special characters can be used
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
                    // valid email format
                    if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
                        ?> <script href="javascript:;">
                alert("Invalid email format")
            </script> <?php
                        $existingAccount = True;
                    }
                    // make sure username address does not exist in the database
                    foreach ($users as $user) {
                        if ($user->getUsername() == $userData['username']) {
                        ?> <script href="javascript:;">
                    alert("This username is already taken !")
                </script> <?php
                            $existingAccount = True;
                            break;
                        }
                    }
                    // make sure email address does not exist in the database
                    foreach ($users as $user) {
                        if ($user->getEmail() == $userData['email'] && $existingAccount == False) {
                            ?> <script href="javascript:;">
                    alert("This email address is already taken !")
                </script> <?php
                            $existingAccount = True;
                            break;
                        }
                    }
                    // add user in database
                    if ($existingAccount == False) {
                        $findExistingUser->add(new User($userData));
                        echo "<script>window.location.href= '../Frontend/index.php'</script>";
                    }
                }
                    ?>

</html>
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
<div class="d-flex">
    <div class="col-sm-8" id="content" style="border-left: #dbe0e3 1px solid;">
        <form name="form_register" id="form_register" method="post" class="form-horizontal">
            <fieldset class="left-fieldset">
                <legend class="text-center">
                    <h2>Enter your details below.</h2>
                </legend>
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Username *</label>
                    <div class="col-sm-7">
                        <input type="text" name="username" id="username" class="form-control" maxlength="40" required />
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email *</label>
                            <div class="col-sm-7">
                                <input type="text" name="email" id="email" class="form-control" maxlength="40" required />
                            </div>
                            <label for="pwd" class="col-sm-2 control-label">Password *</label>
                            <div class="col-sm-7">
                                <input type="pwd" name="pwd" id="pwd" class="form-control" maxlength="20" />
                                <label for="pwd">Must be 8-20 characters long</label>
                            </div>
                            <br>
                            <div class="submit-button">
                                <button type="submit" class="btn btn-light btn-lg">Sign up</button>
                            </div>
                            <br>
                            <div class="redirect-login">
                                <a href="http://localhost/Project%20IEEE/Frontend/login.php", style="text-decoration:none;">Already have an account ? Log in here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    </body>

    </html>