<?php
 $connection = new PDO("mysql:host=localhost;dbname=notes", "root", "");
 $id=$_GET['id'];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $title = $_POST["title"];
        $content = $_POST["content"];

        $stmt = $connection->prepare("UPDATE content SET title = :title, content = :content WHERE id = :id");
        $stmt->execute([':title' => $title, ':content' => $content, ':id' => $id]);
        header("Location: noteForm.php");
        exit();
    }
    $stmt = $connection->prepare("SELECT * FROM content WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $n = $stmt->fetch(PDO::FETCH_OBJ);
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
        }
    </style>
</head>
<body>
    <a href="noteLogout.php" class="btn btn-danger logout-btn">Déconnexion</a>
        
    <div class="dashboardContainer">
        <h2 class="text-center mb-4">Mes Notes</h2>
        <form method="post" class="mb-4">
            <div class="mb-3">
                <input type="text" value="<?php echo $n->title; ?>"  name="title" class="form-control" placeholder="Titre" required>
            </div>
            <div class="mb-3">
                <textarea name="content" class="form-control" placeholder="Contenu" required><?php echo $n->content; ?> </textarea>
            </div>
            <button type="submit" class="btn btn-success ">Sauvgarder</button>
        </form>

       
    </div>
</body>
</html>