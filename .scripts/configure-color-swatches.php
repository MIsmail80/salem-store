<?php
/**
 * Script to configure color attribute swatches in Bagisto
 * 
 * Usage: php artisan tinker, then copy-paste sections of this file
 */

// Color mapping for common Arabic color names
$colorMap = [
    'أحمر' => '#FF0000',      // Red
    'أزرق' => '#0000FF',      // Blue
    'أخضر' => '#00FF00',      // Green
    'أسود' => '#000000',      // Black
    'أبيض' => '#FFFFFF',      // White
    'برتقالي' => '#FFA500',   // Orange
    'رمادي' => '#808080',     // Gray
    'بني' => '#8B4513',       // Brown
    'أصفر' => '#FFFF00',      // Yellow
    'وردي' => '#FFC0CB',      // Pink
    'بنفسجي' => '#800080',    // Purple
    'ذهبي' => '#FFD700',      // Gold
    'فضي' => '#C0C0C0',       // Silver

    // English equivalents (case-insensitive)
    'red' => '#FF0000',
    'blue' => '#0000FF',
    'green' => '#00FF00',
    'black' => '#000000',
    'white' => '#FFFFFF',
    'orange' => '#FFA500',
    'gray' => '#808080',
    'grey' => '#808080',
    'brown' => '#8B4513',
    'yellow' => '#FFFF00',
    'pink' => '#FFC0CB',
    'purple' => '#800080',
    'gold' => '#FFD700',
    'silver' => '#C0C0C0',
];

//================================================
// STEP 1: Update Color Attribute to use Color Swatch Type
//================================================

$colorAttribute = \Webkul\Attribute\Models\Attribute::where('code', 'color')->first();

if ($colorAttribute) {
    $colorAttribute->swatch_type = 'color';
    $colorAttribute->save();
    echo "✓ Color attribute updated to use 'color' swatch type\n";
} else {
    echo "✗ Color attribute not found!\n";
}

//================================================
// STEP 2: Auto-configure swatch values for all color options
//================================================

if ($colorAttribute) {
    $options = $colorAttribute->options;

    echo "\nFound " . $options->count() . " color options:\n";

    foreach ($options as $option) {
        // Get the label in the current locale or admin_name
        $label = $option->admin_name;

        // Check for translations
        if ($option->translations->isNotEmpty()) {
            foreach ($option->translations as $translation) {
                echo "  - Option: {$option->admin_name} / {$translation->label}";

                // Try to find matching color
                $matchedColor = null;

                // Check admin_name
                foreach ($colorMap as $name => $hex) {
                    if (stripos($option->admin_name, $name) !== false) {
                        $matchedColor = $hex;
                        break;
                    }
                }

                // Check translated label
                if (!$matchedColor) {
                    foreach ($colorMap as $name => $hex) {
                        if (stripos($translation->label, $name) !== false) {
                            $matchedColor = $hex;
                            break;
                        }
                    }
                }

                if ($matchedColor) {
                    $option->swatch_value = $matchedColor;
                    $option->save();
                    echo " → Set to {$matchedColor} ✓\n";
                } else {
                    echo " → No matching color found. Please set manually.\n";
                }

                break; // Only check first translation
            }
        } else {
            echo "  - Option: {$option->admin_name}";

            // Try to find matching color
            $matchedColor = null;
            foreach ($colorMap as $name => $hex) {
                if (stripos($option->admin_name, $name) !== false) {
                    $matchedColor = $hex;
                    break;
                }
            }

            if ($matchedColor) {
                $option->swatch_value = $matchedColor;
                $option->save();
                echo " → Set to {$matchedColor} ✓\n";
            } else {
                echo " → No matching color found. Please set manually.\n";
            }
        }
    }
}

//================================================
// STEP 3: Manual configuration for specific options
//================================================

// Example for manually setting a color:
/*
$option = \Webkul\Attribute\Models\AttributeOption::find(1); // Replace with actual ID
$option->swatch_value = '#FF0000'; // Red
$option->save();
*/

//================================================
// STEP 4: Verify configuration
//================================================

echo "\n=== Verification ===\n";
if ($colorAttribute) {
    $options = $colorAttribute->fresh()->options;

    foreach ($options as $option) {
        $swatchValue = $option->swatch_value ?: 'NOT SET';
        $label = $option->admin_name;

        if ($option->translations->isNotEmpty()) {
            $label .= ' / ' . $option->translations->first()->label;
        }

        echo "{$label}: {$swatchValue}\n";
    }
}

echo "\n=== Next Steps ===\n";
echo "1. Clear cache: php artisan cache:clear\n";
echo "2. Clear view cache: php artisan view:clear\n";
echo "3. Check your product page to see colored circles\n";
