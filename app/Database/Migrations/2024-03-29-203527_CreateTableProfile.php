<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableProfiles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],

            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'cpf' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'avatar' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
            ],
            'default_stake' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'default_date_range_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'default_sport_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
        ]);

        $this->forge->addPrimaryKey('id')->addUniqueKey('cpf');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('default_date_range_id', 'date_ranges', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('default_sport_id', 'sports', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('profiles');
    }

    public function down()
    {
        $this->forge->dropTable('profiles');
    }
}
