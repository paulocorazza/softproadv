<?php

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    private $user;
    private $profile;

    private function createProfile()
    {
        $this->profile = Profile::create([
            'name'  => 'Admin',
            'label' => 'Administrador'
        ]);
    }

    private function createUser()
    {
        $this->user = User::create([
            'name'      => 'Suporte',
            'fantasy'   => 'Suporte',
            'email'     => 'suporte@theplace.com.br',
            'password'  => bcrypt('pl4c32k')
        ]);
    }

    private function sync()
    {
        $admin = $this->user->where('name', 'Suporte')->first();

        $admin->profiles()->save($this->profile);
    }

    private function createPermissions()
    {
        $path =  storage_path('app/public/files_sql/permissions.sql');
          DB::unprepared(file_get_contents($path));
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Desabilitas as FKs
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('profile_user')->truncate();
        DB::table('profiles')->truncate();
        DB::table('users')->truncate();

        DB::table('permission_profile')->truncate();
        DB::table('permissions')->truncate();

        $this->createProfile();
        $this->createUser();
        $this->sync();

        $this->createPermissions();

        // Habilitas as FKs
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
