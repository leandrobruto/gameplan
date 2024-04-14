<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTebleBets extends Migration
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
            'bankroll_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'sport_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true,
            ], 
            'competition_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true,
            ],
            'strategy_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true,
            ],
            'code' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'date' => [
                'type' => 'DATE',
            ],
            'stake' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'result' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'is_pending' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => false,
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

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('bankroll_id', 'bankrolls', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sport_id', 'sports', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('competition_id', 'competitions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('strategy_id', 'strategies', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bets');
    }

    public function down()
    {
        $this->forge->dropTable('bets');
    }
}
