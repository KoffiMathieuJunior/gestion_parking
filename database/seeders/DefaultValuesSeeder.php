<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DefaultValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('statuts')->insert([
            ['code' => 'INACTIF', 'libelle' => 'Inactif'],
            ['code' => 'SUSPENDU', 'libelle' => 'Suspendu'],
            ['code' => 'INACTIF', 'libelle' => 'Inactif'],
            ['code' => 'ACTIF', 'libelle' => 'Actif'],
            ['code' => 'HORS_SERVICE', 'libelle' => 'Hors service'],
        ]);
        DB::table('type_users')->insert([
            ['code' => 'UTILISATEUR', 'libelle' => 'Utilisateur'],
            ['code' => 'PROPRIETAIRE', 'libelle' => 'Proprietaire'],
            ['code' => 'CLIENT', 'libelle' => 'Client'],
            ['code' => 'ADMIN', 'libelle' => 'Admin'],
            ['code' => 'PERSONNEL', 'libelle' => 'Personnel'],
        ]);
    }
}
