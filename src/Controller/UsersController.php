<?php

namespace App\Controller;

class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function index()
    {
        $users = $this->Users->find('all');
        echo json_encode($users);
        $this->autoRender = false;
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        echo json_encode($user);
        $this->autoRender = false;
    }

    public function add()
    {
        $user = $this->Users->newEntity($this->request->getData());
        if ($this->Users->save($user)) {
            echo 'Enregistrement : '.json_encode($user);
        } else {
            echo 'Erreur';
        }
        $this->autoRender = false;
    }

    public function edit($id)
    {
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'put'])) {// TRES IMPORTANT QUE LES DONNEES SOIT EN x-www-form-urlencoded
            $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                echo 'Mise a jour : '.json_encode($user);
            } else {
                echo 'Erreur';
            }
        }
        $this->autoRender = false;
    }

    public function delete($id)
    {
        $user = $this->Users->get($id);
        if (!$this->Users->delete($user)) {
            echo 'Erreur';
        }
        echo 'Suppression : '.json_encode($user);
        $this->autoRender = false;
    }
}