<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CharacterModel;
use CodeIgniter\HTTP\ResponseInterface;

class Character extends BaseController
{
    public function getindex($id = null)
    {
        if ($id) {
            $this->title = "modifier un personnage";
            $character = model("CharacterModel")->getCharacterById($id);
            return $this->view('admin/character/character', ['character' => $character ], true);
        } else {
            $ch = model('CharacterModel')->getAllCharacterByUserID();
            return $this->view('admin/character/index', ['character' => $ch], true);
        }
    }

    public function postcreate()
    {
        $data = $this->request->getPost();
        $ch = model('CharacterModel');
        $newcharacter = $ch->createCharacter($data);
        if ($newcharacter) {
            $this->success("Le personnage à bien été créé");
            return $this->redirect('admin/character');
        } else {
            $this->error("Une erreur est survenue");
            return $this->redirect('admin/character');
        }
    }
    public function postupdate()
    {
        $data = $this->request->getPost();
        if(model('CharacterModel')->updateCharacter($data)) {
            $this->success("Personnage modifié");
        } else {
            $this->error("Erreur lors de la modification");
        }
        $this->redirect("admin/character");
    }

    public function getdelete($id)
    {
        if (model("CharacterModel")->deleteCharacter($id)) {
            $this->success("Personnage supprimé");
        } else {
            $this->error("Erreur lors de la suppression");
        }
        $this->redirect("admin/character");
    }

    public function gettotalcharacterbyid() {
        $id = $this->request->getGet("id");
        $character = model("CharacterModel");
        return json_encode($character->getTotalCharacterById($id));
    }

    public function postSearchCharacter()
    {
        $CharacterModel = model('App\Models\CharacterModel');

        // Paramètres de pagination et de recherche envoyés par DataTables
        $draw        = $this->request->getPost('draw');
        $start       = $this->request->getPost('start');
        $length      = $this->request->getPost('length');
        $searchValue = $this->request->getPost('search')['value'];

        // Obtenez les informations sur le tri envoyées par DataTables
        $orderColumnIndex = $this->request->getPost('order')[0]['column'] ?? 0;
        $orderDirection = $this->request->getPost('order')[0]['dir'] ?? 'asc';
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['data'] ?? 'id';


        // Obtenez les données triées et filtrées
        $data = $CharacterModel->getPaginatedCharacter($start, $length, $searchValue, $orderColumnName, $orderDirection);

        // Obtenez le nombre total de lignes sans filtre
        $totalRecords = $CharacterModel->getTotalCharacter();

        // Obtenez le nombre total de lignes filtrées pour la recherche
        $filteredRecords = $CharacterModel->getFilteredCharacter($searchValue);

        $result = [
            'draw'            => $draw,
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data'            => $data,
        ];
        return $this->response->setJSON($result);
    }
}
