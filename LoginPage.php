<?php
session_start();

try {
    $connection = new PDO("mysql:host=localhost;dbname=notes", "root", "");

    if (isset($_POST["login"]) && isset($_POST["MotsPasse"])) {
        $login = $_POST["login"];
        $MotsPasse = $_POST["MotsPasse"];

        $req = $connection->prepare("SELECT * FROM logins WHERE login = :login AND password = :password");
        $req->execute([':login' => $login, ':password' => $MotsPasse]);
        $user=$req->fetch(PDO::FETCH_OBJ);

        if ($req->rowCount() > 0) {
            
            $_SESSION['user'] = $login;
            $_SESSION['userid']=$user->id;
            header("Location: AddNotePage.php");
            exit();
        } 
        else{
            echo "incorect password";
        }

        $req = $connection->prepare("SELECT * FROM logins WHERE login = :login AND password = :password");
        $req->execute([':login' => $login, ':password' => $MotsPasse]);
        $user=$req->fetch(PDO::FETCH_OBJ);
        
    }
} catch(PDOException $e) {
    echo "Problème de connexion: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('https://img.freepik.com/free-vector/tropical-leafy-background-vector_53876-144347.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-style: italic;
        }

        .formContainer {
            max-width: 500px;
            margin: 100px auto;
            background: rgba(183, 168, 136, 0.137);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
            text-decoration: underline;
        }
        .btn:hover {
            font-size: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); 
        }
        .con{
            background-color: rgba(135, 134, 140);
            font-style: italic;
        }
        a{
            text-decoration:none;
            padding-left:20px;
        }
        a:hover{
            text-decoration: underline;
        }
        label{
            text-decoration: underline;
        }
        .link{
            margin-left: 110px;
        }
    </style>
</head>
<body>

    <div class="formContainer">
        <h2 class="form-title"><i>Bienvenue sur Student Notes Manager</i></h2>
        <form method="post">
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" name="login" id="login" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="MotsPasse" class="form-label">Mot de passe</label>
                <input type="password" name="MotsPasse" id="MotsPasse" class="form-control" required>
            </div>
            <div class="link">
                <button type="submit" class="btn con">Connexion</button>
                <a href="signup.php">cree votre compte</a>
            </div>
        </form>
    </div>

</body>
</html>