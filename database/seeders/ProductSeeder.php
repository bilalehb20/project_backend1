<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    private $brandMapping = [
        'Apple' => ['apple', 'iphone'],
        'Samsung' => ['samsung', 'galaxy'],
        'Google' => ['google', 'pixel'],
        'Xiaomi' => ['xiaomi', 'redmi', 'mi '],
        'OnePlus' => ['oneplus', 'one plus'],
        'Huawei' => ['huawei', 'honor'],
        'Sony' => ['sony', 'xperia'],
        'Nokia' => ['nokia'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $smartphoneCategory = Category::where('name', 'Smartphones')->firstOrCreate(['name' => 'Smartphones']);
        $accessoriesCategory = Category::where('name', 'Accessoires')->firstOrCreate(['name' => 'Accessoires']);
        $customCasesCategory = Category::where('name', 'Aangepaste Hoesjes')->firstOrCreate(['name' => 'Aangepaste Hoesjes']);
        $mangaEditionCategory = Category::where('name', 'Manga Editie & Meer')->firstOrCreate(['name' => 'Manga Editie & Meer']);

        // Seed smartphones (minimaal 6 per merk)
        $this->seedSmartphones($smartphoneCategory);
        
        // Seed accessoires
        $this->seedAccessories($accessoriesCategory);
        
        // Seed aangepaste hoesjes (gewone hoesjes)
        $this->seedCustomCases($customCasesCategory);
        
        // Seed manga editie & meer (speciale editie hoesjes)
        $this->seedMangaEdition($mangaEditionCategory);
    }

    /**
     * Seed smartphones - minimaal 6 per merk
     */
    private function seedSmartphones(Category $category): void
    {
        $this->command->info("📱 Seeding smartphones...");

        $smartphoneProducts = [
            // Apple - 8 producten
            ['Apple', 'iPhone 15 Pro Max', 'De nieuwste flagship iPhone met A17 Pro chip, 48MP camera systeem, Titanium behuizing en Dynamic Island.', 1299.99],
            ['Apple', 'iPhone 15 Pro', 'Premium iPhone met A17 Pro chip, ProRAW camera, en ProMotion 120Hz display.', 1199.99],
            ['Apple', 'iPhone 15', 'Populaire iPhone met A16 Bionic chip, 48MP camera en Dynamic Island.', 899.99],
            ['Apple', 'iPhone 15 Plus', 'Grote versie van iPhone 15 met langere batterijduur.', 999.99],
            ['Apple', 'iPhone 14 Pro', 'Vorige generatie Pro model met A16 chip en Action Mode.', 999.99],
            ['Apple', 'iPhone 14', 'Betrouwbare iPhone met A15 Bionic chip en verbeterde camera.', 749.99],
            ['Apple', 'iPhone 13', 'Bewezen performer met A15 chip en uitstekende camera.', 649.99],
            ['Apple', 'iPhone SE (3e generatie)', 'Compacte en betaalbare iPhone met A15 Bionic chip.', 529.99],

            // Samsung - 8 producten
            ['Samsung', 'Galaxy S24 Ultra', 'Krachtige Android telefoon met S Pen, 200MP camera en Snapdragon 8 Gen 3.', 1199.99],
            ['Samsung', 'Galaxy S24+', 'Premium Samsung met groot scherm en uitstekende camera.', 999.99],
            ['Samsung', 'Galaxy S24', 'Compacte flagship met Snapdragon 8 Gen 3 en AI functies.', 849.99],
            ['Samsung', 'Galaxy Z Fold 5', 'Premium foldable telefoon met groot inklapbaar scherm.', 1799.99],
            ['Samsung', 'Galaxy Z Flip 5', 'Compacte foldable telefoon die opvouwt als flip phone.', 999.99],
            ['Samsung', 'Galaxy A54', 'Populaire mid-range telefoon met goede camera.', 449.99],
            ['Samsung', 'Galaxy S23 FE', 'Fan Edition met goede prijs-kwaliteit verhouding.', 699.99],
            ['Samsung', 'Galaxy A34', 'Betaalbare telefoon met AMOLED scherm.', 349.99],

            // Google - 6 producten
            ['Google', 'Pixel 8 Pro', 'Beste camera telefoon met Google Tensor G3 chip en Magic Editor.', 999.99],
            ['Google', 'Pixel 8', 'Compacte Pixel met uitstekende camera kwaliteit en AI functies.', 699.99],
            ['Google', 'Pixel 7a', 'Betaalbare Pixel met Google Tensor G2 chip.', 449.99],
            ['Google', 'Pixel 7 Pro', 'Vorige generatie Pro model met telefoon camera.', 899.99],
            ['Google', 'Pixel 7', 'Bewezen performer met Tensor G2 en Night Sight.', 599.99],
            ['Google', 'Pixel 6a', 'Betaalbare Pixel met Tensor chip.', 399.99],

            // Xiaomi - 6 producten
            ['Xiaomi', 'Xiaomi 14 Pro', 'Feature-rijke telefoon met Snapdragon 8 Gen 3 en snelle lader.', 899.99],
            ['Xiaomi', 'Xiaomi 13T Pro', 'Betaalbare flagship met Leica camera systeem.', 699.99],
            ['Xiaomi', 'Xiaomi 13T', 'Goede prijs-kwaliteit verhouding met MediaTek chip.', 599.99],
            ['Xiaomi', 'Redmi Note 13 Pro', 'Betaalbare telefoon met 120Hz scherm en snelle lader.', 399.99],
            ['Xiaomi', 'Xiaomi 12T', 'Snelle telefoon met MediaTek Dimensity 8100 Ultra.', 549.99],
            ['Xiaomi', 'Redmi Note 12 Pro', 'Populaire mid-range telefoon met goede camera.', 349.99],

            // OnePlus - 6 producten
            ['OnePlus', 'OnePlus 12', 'Snelle telefoon met 100W charging en OxygenOS.', 899.99],
            ['OnePlus', 'OnePlus 11', 'Voorgaande generatie met uitstekende prijs-kwaliteit.', 699.99],
            ['OnePlus', 'OnePlus Nord 3', 'Mid-range telefoon met MediaTek Dimensity 9000.', 499.99],
            ['OnePlus', 'OnePlus 10T', 'Snelle performer met 150W charging.', 599.99],
            ['OnePlus', 'OnePlus Nord CE 3', 'Betaalbare optie met goede specificaties.', 399.99],
            ['OnePlus', 'OnePlus 9 Pro', 'Vorige flagship met Hasselblad camera.', 799.99],

            // Huawei - 6 producten
            ['Huawei', 'Huawei P60 Pro', 'Premium telefoon met geavanceerde camera technologie.', 999.99],
            ['Huawei', 'Huawei Mate 50 Pro', 'Business telefoon met lange batterijduur.', 1099.99],
            ['Huawei', 'Huawei Nova 11', 'Stijlvolle mid-range telefoon.', 449.99],
            ['Huawei', 'Huawei P50', 'Camera gerichte telefoon met Leica technologie.', 799.99],
            ['Huawei', 'Huawei Nova 10', 'Betaalbare optie met goede features.', 399.99],
            ['Huawei', 'Huawei Mate Xs 2', 'Foldable telefoon met premium design.', 1699.99],

            // Sony - 6 producten
            ['Sony', 'Xperia 1 V', 'Premium telefoon met Alpha camera technologie.', 1199.99],
            ['Sony', 'Xperia 5 V', 'Compacte flagship met professionele camera.', 999.99],
            ['Sony', 'Xperia 10 V', 'Mid-range telefoon met lange batterijduur.', 449.99],
            ['Sony', 'Xperia 1 IV', 'Vorige generatie flagship met 4K display.', 1099.99],
            ['Sony', 'Xperia 5 IV', 'Compacte optie met goede camera.', 849.99],
            ['Sony', 'Xperia Pro-I', 'Professionele telefoon met 1-inch sensor.', 1799.99],

            // Nokia - 6 producten
            ['Nokia', 'Nokia XR21', 'Robuuste telefoon met waterbestendigheid.', 499.99],
            ['Nokia', 'Nokia G60', 'Duurzame telefoon met gerecyclede materialen.', 349.99],
            ['Nokia', 'Nokia X30', 'Betaalbare optie met goede specificaties.', 399.99],
            ['Nokia', 'Nokia 8.3', '5G telefoon met PureView camera.', 599.99],
            ['Nokia', 'Nokia G50', 'Goede prijs-kwaliteit verhouding.', 299.99],
            ['Nokia', 'Nokia X20', 'Duurzame telefoon met lange software support.', 329.99],
        ];

        foreach ($smartphoneProducts as $productData) {
            [$brandName, $name, $description, $price] = $productData;
            
            if (Product::where('name', $name)->exists()) {
                continue;
            }

            $brand = Brand::firstOrCreate(['name' => $brandName]);
            
            // Probeer afbeelding op te halen met merknaam voor betere matches
            $imagePath = $this->getProductImage($name, $brandName);
            
            // Als nog geen afbeelding, probeer opnieuw met merk-gerelateerde zoekterm
            if (!$imagePath && isset($this->brandMapping[$brandName])) {
                $brandSearchTerm = $this->brandMapping[$brandName][0];
                $imagePath = $this->getProductImage($brandSearchTerm . ' phone', $brandName);
            }

            Product::create([
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'image' => $imagePath,
                'brand_id' => $brand->id,
                'category_id' => $category->id,
            ]);
        }

        $this->command->info("✅ Smartphones geïmporteerd");
    }

    /**
     * Seed accessoires - minimaal 6 producten
     */
    private function seedAccessories(Category $category): void
    {
        $this->command->info("🔌 Seeding accessoires...");

        $accessories = [
            ['MagSafe Draadloze Oplader', 'Snelle draadloze oplader voor iPhone met MagSafe technologie. Tot 15W.', 49.99, 'Apple'],
            ['Samsung Wireless Charger Duo', 'Dubbele draadloze oplader voor telefoon en smartwatch.', 79.99, 'Samsung'],
            ['Anker PowerCore 10000', 'Compacte powerbank met 10000mAh capaciteit en snelle laadtechnologie.', 29.99, null],
            ['USB-C Oplaadkabel 2m', 'Hoge kwaliteit USB-C kabel met snelle data overdracht en laden.', 19.99, null],
            ['AirPods Pro (2e generatie)', 'Draadloze oortjes met actieve ruisonderdrukking en ruimtelijke audio.', 249.99, 'Apple'],
            ['Samsung Galaxy Buds2 Pro', 'Premium draadloze oortjes met 360 Audio en actieve ruisonderdrukking.', 199.99, 'Samsung'],
            ['Google Pixel Buds Pro', 'Draadloze oortjes met Google Assistant en lange batterijduur.', 179.99, 'Google'],
            ['MagSafe Autohouder', 'Magneet autohouder voor iPhone met MagSafe compatibiliteit.', 34.99, 'Apple'],
            ['Universal Telefoon Statief', 'Uitklapbaar statief voor video opnames en selfies.', 24.99, null],
            ['Anti-Spiegel Screen Protector', 'Tempered glass screen protector met anti-fingerprint coating.', 14.99, null],
            ['USB-C Hub met HDMI', 'Multi-poort hub met USB-C, HDMI, USB 3.0 en SD card lezer.', 39.99, null],
            ['Draadloze Car Charger', 'Snelle draadloze oplader voor in de auto met magneet mount.', 44.99, null],
        ];

        foreach ($accessories as $item) {
            [$name, $description, $price, $brandName] = $item;
            
            if (Product::where('name', $name)->exists()) {
                continue;
            }

            $brand = $brandName ? Brand::firstOrCreate(['name' => $brandName]) : null;
            
            $imagePath = $this->getProductImage($name);

            Product::create([
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'image' => $imagePath,
                'brand_id' => $brand?->id ?? Brand::firstOrCreate(['name' => 'Generic'])->id,
                'category_id' => $category->id,
            ]);
        }

        $this->command->info("✅ Accessoires geïmporteerd");
    }

    /**
     * Seed aangepaste hoesjes (gewone hoesjes) - minimaal 6 producten
     */
    private function seedCustomCases(Category $category): void
    {
        $this->command->info("🎨 Seeding aangepaste hoesjes...");

        $customCases = [
            ['Transparant Personaliseerbaar Hoesje', 'Transparant hoesje waar je eigen stickers en designs aan kunt toevoegen. Geschikt voor alle telefoons.', 21.99],
            ['Minimalistisch Zwart Hoesje', 'Clean minimalistisch design in zwart. Eenvoudig en elegant. Beschermt je telefoon zonder afbreuk te doen aan het design.', 19.99],
            ['Abstract Design Telefoon Hoesje', 'Modern abstract design hoesje met unieke patronen. Beschikbaar voor alle modellen. Kunstzinnig en beschermend.', 22.99],
            ['Custom Foto iPhone Hoesje', 'Upload je eigen foto voor een uniek persoonlijk hoesje. Hoogwaardige print kwaliteit met duurzame bescherming.', 34.99],
            ['Nature Print Hoesje', 'Prachtige natuur prints op premium hoesjes. Unieke designs per seizoen. Voor natuurliefhebbers.', 26.99],
            ['Cartoon Style Hoesje', 'Vrolijke cartoon stijl hoesjes met grappige designs. Perfect voor kinderen en volwassenen die houden van humor.', 23.99],
            ['Leather Premium Hoesje', 'Luxe leren hoesje met elegant design. Professioneel en stijlvol voor zakelijke gebruikers.', 39.99],
            ['Silicone Soft Touch Hoesje', 'Zachte siliconen hoesjes met grip. Anti-slip en schokbestendig. Perfect voor dagelijks gebruik.', 18.99],
        ];

        foreach ($customCases as $item) {
            [$name, $description, $price] = $item;
            
            if (Product::where('name', $name)->exists()) {
                continue;
            }

            // Voor hoesjes, zoek naar phone case producten
            $imagePath = $this->getProductImage('phone case');
            if (!$imagePath) {
                $imagePath = $this->getProductImage('case');
            }

            Product::create([
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'image' => $imagePath,
                'brand_id' => Brand::firstOrCreate(['name' => 'Custom'])->id,
                'category_id' => $category->id,
            ]);
        }

        $this->command->info("✅ Aangepaste hoesjes geïmporteerd (" . count($customCases) . " producten)");
    }

    /**
     * Seed Manga Editie & Meer (speciale editie hoesjes) - minimaal 6 producten
     */
    private function seedMangaEdition(Category $category): void
    {
        $this->command->info("🎭 Seeding Manga Editie & Meer...");

        $mangaEditionCases = [
            ['Manga Stijl iPhone Hoesje', 'Personaliseerbaar hoesje met populaire manga designs zoals Naruto, One Piece en Dragon Ball. Beschermend en stijlvol.', 24.99],
            ['Voetbal Club Samsung Hoesje', 'Custom hoesje met jouw favoriete voetbalclub logo. Beschikbaar voor alle teams: Real Madrid, FC Barcelona, Manchester United en meer.', 29.99],
            ['Anime Character Hoesje', 'Hoesje met populaire anime karakters zoals Goku, Luffy en Eren. Personaliseerbaar met je favoriete character.', 27.99],
            ['Gaming Theme Hoesje', 'Stijlvol gaming themed hoesje met RGB accenten. Perfect voor gamers met designs van Fortnite, Valorant en League of Legends.', 32.99],
            ['Marvel Superhero Hoesje', 'Hoesjes met Marvel superhelden zoals Spider-Man, Iron Man en Captain America. Officiële designs en hoge kwaliteit.', 31.99],
            ['Disney Character Hoesje', 'Magische Disney hoesjes met Mickey Mouse, Frozen karakters en Pixar designs. Voor jong en oud.', 26.99],
            ['Star Wars Collection Hoesje', 'Iconische Star Wars designs met Darth Vader, Luke Skywalker en The Mandalorian. De kracht is met jou.', 33.99],
            ['Hip-Hop Artist Hoesje', 'Hoesjes geïnspireerd door populaire hip-hop artiesten en album covers. Street style en trendy.', 28.99],
            ['Fashion Brand Hoesje', 'Premium hoesjes met designs geïnspireerd door bekende mode merken. Stijlvol en exclusief.', 35.99],
        ];

        foreach ($mangaEditionCases as $item) {
            [$name, $description, $price] = $item;
            
            if (Product::where('name', $name)->exists()) {
                continue;
            }

            // Voor manga/speciale hoesjes, zoek naar phone case producten
            $imagePath = $this->getProductImage('phone case');
            if (!$imagePath) {
                $imagePath = $this->getProductImage('case');
            }

            Product::create([
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'image' => $imagePath,
                'brand_id' => Brand::firstOrCreate(['name' => 'Custom'])->id,
                'category_id' => $category->id,
            ]);
        }

        $this->command->info("✅ Manga Editie & Meer geïmporteerd (" . count($mangaEditionCases) . " producten)");
    }

    /**
     * Haal productafbeelding op via API of gebruik placeholder
     */
    private function getProductImage(string $productName, ?string $brandName = null): ?string
    {
        try {
            // Zoek eerst in smartphone categorie als het een telefoon is
            $searchQuery = Str::lower($productName);
            $category = 'smartphones';
            
            // Als brand bekend is, voeg toe aan query
            if ($brandName && isset($this->brandMapping[$brandName])) {
                $searchQuery = Str::lower($this->brandMapping[$brandName][0] . ' ' . $productName);
            }
            
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
                        if (Str::contains($title, Str::lower($productName)) || 
                            ($brandName && Str::contains($title, Str::lower($this->brandMapping[$brandName][0] ?? '')))) {
                            if (!empty($product['thumbnail']) || !empty($product['images'][0])) {
                                $imageUrl = $product['thumbnail'] ?? $product['images'][0] ?? null;
                                if ($imageUrl) {
                                    return $this->downloadImage($imageUrl, time() . rand(1000, 9999));
                                }
                            }
                        }
                    }
                    
                    // Als geen match, gebruik eerste product van het merk
                    if ($brandName && isset($this->brandMapping[$brandName])) {
                        foreach ($data['products'] as $product) {
                            $title = Str::lower($product['title'] ?? '');
                            if (Str::contains($title, Str::lower($this->brandMapping[$brandName][0]))) {
                                $imageUrl = $product['thumbnail'] ?? $product['images'][0] ?? null;
                                if ($imageUrl) {
                                    return $this->downloadImage($imageUrl, time() . rand(1000, 9999));
                                }
                            }
                        }
                    }
                    
                    // Fallback: gebruik willekeurige smartphone afbeelding
                    $randomProduct = $data['products'][array_rand($data['products'])];
                    $imageUrl = $randomProduct['thumbnail'] ?? $randomProduct['images'][0] ?? null;
                    if ($imageUrl) {
                        return $this->downloadImage($imageUrl, time() . rand(1000, 9999));
                    }
                }
            }
            
            // Als smartphones niet werkt, probeer algemene search
            $response = Http::timeout(10)->get('https://dummyjson.com/products/search', [
                'q' => $searchQuery,
                'limit' => 5
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (!empty($data['products'][0])) {
                    $imageUrl = $data['products'][0]['thumbnail'] ?? $data['products'][0]['images'][0] ?? null;
                    if ($imageUrl) {
                        return $this->downloadImage($imageUrl, time() . rand(1000, 9999));
                    }
                }
            }
        } catch (\Exception $e) {
            // API faalt, gebruik fallback
        }

        // Geen afbeelding gevonden, retourneer null (fallback in view)
        return null;
    }

    /**
     * Download afbeelding en sla lokaal op
     */
    private function downloadImage(string $url, int $productId): ?string
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
            $filename = 'products/' . Str::slug('product-' . $productId) . '-' . time() . '.' . $extension;
            
            // Zorg dat directory bestaat
            Storage::disk('public')->makeDirectory('products');
            
            // Sla op in public storage
            Storage::disk('public')->put($filename, $imageContent);
            
            return $filename;
        } catch (\Exception $e) {
            return null;
        }
    }
}
