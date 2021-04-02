<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SampleEntity extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'sample_entity_id'          => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'person_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '40',
            ],
            'age' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'login_pw' => [
                'type' => 'VARCHAR',
                'constraint' => '256'
            ]

        ]);
        $this->forge->addKey('sample_entity_id', true);
        $this->forge->createTable('sample_entity');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('sample_entity');
    }
}