<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Building\Model\Building;
use Modules\Organization\Model\Organization;
use Random\RandomException;

class BuildingNearestCoordsSeeder extends Seeder
{
    /**
     * @throws RandomException
     */
    public function run(): void
    {
        // Координаты центра Москвы
        $lat = 55.7558;
        $lng = 37.6176;

        for ($i = 0; $i < 20; $i++) {
            // Случайное смещение в метрах (-50км ... +50км)
            $offsetNorth = random_int(-50000, 50000); // север-юг
            $offsetEast = random_int(-50000, 50000);  // восток-запад

            // Конвертируем смещение в градусы
            $lat = $lat + ($offsetNorth / 111000); // 111 км ≈ 1 градус широты
            $lng = $lng + ($offsetEast / (111000 * cos(deg2rad($lat))));

            // Убеждаемся, что координаты валидны
            $lat = max(-90, min(90, $lat));
            $lng = max(-180, min(180, $lng));

            Building::factory()
                ->has(Organization::factory())
                ->create([
                    'address'   => "Тестовое здание #$i (рядом с Москвой)",
                    'latitude'  => $lat,
                    'longitude' => $lng,
                ]);
        }

        $this->command->info('Добавлено 20 зданий рядом с Москвой для тестирования геопоиска.');
    }
}