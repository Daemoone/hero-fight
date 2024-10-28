<?php

namespace App\Models;

use CodeIgniter\Model;

class CharacterModel extends Model
{
    protected $table            = 'character';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'strengh', 'constitution', 'agility', 'experience', 'level', 'created_at', 'updated_at', 'deleted_at'];


    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getCharacterById($id)
    {
        return $this->find($id);
    }

    public function createCharacter($data)
    {
        return $this->insert($data);
    }

    public function updateCharacter($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCharacter($id)
    {
        return $this->delete($id);
    }
}
