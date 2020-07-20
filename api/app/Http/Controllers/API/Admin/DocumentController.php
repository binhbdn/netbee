<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\documentService;

class DocumentController extends Controller
{

    protected $documentService;

    public function __construct(documentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function getDocuments()
    {
        $response = $this->documentService->getDocuments();
        return response()->json($response);
    }

    public function getDocumentById($id)
    {
        $response = $this->documentService->getDocumentById($id);
        return response()->json($response);
    }

    public function createDocument(Request $request)
    {
        $response =$this->documentService->store($request);
        return response()->json($response);
    }

    public function updateDocument(Request $request)
    {
        $response = $this->documentService->updateDocument($request);
        return response()->json($response);
    }

    public function deleteDocument(Request $request)
    {
        $response = $this->documentService->destroy($request->id);
        return response()->json($response);
    }

    public function changeStatusDocument(Request $request)
    {
        $response = $this->documentService->changeStatus($request->id);
        return response()->json($response);
    }
}
