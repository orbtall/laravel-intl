<?php

namespace Orbtall\Intl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgnoredRoute extends Model {

    use HasFactory;

    protected $table = 'ignored_routes';

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

}
