<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableCharacters extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true, //chiffre positif
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'strengh' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,

            ],
            'constitution' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'agility' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'experience' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'level' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'default' => 1,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'user', 'id');
        $this->forge->createTable('character');
    }

    public function down()
    {
        $this->forge->dropTable('character');
    }
}
