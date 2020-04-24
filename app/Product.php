<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'image', 'description'];

    public function deleteImage()
    {
        unlink(public_path() .'\/' .$this->image);
    }
}
