<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConfigDictionary extends Model
{
    use HasFactory;

    public const CACHE_KEY = 'config_cache';

    public $timestamps = false;

    protected $primaryKey = 'key';

    protected $fillable = [
        'key',
        'value'
    ];

    protected $casts = [
        'value' => 'json'
    ];

    public static function set(string $key, $value, $refreshCache = true)
    {
        return tap(
            self::updateOrCreate(['key' => $key], ['value' => $value]),
            function () use ($refreshCache) {
                if ($refreshCache) {
                    static::bustCache();
                    static::storeCache();
                }
            }
        );
    }

    public static function get(string $key, $default = null)
    {
        if (Cache::has(self::CACHE_KEY)) {
            return Cache::get(self::CACHE_KEY)[$key] ?? $default;
        }

        static::storeCache();
        return self::find($key)->value ?? $default;
    }

    /**
     * @param string[] $keys
     */
    public static function getMany($keys, $defaults = [])
    {
        $results = [];
        foreach ($keys as $key) {
            $results[$key] = self::get($key, $defaults[$key] ?? null);
        }
        return $results;
    }

    public static function setMany($array)
    {
        $result = 1;
        static::bustCache();
        foreach ($array as $key => $value) {
            $result *= (int) (bool) self::set($key, $value, false);
        }
        self::storeCache();
        return (bool) $result;
    }

    public static function bustCache()
    {
        Cache::forget(self::CACHE_KEY);
    }

    public static function storeCache()
    {
        Cache::rememberForever(static::CACHE_KEY, function (){
            return self::all()->map->getAttributes()->keyBy('key')->map(function ($item) {
                return json_decode($item['value']);
            })->all();
        });
    }
}