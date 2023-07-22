<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function change()
    {
        $users = $this->table('users');
        $users->addColumn('name', 'string', ['limit' => 80]);
        $users->addColumn('email', 'string', ['limit' => 80]);
        $users->addColumn('password', 'string', ['limit' => 100]);
        $users->addColumn('created_at', 'datetime');
        $users->addColumn('updated_at', 'datetime', ['null' => true]);
        $users->create();
    }
}
