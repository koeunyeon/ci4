<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rich extends Migration
{
    public function up()
    {        
        $this->forge->addField([
            'sample_rich_id'          => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '40',
            ],
            'age' => [
                'type' => 'INT',
                'null' => true,
            ],
            'created_at' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
            'updated_at' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
            'deleted_at' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ]
        ]);

        $this->forge->addKey('sample_rich_id', true);
        $this->forge->createTable('sample_rich');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('sample_rich');
    }
}
