<?php

namespace App\Models;

use App\ModelFilters\SourceFilter;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory,Filterable;

    const REFERENCE_NEWS_API='news_api';
    const REFERENCE_NEW_YORK_TIMES='ny_times';
    const REFERENCE_GUARDIAN='guardians';

    protected $fillable=['reference','title','category','author','content','image','published_at'];

    public function modelFilter()
    {
        return $this->provideFilter(SourceFilter::class);
    }

    public function scopeFilterByPreferences($query, $preferences)
    {
        return $query->whereIn('category', $preferences)
            ->orWhereIn('author', $preferences)
            ->orWhereIn('reference', $preferences);
    }
}
