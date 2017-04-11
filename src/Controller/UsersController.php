<?php
/**
 * Created by PhpStorm.
 * User: romuald
 * Date: 11/04/2017
 * Time: 15:06
 */

namespace App\Controller;

use Cake\ORM\TableRegistry;

class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function index()
    {
        /*$articles = TableRegistry::get('Users');

        $query = $articles->find();

        foreach ($query as $row) {
            echo $row->username;
        }*/
        $users = $this->Users->find('all');
        var_dump($users);
        /*$this->set([
            'users' => $users,
            '_serialize' => ['users']
        ]);*/
    }

    public function view($id)
    {
        $recipe = $this->Recipes->get($id);
        $this->set([
            'recipe' => $recipe,
            '_serialize' => ['recipe']
        ]);
    }

    public function add()
    {
        $recipe = $this->Recipes->newEntity($this->request->getData());
        if ($this->Recipes->save($recipe)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'recipe' => $recipe,
            '_serialize' => ['message', 'recipe']
        ]);
    }

    public function edit($id)
    {
        $recipe = $this->Recipes->get($id);
        if ($this->request->is(['post', 'put'])) {
            $recipe = $this->Recipes->patchEntity($recipe, $this->request->getData());
            if ($this->Recipes->save($recipe)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

    public function delete($id)
    {
        $recipe = $this->Recipes->get($id);
        $message = 'Deleted';
        if (!$this->Recipes->delete($recipe)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }
}