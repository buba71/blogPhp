<?php
declare(strict_types=1);

namespace App\lib\vendors\Model;

use App\lib\vendors\Entity\Comment;
use http\Exception\InvalidArgumentException;


class CommentsManagerPDO extends CommentsManager
{


    /**
     * @param Comment $comment
     * @return mixed
     */
    protected function add(Comment $comment)
    {
        $sql = 'INSERT INTO comments SET news = :news, auteur = :auteur, contenu = :contenu, date = NOW()';

        $query = $this->dao->prepare($sql);
        $query->bindValue(':news', $comment->getNews());
        $query->bindValue(':auteur', $comment->getAuteur());
        $query->bindValue(':contenu', $comment->getContenu());

        $query->execute();

        $comment->setId($this->dao->lastInsertId());
    }

    public function getListOf($news)
    {
        if (!ctype_digit($news))
        {
            throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
        }

        $q = $this->dao->prepare('SELECT id, news, auteur, contenu, date FROM comments WHERE news = :news');
        $q->bindValue(':news', $news, \PDO::PARAM_INT);
        $q->execute();

        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\lib\vendors\Entity\Comment');

        $comments = $q->fetchAll();

        foreach ($comments as $comment)
        {
            $comment->setDate(new \DateTime($comment->getDate()));
        }

        return $comments;
    }




}