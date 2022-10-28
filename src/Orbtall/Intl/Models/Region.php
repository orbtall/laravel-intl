<?php

namespace Orbtall\Intl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model {

    use HasFactory;

    protected $table = 'regions';

    public function countries() {
        return $this->hasMany(Country::class, 'id', 'region_id');
    }

}
