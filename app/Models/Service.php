<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'services';

    protected $fillable = [
        'heading',
        'main_img',
        'small_pag',
        'first_heading',
        'paragraph',
        'note',
        'sec_heading',
        'sec_imag',
        'sec_paragraph',
        'third_heading',
        'list',
        'serviceCat_id',
        'slug',
        'ext_images'
    ];

    protected $casts = [
        'list' => 'array',
        'ext_images' => 'array',
    ];

    public function serviceCat()
    {
        return $this->belongsTo(
            ServiceCategory::class,
            'serviceCat_id'
        );
    }
}
