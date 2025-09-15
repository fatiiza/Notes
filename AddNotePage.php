<?php
session_start();
/*if (!isset($_SESSION["login"])) {
    header("Location: homePage.php");
    exit();
}*/

try {
    $connection = new PDO("mysql:host=localhost;dbname=notes", "root", "");

    if (isset($_POST["title"]) && isset($_POST["content"])) {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $userid=$_SESSION["userid"];
        $req = $connection->prepare("INSERT INTO content (title, content, userid) VALUES (:title, :content, :userid)");
        $req->execute([':title' => $title, ':content' => $content, ':userid'=>$userid]);
    }

   

}
catch(PDOException $e) {
    echo "Problème de connexion: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://img.freepik.com/free-vector/tropical-leafy-background-vector_53876-144347.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-style: italic;
        }
        .dashboardContainer {
            max-width: 800px;
            margin: 100px auto;
            background: rgba(183, 168, 136, 0.137);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: rgba(226, 57, 57, 0.64);
        }
        .btn:hover {
            font-size: 17px;
            transform: translateY(-2px);
        }
        .test{
            background-color: rgb(150, 172, 130);
            font-style: italic;
            margin:10px;
        }
        #div{
            display:flex;
        }
    </style>
</head>
<body>
    <a href="noteLogout.php" class="btn logout-btn">Déconnexion</a>

    <div class="dashboardContainer">
        <h2 class="text-center mb-4">Mes Notes</h2>
        <form method="post" class="mb-4">
            <div class="mb-3">
                <input type="text" name="title" class="form-control" placeholder="Titre" required>
            </div>
            <div class="mb-3">
                <textarea name="content" class="form-control" placeholder="Contenu" required></textarea>
            </div>
            <div id="div">
                <button type="submit" class="btn w-50 test">Ajouter</button>
                <a type="submit" href="noteForm.php" class="btn w-50 test ">Voire tous mes notes</a>
            </div>
        </form>

       
    </div>
</body>
</html>
