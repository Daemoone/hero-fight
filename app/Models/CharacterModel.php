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
        $builder->join('user_permission', 'user.id_permission = user_permission.id', 'left');
        $builder->join('media', 'user.id = media.entity_id AND media.entity_type = "user"', 'left');
        $builder->select('user.*, user_permission.name as permission_name, media.file_path as avatar_url');

        // Recherche
        if ($searchValue != null) {
            $builder->like('username', $searchValue);
            $builder->orLike('email', $searchValue);
            $builder->orLike('user_permission.name', $searchValue);
        }

        // Tri
        if ($orderColumnName && $orderDirection) {
            $builder->orderBy($orderColumnName, $orderDirection);
        }

        $builder->limit($length, $start);

        return $builder->get()->getResultArray();
    }

    public function getTotalUser()
    {
        $builder = $this->builder();
        $builder->join('user_permission', 'user.id_permission = user_permission.id');
        return $builder->countAllResults();
    }

    public function getFilteredUser($searchValue)
    {
        $builder = $this->builder();
        $builder->join('user_permission', 'user.id_permission = user_permission.id', 'left');
        $builder->join('media', 'user.id = media.entity_id AND media.entity_type = "user"', 'left');
        $builder->select('user.*, user_permission.name as permission_name, media.file_path as avatar_url');

        // @phpstan-ignore-next-line
        if (! empty($searchValue)) {
            $builder->like('username', $searchValue);
            $builder->orLike('email', $searchValue);
            $builder->orLike('user_permission.name', $searchValue);
        }

        return $builder->countAllResults();
    }
}
