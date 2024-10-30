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
    protected $allowedFields    = ['name', 'strengh', 'constitution', 'agility', 'experience', 'level', 'created_at', 'updated_at', 'deleted_at', 'user_id'];


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

    public function updateCharacter($data)
    {
        return $this->update($data['id'], $data);
    }

    public function deleteCharacter($id)
    {
        return $this->delete($id);
    }

    public function getAllCharacterByUserID()
    {
        return $this->findAll();
    }

    public function getPaginatedCharacter($start, $length, $searchValue, $orderColumnName, $orderDirection)
    {
        $builder = $this->builder();

        // Recherche
        if ($searchValue != null) {
            $builder->like('name', $searchValue);
        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    public function getTotalCharacter()
    {
        $builder = $this->builder();
        return $builder->countAllResults();
    }

    public function getFilteredCharacter($searchValue)
    {
        $builder = $this->builder();

        // @phpstan-ignore-next-line
        if (! empty($searchValue)) {
            $builder->like('name', $searchValue);
        }

        return $builder->countAllResults();
    }

    public function getTotalCharacterById($id)
    {
        return $this->select('COUNT(*) AS total')->where(['id' => $id])->first();
    }
}
