<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TaskStatus extends Model
{
    use HasFactory;

    const STATUS_OPENED_ID = 1;

    protected $fillable = [
        'name',
    ];

    public static function byName(string $name): ?self
    {
        $key = self::class . '_byName_' . $name;

        return Cache::rememberForever($key, function() use ($name) {
            return static::query()->firstWhere('name', $name);
        });
    }
}
