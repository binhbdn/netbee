<?php

namespace App\Http\Controllers\API;

use App\Services\TagService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use Carbon\Carbon;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function getAllTag()
    {
        $response = $this->tagService->getAllTag();
        return response()->json($response);
    }
}
