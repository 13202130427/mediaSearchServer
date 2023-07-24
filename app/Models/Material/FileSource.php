<?php


namespace App\Models\Material;


use App\Libraries\Base\BaseModel;
use App\Models\Admin\Platform;
use App\Models\Admin\PlatformUser;

class FileSource extends BaseModel
{

    protected $connection = "business";

    protected $fillable = [
        'platform_id',
        'name',
        'file_type',
        'origin_type',
        'origin_tpl_id',
        'operator'
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    public function operator()
    {
        return $this->belongsTo(PlatformUser::class);
    }

    public function groups()
    {
        return $this->belongsToMany(FileGroup::class,FileGroupSource::class,'group_id','source_id');
    }

    public function template()
    {
        return $this->belongsTo(FileTemplate::class,'origin_tpl_id');
    }

}
