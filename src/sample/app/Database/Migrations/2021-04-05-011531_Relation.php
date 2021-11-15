<?php namespace App\Database\Migrations;


use CodeIgniter\Database\Migration;


class Relation extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'sample_parent_id'          => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'parent_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '40',
            ]
        ]);
        $this->forge->addKey('sample_parent_id', true);
        $this->forge->createTable('sample_parent');

        $this->forge->reset();
        $this->forge->addField([
            'sample_child_id'          => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sample_parent_id'       => [
                'type'       => 'BIGINT',
                'unsigned'       => true,
            ],
            'child_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '40',
            ]
        ]);
        $this->forge->addKey('sample_child_id', true);
        $this->forge->addForeignKey('sample_parent_id', 'sample_parent', 'sample_parent_id');
        $this->forge->createTable('sample_child');


    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('sample_child');
        $this->forge->dropTable('sample_parent');
    }
}