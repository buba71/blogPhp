<p>Par <em><?= $news['auteur'] ?></em>, le <?= $news['dateAjout']->format('d/m/Y à H\hi') ?></p>
<h2><?= $news['titre'] ?></h2>
<p><?= nl2br($news['contenu']) ?></p>

<?php if ($news['dateAjout'] != $news['dateModif']) { ?>
    <p style="text-align: right;">
        <small><em>Modifiée le <?= $news['dateModif']->format('d/m/Y à H\hi') ?></em></small>
    </p>
<?php } ?>

<p><a href="commenter-<?= $news['id'] ?>.html">Ajouter un commentaire</a></p>

<?php
if (empty($comments)) {
    ?>
    <p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
    <?php
}

foreach ($comments as $comment) {
    ?>
    <fieldset>
        <legend>
            Posté par :
            <strong>
                <?= htmlspecialchars($comment->getAuteur()) ?>
            </strong>
            le <?= $comment->getDate()->format('d/m/Y à H\hi') ?>
        </legend>
        <p><?= nl2br(htmlspecialchars($comment->getContenu())) ?></p>
    </fieldset>
    <?php
}
?>


<p><a href="commenter-<?= $news['id'] ?>.html">Ajouter un commentaire</a></p>