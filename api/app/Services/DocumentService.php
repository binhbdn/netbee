<?php
namespace App\Services;

use App\Models\Document;
use Carbon\Carbon;
use Auth;
use Validator;

class DocumentService extends BaseService{

    protected $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function getDocuments()
    {
        $perPage = 6;
        try {
            $query = $this->document;
            if (Auth::user()->role != UserService::ROLE_ADMIN) {
                $query->whereUserCreated(Auth::user()->id);
            }
            $document = $query->orderBy('id', 'DESC')->paginate($perPage);
            return [
                'status'=> 200,
                'message' => 'Thành công', '
                data' => $document
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function getDocumentById($id)
    {
        return $this->document->whereId($id)->first();
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

    public function updateDocument($request)
    {
        $id = $request->id;
        $newsExists = $this->getDocumentById($id)->exists();
        if (!$newsExists) {
            return [
                'status'=> 400,
                'message' => 'Tin đã bị xóa',
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

    public function update($data, $id)
    {
        return $this->getDocumentById($id)->update($data);
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

    private function documentValidate($request)
    {
        $rules = [
            'title' => 'required',
            'content' => 'required',
            'link_document' => 'required'
        ];
        $messages = [
            'required' => 'Không được để trống',
        ];

        if (empty($request->id) || $request->file('thumbnail')) {
            $rules['thumbnail'] = 'required|image';
            $messages['image'] = 'Định dạng ảnh không phù hợp';
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
                $news = $this->getDocumentById($request->id)->first();
                if(file_exists($uploadPath.$news->thumbnail)){
                    unlink($uploadPath.$news->thumbnail);
                }
            }
        }
        return $response;
    }
}
