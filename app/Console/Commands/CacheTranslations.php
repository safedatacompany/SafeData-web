<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\System\Settings\Settings\Language;
use App\Models\System\Settings\Settings\Translations;
use Illuminate\Support\Facades\File;

class CacheTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache translations to JSON files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Caching translations...');

        $languages = Language::query()->select('id', 'name')->get();

        foreach ($languages as $language) {
            // Use Eloquent relationships to get the key
            $translations = Translations::where('language_id', $language->id)
                ->with('keys')
                ->get()
                ->pluck('value', 'keys.key')
                ->toArray();

            $path = resource_path("lang/{$language->name}.json");

            File::ensureDirectoryExists(dirname($path));

            $newContent = json_encode($translations, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            // Only write file if it doesn't exist OR content has changed
            if (!file_exists($path) || file_get_contents($path) !== $newContent) {
                File::put($path, $newContent);
                $this->info("✅ Updated {$language->name} translations (" . count($translations) . " keys).");
            } else {
                $this->info("ℹ️  No changes for {$language->name}, skipped.");
            }
        }

        $this->info('🎉 Translation caching completed!');
    }
}
