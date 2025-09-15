<?php
session_start();

try {
    $connection = new PDO("mysql:host=localhost;dbname=notes", "root", "");

    
        if (isset($_GET['id'])) {
                $deleteId = $_GET['id'];
                $req = $connection->prepare("DELETE FROM content WHERE id = :id");
                $req->execute([':id' => $deleteId]);
        }
        
    

    $userid = $_SESSION['userid'];
    $stmt = $connection->prepare("SELECT * FROM content WHERE userid = :userid");
    $stmt->execute([':userid' => $userid]);
    $notes = $stmt->fetchAll(PDO::FETCH_OBJ);

    if (!$notes) {
        echo "Note introuvable.";
        exit();
    }

    
} catch(PDOException $e) {
    echo "Problème de connexion: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Note</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://img.freepik.com/free-vector/tropical-leafy-background-vector_53876-144347.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .editContainer {
            max-width: 600px;
            margin: 100px auto;
            background: rgba(183, 168, 136, 0.137);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .sup:hover {
            transform: translateY(-2px);
            background-color: rgba(212, 79, 79, 0.81);
        }
        .mod:hover {
            transform: translateY(-2px);
            background-color: rgba(79, 212, 106, 0.81);
        }
        .sup{
            background-color: rgba(212, 79, 79, 0.81);
            font-style: italic;
        }
        .mod{
            background-color: rgba(79, 212, 106, 0.81);
            font-style: italic;
        }
    </style>
</head>
<body>
    <a href="noteLogout.php" class="btn btn-danger logout-btn">Déconnexion</a>
    <div class="editContainer">
        <h2 class="text-center mb-4">Suppression de le login</h2>
         <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Titre</th>
                    <th>Contenu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notes as $n): ?>
                <tr>
                    <td><?php echo $n->title; ?></td>
                    <td><?php echo $n->content; ?></td>
                    <td>
                        <a href="noteUpdate.php?id=<?php echo $n->id; ?>" class="btn mod btn-sm">Modifier</a>
                        <a href="?id=<?php echo $n->id; ?>" class="btn sup btn-sm" onclick="return confirm('Supprimer cette note ?')">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            <a href="AddNotePage.php" class="btn btn-danger btn-sm w-100">Ajouter +</a>
    </div>
        
    </div>
</body>
</html>
