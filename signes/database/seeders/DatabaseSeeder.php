<?php

namespace Database\Seeders;

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
        $this->call([
            SecteurSeeder::class,
            CategorieSeeder::class,
            EtabDelosSeeder::class,
            EtabSadSeeder::class,
            SectionSeeder::class,
            RubriqueSeeder::class,
            OptionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
