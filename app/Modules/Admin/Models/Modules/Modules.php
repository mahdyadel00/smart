<?php

namespace App\Modules\Admin\Models\Modules;

use App\Bll\Lang;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Admin\Models\Insturctions\Insturction;
use App\Modules\Admin\Models\Modules\ModulesData;

class Modules extends Model
{
    protected $table = 'modules';
    protected $guarded = [];

    public function Data(){
        return $this->hasMany(ModulesData::class,'module_id','id');
    }
    public function content(){
        return $this->hasMany(ModulesContent::class,'module_id','id');
    }
    public function goalModule(){
        return $this->hasMany(GoalsModules::class,'module_id','id');
    }
    public function interModule(){
        return $this->hasMany(InteroductionModule::class,'module_id','id');
    }
    public function InsturcationModule(){
        return $this->hasMany(Insturction::class,'module_id','id');
    }

    public function TranslatedData(){
        return $this->hasOne(ModulesData::class,'module_id','id')->where('lang_id',Lang::getSelectedLangId());
    }

    public function getImageNameEncoded(){
        return dirname($this->image).'/'.rawurlencode(basename($this->image));
    }
}
