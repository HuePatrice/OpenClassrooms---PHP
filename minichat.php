<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mini-chat</title>
    </head>
    <body>
    <h1 align="center">Mon Super Minichat !</h1>
    <div align="center">
        <form action="minichat-post.php" method="post" role="form">
        <table>
            <tr>
                <td align="right">
                    <label for="pseudo">PSEUDO :</label> 
                </td>
                <td>
                    <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($_COOKIE['pseudo'])){ echo $_COOKIE['pseudo']; }?>
">
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="message">MESSAGE :</label> 
                </td>
                <td>
                    <input type="text" name="message" id="message" value="">
                </td>
            </tr> 
            <tr>
            <td></td>
                <td>
                    <input type="submit" value="Envoyer">
                    <input type="button" value="Rafraichir" id="refresh">
                </td>
            </tr>       
        </table>
        </form>
    </div>

<?php

// Connexion à la base de données

    try
    {
	   $bdd = new PDO('mysql:host=localhost;dbname=activite;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }

// Récupération des 10 derniers messages

    $reponse = $bdd->query('SELECT pseudo, message, DATE_FORMAT(date_creation, "Ecrit le %d/%m/%Y à %Hh%imin%ss") AS date_post FROM minichat ORDER BY ID DESC LIMIT 0, 10');

    while ($donnees = $reponse->fetch())
    {
        echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . utf8_decode(htmlspecialchars($donnees['message'])). '<br><em>'.$donnees['date_post'].'</em></p>';
    }

    $reponse->closeCursor();

?>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    </body>
</html>