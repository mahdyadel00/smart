<?php

namespace App\Modules\Admin\Models\Modules;

use App\Bll\Lang;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Admin\Models\Modules\InteroductionModuleData;

class InteroductionModule extends Model
{
    protected $table = 'interoduction_modules';
    protected $guarded = [];

    public function Data(){
        return $this->hasMany(InteroductionModuleData::class,'inter_module_id','id');
    }

    public function TranslatedData(){
        return $this->hasOne(InteroductionModuleData::class,'inter_module_id','id')->where('lang_id',Lang::getSelectedLangId());
    }

    public function getImageNameEncoded(){
        return dirname($this->image).'/'.rawurlencode(basename($this->image));
    }
}
