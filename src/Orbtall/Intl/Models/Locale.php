<?php

namespace Orbtall\Intl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locale extends Model {

    use HasFactory;

    protected $table = 'locales';

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public function language() {
        return $this->belongsTo(Language::class, 'language_uuid');
    }

    public function country() {
        return $this->belongsTo(Country::class, 'country_uuid');
    }

}
