<h2 xmlns="http://www.w3.org/1999/html">Ajouter un commentaire</h2>

<form action="" method="post">
    <p>
        <?= isset($erreurs) && in_array(App\lib\vendors\Entity\Comment::AUTEUR_INVALIDE, $erreurs) ? 'L\'auteur n\'est pas valide.' : '' ?>
        <label for="auteur-input">Pseudo</label>
        <input type="text" name="pseudo" value="<?= isset($comment) ? htmlspecialchars($comment['auteur']) : '' ?>" id="auteur-input"><br/>

        <?= isset($erreurs) && in_array(\App\lib\vendors\Entity\Comment::CONTENU_INVALIDE, $erreurs) ? 'Contenu invalide' : '' ?>
        <label for="comment-content">Contenu</label>
        <textarea name="contenu" value="<?= isset($comment) ? htmlspecialchars($comment['contenu']) : '' ?>" id="comment-content"></textarea><br/>

        <input type="submit" value="Commenter">
    </p>
</form>