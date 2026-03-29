<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolUsage extends Model
{
    protected $table = 'tools_usage';

    protected $fillable = [
        'user_id',
        'tool_name',
        'input_data',
    ];

    const UPDATED_AT = null;
}
