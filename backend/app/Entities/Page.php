<?php

declare(strict_types=1);

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Page
 * @package App\Entities
 * @property int $id
 * @property string $name
 * @property string $url
 * @property int $previews
 * @property Website $website
 * @property int $website_id
 */
final class Page extends Model
{
    protected $fillable = [
        'name',
        'url',
        'previews',
        'website_id',
    ];

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class, 'entrance_page_id');
    }

    public function errors(): HasMany
    {
        return $this->hasMany(Error::class);
    }
}
