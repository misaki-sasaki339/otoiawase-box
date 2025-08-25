<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Category;

class ContactFactory extends Factory
{
    protected $model = Contact::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $categoryIds;

        if(!$categoryIds){
            $categoryIds = Category::pluck('id')->toArray();
        }

        return [
            'first_name' => $this->faker->firstName,
            'category_id'=>$this->faker->randomElement($categoryIds),
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElement([1,2,3]),
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->numerify('090########'),
            'address' => '東京都渋谷区渋谷' . $this->faker->numerify('#丁目##-##'),
            'building' => $this->faker->optional()->randomElement([
                'パークハイツ',
                'ペンギンズマンション',
                'コンフォート',
                'トラストタワー',
                'サンシャインビュー'
            ]) . ' ' . $this->faker->numerify('###号室'),
            'detail' => $this->faker->realText(100),
        ];
    }
}
