<?php
namespace App\Services;

use App\Models\Document;
use Carbon\Carbon;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;

class DocumentService extends BaseService{

    protected $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function getDocumentById($id)
    {
        return $this->document->whereId($id);
    }

    public function getDocuments()
    {
        $perPage = 6;
        try {
            $query = $this->document;
           // dd($query);
            if (Auth::user()->role != UserService::ROLE_ADMIN) {
                $query->whereUserCreated(Auth::user()->id);
            }
            $document = $query->orderBy('id', 'DESC')->where('deleted','!=',1)->paginate($perPage);
            return [
                'status'=> 200,
                'message' => 'Thành công', 
                'data' => $document
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()

            ];
        }
    }

    public function update($data, $id)
    {
        return $this->getDocumentById($id)->update($data);
    }

    public function changeStatus($id)
    {
        try {
            $document = $this->getDocumentById($id)->first();
            if($document) {
                $data = [
                    'status' => !$document->status,
                    'updated_at' => Carbon::now()
                ];
                return [
                    'status'=> 200,
                    'message' => 'Thay đổi trạng thái thành công',
                    'data' => $this->update($data, $id)
                ];
            }
            return [
                'status'=> 400,
                'message' => 'Tài liệu không tồn tại',
                'data' => null
            ];

        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function changeMultiStatus($request)
    {
        if(empty($request->id)){
            return [
                'status'=> 400,
                'message' => 'Bạn chưa chọn tài liệu!',
                'data' => null
            ];
        }
        $ids = json_decode($request->id);
        $status = $request->status;
        try {
            $message = $status ? 'Kích hoạt thành công' : 'Bỏ kích hoạt thành công';
            $this->document->whereIn('id', $ids)->update([
                'status' => $status,
                'updated_at' =>  Carbon::now()
            ]);
            return [
                'status'=> 200,
                'message' => $message,
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function store($request)
    {
        $validate = $this->documentValidate($request);
        if (!empty($validate)) {
            return $validate;
        }
        $data = $this->getOnlyData($request);
        try {
            $this->document->insert($data);
            return [
                'status' => 200,
                'message' => 'Tạo tài liệu thành công',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function createimg($request)
    {
        try {
            $image = $request->image;
            $image = str_replace('data:image/png;base64,', '', $image);
            // $image = str_replace(' ', '+', $image);
            $imageName = str_random(10).'.'.'png';
            \File::put(storage_path(). '/' . $imageName, base64_decode($image));
            return [
                'status' => 200,
                'message' => 'Tạo tài liệu thành công',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }        
    }

    public function updateDocument($request)
    {
        $id = $request->id;
        $documentExists = $this->getDocumentById($id)->exists();
        if (!$documentExists) {
            return [
                'status'=> 400,
                'message' => 'Tài liệu đã bị xóa',
                'data' => null
            ];
        }
        $validate = $this->documentValidate($request);
        if (!empty($validate)) {
            return $validate;
        }
        $data = $this->getOnlyData($request);
        try {
            $this->update($data, $id);
            return [
                'status' => 200,
                'message' => 'Cập nhập tài liệu thành công',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function destroy($id)
    {
        try {
            $documentExists = $this->getDocumentById($id)->exists();
            if($documentExists) {
                $data = [
                    'deleted' => self::ACTIVE,
                    'updated_at' => Carbon::now()
                ];
                return [
                    'status'=> 200,
                    'message' => 'Xóa tài liệu thành công',
                    'data' => $this->update($data, $id)
                ];
            }
            return [
                'status'=> 400,
                'message' => 'Tài liệu không tồn tại',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function multiDestroy($data)
    {
        if(empty($data->id)){
            return [
                'status'=> 400,
                'message' => 'Bạn chưa chọn tài liệu!',
                'data' => null
            ];
        }
        $ids = json_decode($data->id);
        try {
            $this->document->whereIn('id', $ids)->update([
                'deleted' => self::ACTIVE,
                'updated_at' =>  Carbon::now()
            ]);
            return [
                'status'=> 200,
                'message' => 'Xóa tài liệu thành công',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    private function documentValidate($request)
    {
        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];
        $messages = [
            'required' => 'Không được để trống',
        ];

        if (empty($request->id) || $request->file('thumbnail')) {
            $rules['thumbnail'] = 'required|image';
            $messages['image'] = 'Định dạng ảnh không phù hợp';
        }
        if (empty($request->id) || $request->file('file_upload')) {
            $rules['file_upload'] = 'required';
            $messages['required'] = 'Không được để trống';
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return [
                'status' => 400,
                'message' => $validator->messages()->first(),
                'data' => null
            ];
        }
        return false;
    }

    private function getOnlyData($request)
    {
        $uploadPath = '/home/netbee.vn/html/static/uploads/document/';
        $response = [
            'title' => $request->title,
            'content' => $request->content,
            'status' => 0,
            'count_download' => 0,
            'link_document' => $request->link_document,
            'updated_at' => Carbon::now()
        ];

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileInfo = pathinfo($file->getClientOriginalName());
            $image = time().'.'.seoname($fileInfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
            $response['thumbnail'] = $image;
            $file->move($uploadPath, $image);
            if (empty($request->id)) {
                $response['id_user'] = Auth::user()->id;
                $response['created_at'] = Carbon::now();
            } else {
                $document = $this->getDocumentById($request->id)->first();
                if(file_exists($uploadPath.$document->thumbnail)){
                    unlink($uploadPath.$document->thumbnail);
                }
            }
        }
        if ($request->file('filepdf')) {
            $files = $request->file('filepdf');
            $filesInfo = pathinfo($files->getClientOriginalName());
            $fileDoc = time().'.'.seoname($filesInfo['filename']).'.'.strtoupper($files->getClientOriginalExtension());
            $response['file_upload'] = $fileDoc;
            $files->move($uploadPath, $fileDoc);
            if (empty($request->id)) {
                $response['id_user'] = Auth::user()->id;
                $response['created_at'] = Carbon::now();
            } else {
                $document = $this->getDocumentById($request->id)->first();
                if(file_exists($uploadPath.$document->file_upload)){
                    unlink($uploadPath.$document->file_upload);
                }
            }
        }
        return $response;
    }
    public function searchDocument($request)
    {
        $perPage = 6;
        $search = $request->search;
        $searchTitle = $request->searchTitle;
        $searchStatus = $request->searchStatus;
        $conditions = [];

        if($searchTitle != ''){
            $conditions[] = [
                'title',
                'LIKE',
                '%'.$searchTitle.'%'
            ];
        }
        if($searchStatus != ''){
            $conditions[] = [
                'status', '=', $searchStatus
            ];
        }

        $query = $this->document->whereDeleted(self::INACTIVE);
        if (Auth::user()->role != self::ROLE_ADMIN) {
            $query->whereUserCreated(Auth::user()->id);
        }
        if (!empty($conditions)) {
            $query->where($conditions);
        }
        if ($search != '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', '%'.$search.'%')
                    ->orWhere('id','LIKE', '%'.$search.'%');
            });
        }
        return $query->orderBy('id', 'DESC')->paginate($perPage);
    }
    public function getDocumentDetailClient($id)
    {
        $document = $this->getDocumentById($id)->with(['user' => function ($q) {
            $q->select('id', 'name');
        }])->first();
        return [
            'status'=> 200,
            'message' => 'Thành công',
            'data' => $document
        ];
    }

    public function getDocumentClient( )
    {
      
        $query = $this->document
        ->whereStatus(self::ACTIVE)
        ->whereDeleted(self::INACTIVE)
        ->orderBy('updated_at', 'DESC')
        ->get();
        return [
            'status'=> 200,
            'message' => 'Thành công',
            'data' => $query
        ];
    }
}
