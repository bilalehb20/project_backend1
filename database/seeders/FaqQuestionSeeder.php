<?php

namespace Database\Seeders;

use App\Models\FaqCategory;
use App\Models\FaqQuestion;
use Illuminate\Database\Seeder;

class FaqQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bestellingen = FaqCategory::where('name', 'Bestellingen')->first();
        $verzending = FaqCategory::where('name', 'Verzending & Bezorging')->first();
        $garantie = FaqCategory::where('name', 'Garantie & Retourneren')->first();
        $producten = FaqCategory::where('name', 'Producten')->first();
        $account = FaqCategory::where('name', 'Account & Betalingen')->first();

        $questions = [
            [
                'faq_category_id' => $bestellingen->id,
                'question' => 'Hoe kan ik een bestelling plaatsen?',
                'answer' => 'U kunt een bestelling plaatsen door een product aan uw winkelwagen toe te voegen en vervolgens naar de checkout te gaan. Volg de stappen om uw gegevens in te vullen en te betalen.',
            ],
            [
                'faq_category_id' => $bestellingen->id,
                'question' => 'Kan ik mijn bestelling annuleren?',
                'answer' => 'U kunt uw bestelling annuleren binnen 24 uur na plaatsing, mits deze nog niet is verzonden. Neem contact met ons op via het contactformulier.',
            ],
            [
                'faq_category_id' => $verzending->id,
                'question' => 'Wat zijn de verzendkosten?',
                'answer' => 'Voor bestellingen boven de 50 euro is verzending gratis. Onder de 50 euro bedragen de verzendkosten 4,95 euro.',
            ],
            [
                'faq_category_id' => $verzending->id,
                'question' => 'Hoe lang duurt de bezorging?',
                'answer' => 'Standaard bezorging duurt 2-3 werkdagen. U kunt ook kiezen voor express bezorging (1 werkdag) tegen een meerprijs.',
            ],
            [
                'faq_category_id' => $garantie->id,
                'question' => 'Hoe lang is de garantie op producten?',
                'answer' => 'Alle smartphones hebben minimaal 2 jaar garantie conform EU wetgeving. Accessoires hebben 1 jaar garantie.',
            ],
            [
                'faq_category_id' => $garantie->id,
                'question' => 'Kan ik een product retourneren?',
                'answer' => 'Ja, u heeft 14 dagen bedenktijd om een product te retourneren zonder opgaaf van reden. Het product moet ongebruikt en in de originele verpakking zijn.',
            ],
            [
                'faq_category_id' => $producten->id,
                'question' => 'Zijn de producten nieuw of refurbished?',
                'answer' => 'Alle producten in onze webshop zijn volledig nieuw en komen rechtstreeks van de fabrikant. We verkopen geen refurbished producten.',
            ],
            [
                'faq_category_id' => $producten->id,
                'question' => 'Zijn alle producten op voorraad?',
                'answer' => 'We proberen altijd een goede voorraad aan te houden. Als een product niet op voorraad is, wordt dit duidelijk aangegeven op de productpagina.',
            ],
            [
                'faq_category_id' => $account->id,
                'question' => 'Welke betaalmethoden accepteren jullie?',
                'answer' => 'Wij accepteren iDEAL, creditcard, PayPal en Bancontact. Alle betalingen worden veilig verwerkt via gecertificeerde betaalproviders.',
            ],
            [
                'faq_category_id' => $account->id,
                'question' => 'Hoe kan ik mijn account beheren?',
                'answer' => 'Na het aanmaken van een account kunt u inloggen en uw profiel, bestellingen en favorieten beheren via het menu.',
            ],
        ];

        foreach ($questions as $question) {
            FaqQuestion::create($question);
        }
    }
}
