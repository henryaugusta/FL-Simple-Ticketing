<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Discussion;
use App\Models\TicketCategory;
use App\Models\TicketModel;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create("id_ID");

        $this->addUser("Admin", "admin@email.com", "password","1");
        $this->addUser("user", "user@gmail.com", "password","3");
        $this->addUser("staff", "staff@gmail.com", "password","2");



        //4-54
        for ($i = 0; $i < 50; $i++) {
            try {
                $role = $faker->randomElement([2]);
                $this->addUser($faker->name, $faker->email, "password", $role);
            } catch (Exception $exception) {
                continue;
            }
        }

        //55-100
        for ($i = 0; $i < 50; $i++) {
            try {
                $role = $faker->randomElement([3]);
                $this->addUser($faker->name, $faker->email, "password", $role);
            } catch (Exception $exception) {
                continue;
            }
        }

        // for ($i=0; $i < 4000; $i++) { 
        //     $this->addTicket();
        // }

        $this->addCategory("Masalah Jaringan");
        $this->addCategory("Masalah Email");
        $this->addCategory("Masalah Laptop");
        $this->addCategory("Masalah Printer");
        $this->addCategory("Masalah Aplikasi");
        $this->addCategory("Masalah Lainnya");

    }

    public function addCategory($name){
        $data = new TicketCategory();
        $data->name = $name;
        $data->save();
    }

    public function addTicket()
    {
        $faker = Faker::create("id_ID");
        $user_role = $faker->randomElement([3]);

        // Jenis gangguan:Masalah jaringan,Masalah email,masalah laptop,masalah printer,masalah aplikasi, dan lainnya(
        $user_id = $faker->numberBetween($min = 55, $max = 100); // 8567
        $ticket_category = $faker->numberBetween($min = 1, $max = 6); // 8567

        $user = User::find($user_id);

        $object = new TicketModel();
        $object->sender_id = $user_id;
        $object->ticket_title = "Tidak Bisa Akses Internet ( Example Ticket )";
        $object->ticket_detail = "Tolong Gangguan Saya ( Example Ticket ) , Alamat ada di jalan $faker->address";
        $object->category = $ticket_category;
        $object->status = 3;

        if ($object->save()) {

            $objectdis = new Discussion();
            $objectdis->id_sender = $user_id;
            $objectdis->message = $object->ticket_detail;
            $objectdis->topic = $object->id;
            $objectdis->save();
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
