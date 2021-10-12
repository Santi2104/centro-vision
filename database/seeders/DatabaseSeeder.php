<?php

namespace Database\Seeders;

use App\Models\Equipment;
use App\Models\Office;
use App\Models\OS;
use App\Models\Patient;
use App\Models\Practice;
use App\Models\PracticeGroup;
use App\Models\Professional;
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
         \App\Models\Role::factory()
         ->count(1)
         ->create([
             'name' => 'admin',
             'display_name' => 'Administrador'
         ]);
         \App\Models\Role::factory()
         ->count(1)
         ->create([
             'name' => 'paciente',
             'display_name' => 'Paciente'
         ]);
         \App\Models\Role::factory()
         ->count(1)
         ->create([
             'name' => 'profesional',
             'display_name' => 'Profesional'
         ]);

         \App\Models\Role::factory()
         ->count(1)
         ->create([
             'name' => 'admision',
             'display_name' => 'Admisión'
         ]);

        \App\Models\User::factory()
        ->count(1)
        ->create(['email' => 'admin@mail.com','role_id' => 1]);

        \App\Models\User::factory()
        ->count(1)
        ->create(['email' => 'admision@mail.com','role_id' => 4]);

        OS::factory()->times(1)->create([
            'codigo_os' => 'APOS',
            'razon_social' => 'APOS',
            'nombre_comercial' => 'APOS',
        ]);

        OS::factory()->times(1)->create([
            'codigo_os' => 'OSUNLAR',
            'razon_social' => 'OSUNLAR',
            'nombre_comercial' => 'OSUNLAR',
        ]);

        OS::factory()->times(1)->create([
            'codigo_os' => 'OSDE',
            'razon_social' => 'OSDE',
            'nombre_comercial' => 'OSDE',
        ]);

        \App\Models\User::factory()
        ->count(50)
        ->create(['role_id' => 2])
        ->each(function (\App\Models\User $user){
           Patient::factory()->create(['user_id' => $user->id,'o_s_id' => 1]);
        });

        \App\Models\User::factory()
        ->count(20)
        ->create(['role_id' => 3])
        ->each(function (\App\Models\User $user){
           Professional::factory()->create(['user_id' => $user->id]);
        });


        PracticeGroup::factory()->times(1)->create([
            'cod' => 'C',
            'description' => 'Consultas'
        ]);

        PracticeGroup::factory()->times(1)->create([
            'cod' => 'P',
            'description' => 'Practicas'
        ]);

        PracticeGroup::factory()->times(1)->create([
            'cod' => 'L',
            'description' => 'Laboratorio'
        ]);

        PracticeGroup::factory()->times(1)->create([
            'cod' => 'G',
            'description' => 'Cirugias'
        ]);

        PracticeGroup::factory()->times(1)->create([
            'cod' => 'O',
            'description' => 'Otros'
        ]);

        Practice::factory()->times(1)->create([
            'cod' => '420101',
            'description' => 'Consulta',
            'practice_group_id' => 1
        ]);

        Practice::factory()->times(1)->create([
            'cod' => '300119',
            'description' => 'FONDO DE OJO',
            'practice_group_id' => 2
        ]);

        Practice::factory()->times(1)->create([
            'cod' => '300125',
            'description' => 'REFRACTOMETRIA COMPUTARIZADA',
            'practice_group_id' => 2
        ]);

        Office::factory()->times(8)->create();

        Equipment::factory()->times(15)->create();


    }
}
