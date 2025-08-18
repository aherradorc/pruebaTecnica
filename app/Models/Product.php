<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    protected $fillable = ['code', 'name', 'description', 'photo'];

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function rates() {
        return $this->hasMany(Rate::class);
    }

    public function reminders() {
        return $this->hasMany(Reminder::class);
    }
}
