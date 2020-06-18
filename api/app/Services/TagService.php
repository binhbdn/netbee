<?php
namespace App\Services;

use App\Models\NbTag;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;

class TagService {
          

    protected $nbtag; 
    const
        ADMIN = 4,
        HR = 3,
        COMPANY =2,
        USER =1;  
    const
        ACTION = 0,
        NOACTION = 1;

    public function __construct(NbTag $nbtag)
    {
        $this->nbtag = $nbtag;      
    }

    public function getTagById($id)
    {
        return $this->nbtag->whereId($id);
    }

    public function getAllTag()
    {
        return $this->nbtag
        ->where('deleted',self::ACTION)
        ->where('status',self::NOACTION)
        ->get();        
    }

}
