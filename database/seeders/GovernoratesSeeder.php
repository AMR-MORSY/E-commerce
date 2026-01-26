<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GovernoratesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $governorates = [
            'القاهرة',
            'الجيزة',
            'الإسكندرية',
            'القليوبية',
            'الشرقية',
            'الدقهلية',
            'الغربية',
            'المنوفية',
            'البحيرة',
            'كفر الشيخ',
            'دمياط',
            'بورسعيد',
            'الإسماعيلية',
            'السويس',
            'الفيوم',
            'بني سويف',
            'المنيا',
            'أسيوط',
            'سوهاج',
            'قنا',
            'الأقصر',
            'أسوان',
            'البحر الأحمر',
            'الوادي الجديد',
            'مطروح',
            'شمال سيناء',
            'جنوب سيناء',
        ];

        foreach ($governorates as $gov) {
            Governorate::create([
                'name_ar' => $gov,
            ]);
        }
    }
}
