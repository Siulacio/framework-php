<?php


use Application\Libraries\BCrypt;
use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $bcrypt = new BCrypt();
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $bcrypt->hash_password('secret'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        $this->insert('users', $data);

    }
}
