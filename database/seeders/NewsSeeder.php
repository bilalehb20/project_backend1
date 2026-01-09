<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsItems = [
            [
                'title' => 'Nieuwe iPhone 15 Pro Max nu beschikbaar',
                'content' => 'De langverwachte iPhone 15 Pro Max is nu verkrijgbaar in onze webshop. Deze premium telefoon beschikt over de krachtige A17 Pro chip, een 48MP ProRAW camera systeem en een prachtig Titanium design. Bestel vandaag nog en krijg gratis bezorging!',
                'search_term' => 'iphone 15 pro max',
                'brand' => 'Apple',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Samsung Galaxy S24 Ultra: Review en eerste indrukken',
                'content' => 'Onze tech experts hebben de Samsung Galaxy S24 Ultra uitgebreid getest. Deze krachtige Android telefoon beschikt over de S Pen, een indrukwekkende 200MP camera en de nieuwste Snapdragon 8 Gen 3 processor. Lees onze volledige review voor alle details.',
                'search_term' => 'samsung galaxy s24 ultra',
                'brand' => 'Samsung',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Google Pixel 8 Pro: Beste camera telefoon van 2024',
                'content' => 'De Google Pixel 8 Pro heeft opnieuw bewezen waarom het de beste camera telefoon is. Met geavanceerde AI features en Magic Eraser technologie maak je perfecte foto\'s. Ontdek nu de speciale aanbieding in onze webshop!',
                'search_term' => 'google pixel 8 pro',
                'brand' => 'Google',
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Black Friday deals: Tot 30% korting op smartphones',
                'content' => 'Maak gebruik van onze exclusieve Black Friday aanbiedingen! Ontvang tot 30% korting op geselecteerde smartphones van Apple, Samsung en Google. Actie geldig zolang de voorraad strekt. Bestel snel en bespaar!',
                'search_term' => 'smartphone',
                'brand' => null,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Xiaomi 14 Pro nu in voorverkoop',
                'content' => 'Wees er snel bij! De Xiaomi 14 Pro is nu beschikbaar in voorverkoop. Deze feature-rijke telefoon beschikt over de nieuwste Snapdragon 8 Gen 3 chip, een 120W snelle lader en een prachtig 120Hz OLED scherm. Reserveer nu en ontvang 50 euro korting!',
                'search_term' => 'xiaomi 14 pro',
                'brand' => 'Xiaomi',
                'published_at' => now()->subDays(3),
            ],
        ];

        foreach ($newsItems as $newsData) {
            $searchTerm = $newsData['search_term'];
            $brand = $newsData['brand'] ?? null;
            unset($newsData['search_term'], $newsData['brand']);
            
            // Haal afbeelding op via API
            $imagePath = $this->getNewsImage($searchTerm, $brand);
            
            $newsData['image'] = $imagePath;
            
            News::create($newsData);
        }
        
        $this->command->info("✅ News items geïmporteerd met afbeeldingen");
    }

    /**
     * Haal nieuwsafbeelding op via API
     */
    private function getNewsImage(string $searchTerm, ?string $brand = null): ?string
    {
        try {
            // Probeer via DummyJSON products API - smartphones categorie
            $response = Http::timeout(10)->get('https://dummyjson.com/products/category/smartphones', [
                'limit' => 100
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (!empty($data['products'])) {
                    // Zoek naar product met gelijkende naam
                    foreach ($data['products'] as $product) {
                        $title = Str::lower($product['title'] ?? '');
                        $searchLower = Str::lower($searchTerm);
                        
                        // Check of titel zoekterm bevat
                        if (Str::contains($title, $searchLower) || 
                            ($brand && Str::contains($title, Str::lower($brand)))) {
                            // Gebruik de eerste afbeelding (meestal de beste)
                            $imageUrl = $product['images'][0] ?? $product['thumbnail'] ?? null;
                            if ($imageUrl) {
                                return $this->downloadImage($imageUrl, 'news-' . time() . rand(1000, 9999));
                            }
                        }
                    }
                    
                    // Als geen exacte match, probeer met merk
                    if ($brand) {
                        foreach ($data['products'] as $product) {
                            $title = Str::lower($product['title'] ?? '');
                            if (Str::contains($title, Str::lower($brand))) {
                                $imageUrl = $product['images'][0] ?? $product['thumbnail'] ?? null;
                                if ($imageUrl) {
                                    return $this->downloadImage($imageUrl, 'news-' . time() . rand(1000, 9999));
                                }
                            }
                        }
                    }
                    
                    // Fallback: gebruik eerste smartphone afbeelding
                    $randomProduct = $data['products'][0];
                    $imageUrl = $randomProduct['images'][0] ?? $randomProduct['thumbnail'] ?? null;
                    if ($imageUrl) {
                        return $this->downloadImage($imageUrl, 'news-' . time() . rand(1000, 9999));
                    }
                }
            }
            
            // Als smartphones niet werkt, probeer algemene search
            $response = Http::timeout(10)->get('https://dummyjson.com/products/search', [
                'q' => $searchTerm,
                'limit' => 5
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (!empty($data['products'][0])) {
                    $imageUrl = $data['products'][0]['images'][0] ?? $data['products'][0]['thumbnail'] ?? null;
                    if ($imageUrl) {
                        return $this->downloadImage($imageUrl, 'news-' . time() . rand(1000, 9999));
                    }
                }
            }
        } catch (\Exception $e) {
            // API faalt, gebruik geen afbeelding
        }

        return null;
    }

    /**
     * Download afbeelding en sla lokaal op
     */
    private function downloadImage(string $url, string $filename): ?string
    {
        try {
            $imageResponse = Http::timeout(10)->get($url);
            
            if (!$imageResponse->successful() || empty($imageResponse->body())) {
                return null;
            }

            $imageContent = $imageResponse->body();

            // Bepaal bestandsextensie
            $extension = 'jpg';
            $parsedUrl = parse_url($url);
            $path = $parsedUrl['path'] ?? '';
            
            if (Str::contains($path, '.png')) {
                $extension = 'png';
            } elseif (Str::contains($path, '.webp')) {
                $extension = 'webp';
            } elseif (Str::contains($path, '.gif')) {
                $extension = 'gif';
            }

            // Genereer unieke bestandsnaam
            $filepath = 'news/' . Str::slug($filename) . '.' . $extension;
            
            // Zorg dat directory bestaat
            Storage::disk('public')->makeDirectory('news');
            
            // Sla op in public storage
            Storage::disk('public')->put($filepath, $imageContent);
            
            return $filepath;
        } catch (\Exception $e) {
            return null;
        }
    }
}
