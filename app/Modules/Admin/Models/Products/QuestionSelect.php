<?php

namespace App\Modules\Admin\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSelect extends Model
{
    protected $table = 'question_mcq';
    public $timestamps = true;
    protected $guarded = [];

    public function question(){

        return $this->hasMany(Question::class , 'question_id' , 'id');
    }


}
