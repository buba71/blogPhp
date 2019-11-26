<?php
declare(strict_types=1);

namespace App\Frontend\Modules\News;

use App\lib\OCFram\BackController;
use App\lib\OCFram\HTTPRequest;
use App\lib\vendors\Entity\Comment;

class NewsController extends BackController
{
    /**
     * @param HTTPRequest $request
     */
    public function executeIndex(HTTPRequest $request): void
    {
        $nombreNews = $this->app->config()->get('nombre_news');
        $nombreCaracteres = $this->app->config()->get('nombre_caracteres');

        $this->page->addVar('title', 'Liste des ' . $nombreNews . 'dernières news.');

        $manager = $this->managers->getManagerOf('News');

        $listeNews = $manager->getList(0, $nombreNews);

        foreach ($listeNews as $news) {
            if (strlen($news['contenu']) > $nombreCaracteres) {
                $debut = substr($news['contenu'], 0, $nombreCaracteres);
                $debut = substr($debut, 0, strrpos($debut, ' ')). '...';

                $news->setContenu($debut);
            }
        }

        $this->page->addVar('listeNews', $listeNews);
    }

    /**
     * @param HTTPRequest $request
     */
    public function executeShow(HTTPRequest $request): void
    {
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));

        if (empty($news)) {
            $this->app->getHttpResponse()->redirect404();
        }

        $this->page->addVar('title', $news->titre());
        $this->page->addVar('news', $news);
        $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($news->id()));
    }

    public function executeInsertComment(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Ajout d\'un commentaire');

        if ($request->postExist('pseudo')) {
            $comment = new Comment;

            var_dump((int)$request->getData('news'));
            var_dump($request->postData('pseudo'));

            $comment->setNews((int)$request->getData('news'));
            $comment->setAuteur($request->postData('pseudo'));
            $comment->setContenu($request->postData('contenu'));

            if ($comment->isValid()) {
                $this->managers->getManagerOf('comments')->save($comment);
                //$this->app->user()->setFlash('Le commentaire a bien été ajouté');
                $this->app->getHttpResponse()->redirect('news-'.$request->getData('news').'.html');
            } else {
                $this->page->addVar('erreurs', $comment->erreurs());
            }

            $this->page->addVar('comment', $comment);
        }
    }
}