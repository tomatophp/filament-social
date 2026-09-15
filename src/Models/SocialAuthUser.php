<?php

namespace TomatoPHP\FilamentSocial\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAuthUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_id',
        'model_type',
        'provider',
        'provider_id',
        'data',
    ];

    protected $casts = [
        'data' => 'json',
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
