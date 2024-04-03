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
            'bankroll_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'sport_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'competition_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'strategy_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'event' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
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
            'odd' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
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
        $this->forge->createTable('bets');
    }

    public function down()
    {
        $this->forge->dropTable('bets');
    }
}
