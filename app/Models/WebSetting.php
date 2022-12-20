<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
    use HasFactory;

    // filable all
    protected $guarded = [];

    public function logo()
    {
        return asset('storage/' . $this->logo);
    }

    public function meta_favicon()
    {
        return asset('storage/' . $this->meta_favicon);
    }

    public function meta_thumbnail()
    {
        return asset('storage/' . $this->meta_thumbnail);
    }
}
