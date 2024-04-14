<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableMatches extends Migration
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
            'bet_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'event' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'odd' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
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
        $this->forge->addForeignKey('bet_id', 'bets', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('matches');
    }

    public function down()
    {
        $this->forge->dropTable('matches');
    }
}
