<?php

namespace App\Traits;

use App\Enums\Language;
use Illuminate\Support\Facades\Artisan;
use App\Models\System\Settings\Settings\Key;
use App\Models\System\Settings\Settings\Translations;

trait GenerateSlugKey
{
    // after adding or updating any model with slug and name fields call this function to generate or update the key and translations
    // example: $this->GenerateSlugKey($data);
    protected function GenerateSlugKey(array $data): void
    {
        $key = Key::where('key', 'like', 'system.' . $data['slug'])->first();
        if (!$key) {
            // Create the key if it doesn't exist
            $key = Key::create(['key' => 'system.' . $data['slug']]);
            Translations::create([
                'key_id' => $key->id,
                'language_id' => Language::ENGLISH->value,
                'value' => $data['name'],
            ]);
        } else {
            // Update the key if the slug has changed
            if ($key->key !== 'system.' . $data['slug']) {
                $key->update(['key' => 'system.' . $data['slug']]);
                Translations::where('key_id', $key->id)->update(['value' => $data['name']]);
                Artisan::call('translations:cache');
            }
        }
    }
}
