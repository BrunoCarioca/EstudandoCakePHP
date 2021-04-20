<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

class ArticlesController extends AppController
{
    public function initialize(): void 
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
    }

    public function index()
    {
        $articleslist = $this->Paginator->paginate($this->Articles->find());
       
        $this->Authorization->skipAuthorization();
        $this->set(compact('articleslist'));
    }

    public function view($slug = null)
    {
        $article = $this->Articles
            ->findBySlug($slug)
            ->contain('Tags')
            ->firstOrFail();
        $this->Authorization->skipAuthorization();
        $this->set(compact('article'));
    }

    public function add()
    {
        $article = $this->Articles->newEmptyEntity(); 
        $this->Authorization->authorize($article);

        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article,
            $this->request->getData());

            $article->user_id = $this->request->getAttribute('identity')->getIdentifier();

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Seu artigo foi salvo!'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possivel adicionar o artigo!'));
        }
        // Get a list of tags.
        $tags = $this->Articles->Tags->find('list')->all();

        // Set tags to the view context
        $this->set('tags', $tags);
        $this->set('article', $article);
    }

    public function edit($slug)
    {
        $article = $this->Articles
            ->findBySlug($slug)
            ->contain('Tags')
            ->firstOrFail();
        $this->Authorization->authorize($article);
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData(), [
                'accessibleFields' => ['user_id' => false]
            ]);
            
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Seu artigo foi atualizado!'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possivel atualizar o artigo!'));
        }

        // Get a list of tags. 
        $tags = $this->Articles->Tags->find('list')->all();

        // Set tags to the view context
        $this->set('tags', $tags);
      
        $this->set('article', $article);
       

    }

    public function delete($slug)
    {
        
        
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->findBySlug($slug)->firstOrFail(); 
        $this->Authorization->authorize($article);
        
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('O {0} artigo foi deletado!', $article->title));
            return $this->redirect(['action' => 'index']);
        }
       
    }

    public function tags()
    {
        $tags = $this->request->getParam('pass');
        $this->Authorization->skipAuthorization();

        $articles = $this->Articles->find('tagged', [
            'tags' => $tags
            ])
            ->all();

        $this->set([
            'articles' => $articles,
            'tags' => $tags
        ]);

    }       
   
}
