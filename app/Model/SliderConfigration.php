<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SliderConfiguration extends Model
{
    protected $fillable = ['slider_id', 'full_image', 'thumbnail', 'caption_text', 'caption_location', 'status'];
}
