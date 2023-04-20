<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Google\Client;
use Google\Service\Books;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = new Client();
        $client->setDeveloperKey('AIzaSyCXitozlkM6Wnsxgk7qKR96VrY04ueNt1I');

        $service = new Books($client);
        $optParams = array('maxResults' => 40);
        $results = $service->volumes->listVolumes('subject', $optParams);

        $categories = [];
        $existingCategories = [];

        foreach ($results as $item) {
            $category = $item->getVolumeInfo()->getCategories()[0] ?? 'Sin categoría';
            if (!in_array($category, $existingCategories)) {
                $categories[] = $category;
                $existingCategories[] = $category;
            }
        }

        foreach ($categories as $category) {
            Category::create(['name' => $category, 'slug' => Str::slug($category)]);
        }
    }
}
