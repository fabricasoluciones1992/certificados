<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\User;
use App\models\People;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        \App\Models\TypeContracts::factory()->create([
            'type_contract' => 'Por definir',
        ]);
        \App\Models\TypeContracts::factory()->create([
            'type_contract' => 'Término Fijo',
        ]);
        \App\Models\TypeContracts::factory()->create([
            'type_contract' => 'Término Indefinido',
        ]);
        \App\Models\TypeContracts::factory()->create([
            'type_contract' => 'Obra o labor',
        ]);
        \App\Models\TypeContracts::factory()->create([
            'type_contract' => 'Aprendizaje',
        ]);
        \App\Models\Role::factory()->create([
            'role' => 'Por definir',
        ]);
        \App\Models\Role::factory()->create([
            'role' => 'Administrativos',
        ]);
        \App\Models\Role::factory()->create([
            'role' => 'Docentes planta',
        ]);
        \App\Models\Role::factory()->create([
            'role' => 'Docentes cátedra',
        ]);
        \App\Models\Role::factory()->create([
            'role' => 'Aprendices',
        ]);
        \App\Models\Role::factory()->create([
            'role' => 'Talleristas bienestar',
        ]);
        \App\Models\Document::factory()->create([
            'type' => 'Por definir',
        ]);
        \App\Models\Document::factory()->create([
            'type' => 'Tarjeta de Identidad',
        ]);
        \App\Models\Document::factory()->create([
            'type' => 'Cédula de Ciudadanía',
        ]);
        \App\Models\Document::factory()->create([
            'type' => 'Tarjeta de Extranjeria',
        ]);
        \App\Models\Document::factory()->create([
            'type' => 'Pasaporte',
        ]);
        \App\Models\Document::factory()->create([
            'type' => 'Permiso especial de permanencia',
        ]);
        //$this->call( Usersseeder::class);
        //$this->call( Peopleseeder::class);
        //\App\Models\Certificates::factory(5)->create();
    }
}
