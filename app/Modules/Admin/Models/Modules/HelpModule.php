<?php

namespace App\Modules\Admin\Models\Modules;

use App\Bll\Lang;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Admin\Models\Modules\HelpModuleUpload;

class HelpModule extends Model
{
    protected $table = 'help_modules';
    protected $guarded = [];

    public function Data(){
        return $this->hasMany(HelpModuleUpload::class,'help_module_id','id');
    }

    public function TranslatedData(){
        return $this->hasOne(HelpModuleUpload::class,'help_module_id','id')->where('lang_id',Lang::getSelectedLangId());
    }

    public function getImageNameEncoded(){
        return dirname($this->image).'/'.rawurlencode(basename($this->image));
    }
}
