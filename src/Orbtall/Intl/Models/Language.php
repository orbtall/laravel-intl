<?php

namespace Orbtall\Intl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model {

    use HasFactory;

    protected $table = 'languages';

    public function locale() {
        return $this->hasMany(Locale::class, 'country_id');
    }

}
