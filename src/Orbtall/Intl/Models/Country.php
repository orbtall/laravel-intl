<?php

namespace Orbtall\Intl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    use HasFactory;

    protected $table = 'countries';

    public function region() {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function locales() {
        return $this->hasMany(Locale::class, 'country_id');
    }

}
