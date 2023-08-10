<?php


use Phinx\Migration\AbstractMigration;

class CreatePostsTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('posts');
        $table
            ->addColumn('title', 'string')
            ->addColumn('body', 'text')
            ->addColumn('user_id', 'integer')
            ->addForeignKey('user_id', 'users', ['id'])
            ->create();
    }
}
