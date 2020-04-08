<?php
$pdo = new PDO(
    "mysql:host=localhost;dbname=restaurants",
    'root',
    '',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
);

$erreur = '';


if (isset($_GET['msg']) && !empty($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

// ********************************************************************
// Insertion en Base
// ********************************************************************
if (!empty($_POST)) {
    // je récupere les valeurs POST de mon formulaire 
    $nom = ($_POST['nom']);
    $adresse = ($_POST['adresse']);
    $telephone = ($_POST['telephone']);
    $type = ($_POST['type']);
    $note = ($_POST['note']);
    $avis = ($_POST['avis']);


    if (empty($nom)) {
        $erreur = "le champ nom n'est pas rempli";
    }
    if (empty($adresse)) {
        $erreur = "Le champ adresse ne dois pas etre vide";
    }
    if (empty($telephone < 10)) {
        $erreur = "Vous devez indiquer votre numero de Telephone";
    }
    if (empty($note)) {
        $erreur = "le champ note n'est pas rempli";
    }

    // j'envoie dans ma table client les données de mon formulaire
    $pdo->query("INSERT INTO restaurant
        (nom,adresse,telephone,type,note,avis) VALUES
        ('$nom','$adresse','$telephone','$type','$note','$avis')");
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            width: 300px;
        }
    </style>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea'
        });
    </script>
</head>

<body>
    <?php echo $msg; ?>
    <div style="color:red;"><?php echo $erreur; ?></div>
    <form name="formulaire" method="POST" action="formulaire.php" enctype="multipart/form-data">

        <input type="text" placeholder="Nom" name="nom">
        <input type="text" placeholder="Adresse" name="adresse">
        <input type="number" placeholder="Téléphone" name="telephone">

        <select name="type" id="type">
            <option disabled selected>Type</option>
            <option value="1">gastronomique</option>
            <option value="2">brasserie</option>
            <option value="3">pizzeria</option>
            <option value="4">autre</option>
        </select>

        <select name="note">
            <option disabled selected>sélectionner une note</option>
            <?php
            for ($i = 0; $i <= 5; $i++) {
                echo "<option>$i</option>";
            }
            ?>
        </select>

        <textarea type="text" placeholder="Votre Avis" name="avis"></textarea>

        <button type="submit">Envoyer</button>
    </form>
    <textarea>Next, use our Get Started docs to setup Tiny!</textarea>
</body>

</html>