<?php

namespace App\Modules\Admin\Models\ContentModule;

use App\Bll\Lang;
use Illuminate\Database\Eloquent\Model;

class ContentModule extends Model
{
    protected $table = 'content_modules';
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
