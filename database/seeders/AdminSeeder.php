<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\TicketCategory;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->addUser("Admin", "admin@email.com", "password","1");
        $this->addUser("user", "user@gmail.com", "password","3");
        $this->addUser("staff", "staff@gmail.com", "password","2");


     

        $faker = Faker::create("id_ID");
        for ($i = 0; $i < 300; $i++) {
            try {
                $role = $faker->randomElement([2, 3]);
                $this->addUser($faker->name, $faker->email, "password",$role);
            } catch (Exception $exception) {
                continue;
            }
        }
    }




    public function addUser($name, $email, $password, $role)
    {
        $data = new User();
        $data->name = $name;
        $data->email = $email;
        $data->password = bcrypt($password);
        $data->role = $role;
        $data->save();
    }
}
