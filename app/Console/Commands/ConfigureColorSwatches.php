<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webkul\Attribute\Models\Attribute;

class ConfigureColorSwatches extends Command
{
    protected $signature = 'product:configure-color-swatches';
    protected $description = 'Configure color attribute to use visual swatches';

    public function handle()
    {
        $this->info('Configuring color attribute swatches...');

        // Color mapping
        $colorMap = [
            'أحمر' => '#FF0000',      // Red
            'أزرق' => '#0000FF',      // Blue
            'أخضر' => '#00FF00',      // Green
            'أسود' => '#000000',      // Black
            'أبيض' => '#FFFFFF',      // White
            'أصفر' => '#FFFF00',      // Yellow
            'برتقالي' => '#FFA500',   // Orange
            'رمادي' => '#808080',     // Gray
            'بني' => '#8B4513',       // Brown
            'red' => '#FF0000',
            'blue' => '#0000FF',
            'green' => '#00FF00',
            'black' => '#000000',
            'white' => '#FFFFFF',
            'yellow' => '#FFFF00',
            'orange' => '#FFA500',
            'gray' => '#808080',
            'grey' => '#808080',
            'brown' => '#8B4513',
        ];

        // Get color attribute
        $colorAttribute = Attribute::where('code', 'color')->first();

        if (!$colorAttribute) {
            $this->error('Color attribute not found!');
            return 1;
        }

        // Update swatch type
        $colorAttribute->swatch_type = 'color';
        $colorAttribute->save();
        $this->info('✓ Updated color attribute to use "color" swatch type');

        // Update options
        $options = $colorAttribute->options;
        $this->info("Found {$options->count()} color options");

        foreach ($options as $option) {
            $label = $option->admin_name;

            // Try to find in translations
            if ($option->translations->isNotEmpty()) {
                $translation = $option->translations->first();
                $label .= ' / ' . $translation->label;
            }

            // Find matching color
            $matchedColor = null;
            foreach ($colorMap as $name => $hex) {
                if (stripos($option->admin_name, $name) !== false) {
                    $matchedColor = $hex;
                    break;
                }

                // Check translations too
                foreach ($option->translations as $trans) {
                    if (stripos($trans->label, $name) !== false) {
                        $matchedColor = $hex;
                        break 2;
                    }
                }
            }

            if ($matchedColor) {
                $option->swatch_value = $matchedColor;
                $option->save();
                $this->line("  ✓ {$label} → {$matchedColor}");
            } else {
                $this->warn("  ⚠ {$label} → No match found (please set manually)");
            }
        }

        $this->info("\n=== Summary ===");
        $this->table(
            ['Option', 'Swatch Value'],
            $options->map(fn($opt) => [
                $opt->admin_name,
                $opt->swatch_value ?: 'NOT SET'
            ])
        );

        $this->info("\nNext steps:");
        $this->line("1. Run: php artisan cache:clear");
        $this->line("2. Run: php artisan view:clear");
        $this->line("3. Check your product page");

        return 0;
    }
}
