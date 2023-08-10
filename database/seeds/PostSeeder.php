<?php


use Phinx\Seed\AbstractSeed;

class PostSeeder extends AbstractSeed
{
    public function getDependencies(): array
    {
        return [
            'UserSeeder'
        ];
    }

    public function run(): void
    {
        $faker = Faker\Factory::create();
        $data = [];

        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'title' => $faker->sentence(3),
                'body' => $faker->paragraph(10),
                'user_id' => 1,
            ];
        }

        $this->insert('posts', $data);
    }
}
