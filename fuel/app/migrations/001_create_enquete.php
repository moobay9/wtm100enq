<?php

namespace Fuel\Migrations;

class Create_Enquetes
{
    public function up()
    {
        \DBUtil::create_table('enquetes', [
            'id'         => ['constraint' => 11,   'type' => 'int', 'auto_increment' => true, 'unsigned' => true, 'comment' => 'ID'],
            'name'       => ['constraint' => 200,  'type' => 'varchar', 'null'       => true, 'comment'  => '名前'],
            'best'       => ['constraint' => 2,    'type' => 'tinyint', 'null'       => true, 'comment'  => 'best session'],
            'remarks'    => ['constraint' => 2000, 'type' => 'text', 'null'          => true, 'comment'  => '感想'],
            'created_at' => ['constraint' => 11,   'type' => 'int', 'null'           => true, 'comment'  => '登録日時'],
            'updated_at' => ['constraint' => 11,   'type' => 'int', 'null'           => true, 'comment'  => '更新日時'],
        ], ['id'], true, 'InnoDB', 'utf8_general_ci');
    }

    public function down()
    {
        \DBUtil::drop_table('enquetes');
    }
}
