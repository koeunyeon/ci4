<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Posts extends Migration
{
    public function up()
    {
        $this->forge->dropTable('posts', true);

        $this->forge->addField([
            'post_id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'author' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'content' => [
                'type' => 'LONGTEXT'
            ],
            'html_content' => [
                'type' => 'LONGTEXT'
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
        $this->forge->addKey('post_id', true);
        $this->forge->createTable('posts');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('posts');
    }
}
