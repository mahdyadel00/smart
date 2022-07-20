<?php

namespace App\Modules\Admin\Models\ActivityModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityModuleUpload extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'activity_modules_upload';
}