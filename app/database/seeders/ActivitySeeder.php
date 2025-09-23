<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** Еда и подкатегории */
        DB::table('activities')->insertOrIgnore(
            [
                'id'        => 1,
                'name'      => 'Еда',
                'parent_id' => null,
            ]
        );

        DB::table('activities')->insertOrIgnore(
            [
                'id'        => 2,
                'name'      => 'Мясная продукция',
                'parent_id' => 1,
            ]
        );

        DB::table('activities')->insertOrIgnore(
            [
                'id'        => 3,
                'name'      => 'Молочная продукция',
                'parent_id' => 1,
            ]
        );

        DB::table('activities')->insertOrIgnore(
            [
                'id'        => 4,
                'name'      => 'Йогурты',
                'parent_id' => 3,
            ]
        );

        /** Автомобили и подкатегории */
        DB::table('activities')->insertOrIgnore(
            [
                'id'        => 5,
                'name'      => 'Автомобили',
                'parent_id' => null,
            ]
        );

        DB::table('activities')->insertOrIgnore(
            [
                'id'        => 6,
                'name'      => 'Грузовые',
                'parent_id' => 5,
            ]
        );

        DB::table('activities')->insertOrIgnore(
            [
                'id'        => 7,
                'name'      => 'Легковые',
                'parent_id' => 5,
            ]
        );

        DB::table('activities')->insertOrIgnore(
            [
                'id'        => 8,
                'name'      => 'Запчасти',
                'parent_id' => 7,
            ]
        );

        DB::table('activities')->insertOrIgnore(
            [
                'id'        => 9,
                'name'      => 'Аксессуары',
                'parent_id' => 7,
            ]
        );
    }
}
