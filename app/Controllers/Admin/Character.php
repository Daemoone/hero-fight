<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Character extends BaseController
{
    public function getindex($id = null)
    {
        if ($id) {
            $this->title = "modifier un personnage";
            $cm = model("CharacterModel")->getCharacterById($id);
            return $this->view('admin/character/index', ['character' => $cm], true);
        }
        return $this->view('admin/character/index', [], true);

    }
}
