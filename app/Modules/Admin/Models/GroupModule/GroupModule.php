<?php

namespace App\Modules\Admin\Models\GroupModule;

use App\Bll\Lang;
use Illuminate\Database\Eloquent\Model;

class GroupModule extends Model
{
    protected $table = 'group_modules';
    protected $guarded = [];

    // public function Data(){
    //     return $this->hasOne(ActivityModuleData::class,'activity_id','id');
    // }

    // public function TranslatedData(){
    //     return $this->hasOne(ActivityModuleData::class,'activity_id','id')->where('lang_id',Lang::getSelectedLangId());
    // }
    public function getImageNameEncoded(){
        return dirname($this->image).'/'.rawurlencode(basename($this->image));
    }

}
