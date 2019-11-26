<?php
declare(strict_types=1);

namespace App\lib\vendors\Model;

use App\lib\OCFram\Manager;
use App\lib\vendors\Entity\Comment;

abstract class CommentsManager extends Manager
{
    /**
     * @param Comment $comment
     * @return mixed
     */
    abstract protected function add(Comment $comment);

    /**
     * @param Comment $comment
     */
    public function save(Comment $comment)
    {
        if ($comment->isValid()) {
            $comment->isNew() ? $this->add($comment) : $this->modify($comment);
        } else {
            throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
        }
    }

    /**
     * @param $news
     * @return mixed
     */
    abstract public function getListOf($news);
}
