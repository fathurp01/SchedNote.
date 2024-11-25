<?php

namespace Database\Factories;

use App\Models\ScheduleElement;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleElementFactory extends Factory
{
    protected $model = ScheduleElement::class;

    public function definition()
    {
        return [
            'schedule_id' => Schedule::factory(),
            'element_type' => $this->faker->randomElement(['Location', 'Sub-task', 'Other']), // Menyediakan nilai untuk 'element_type'
            'element_content' => $this->faker->sentence, // Menyediakan nilai untuk 'element_content'
        ];
    }
}

