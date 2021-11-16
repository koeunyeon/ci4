<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Member extends Migration
{
   public function up()
   {
        $this->forge->dropTable('members', true);

        $this->forge->addField([
            'member_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'social_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'identifier' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'member_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,

            ],
            'created_at' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
            ],
            'updated_at' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
            ],
            'deleted_at' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('member_id', true);
        $this->forge->createTable('members');
   }

   //--------------------------------------------------------------------

   public function down()
   {
      //
   }
}