<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable =['user_id','report_cats_id','report_text'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reportcat()
    {
        return $this->belongsTo(ReportCat::class, 'report_cats_id');
    }
}
