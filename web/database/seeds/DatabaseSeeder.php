<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FacultadesTableSeeder::class);
        $this->call(CarrerasTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EventosTableSeeder::class);
        $this->call(BolsaTrabajoTableSeeder::class);
        $this->call(AnunciosTableSeeder::class);
        $this->call(TutoriasTableSeeder::class);
        $this->call(AlquilerHospedajeTableSeeder::class);
    }
}
