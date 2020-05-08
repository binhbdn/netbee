<?php
namespace App\Services;

use App\Models\NbJobView;
use App\Models\News;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class NewsService extends BaseService{

    protected $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function getNewsById($id)
    {
        return $this->news->whereId($id);
    }

    public function getNews()
    {
        $perPage = 6;
        try {
            $query = $this->news->whereDeleted(0);
            if (Auth::user()->role != UserService::ROLE_ADMIN) {
                $query->whereUserCreated(Auth::user()->id);
            }
            $news = $query->orderBy('id', 'DESC')->paginate($perPage);
            return [
                'status'=> 200,
                'message' => 'Thành công', '
                data' => $news
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
        return $this->getNewsById($id)->update($data);
    }

    public function changeStatus($idNews)
    {
        try {
            $news = $this->getNewsById($idNews)->first();
            if($news) {
                $data = [
                    'status' => !$news->status,
                    'updated_at' => Carbon::now()
                ];
                return [
                    'status'=> 200,
                    'message' => 'Thay đổi trạng thái thành công',
                    'data' => $this->update($data, $idNews)
                ];
            }
            return [
                'status'=> 400,
                'message' => 'Tin không tồn tại',
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
                'message' => 'Bạn chưa chọn tin!',
                'data' => null
            ];
        }
        $ids = json_decode($request->id);
        $status = $request->status;
        try {
            $message = $status ? 'Kích hoạt thành công' : 'Bỏ kích hoạt thành công';
            $this->news->whereIn('id', $ids)->update([
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

    public function destroy($id)
    {
        try {
            $newsExists = $this->getNewsById($id)->exists();
            if($newsExists) {
                $data = [
                    'deleted' => self::ACTIVE,
                    'updated_at' => Carbon::now()
                ];
                return [
                    'status'=> 200,
                    'message' => 'Xóa tin thành công',
                    'data' => $this->update($data, $id)
                ];
            }
            return [
                'status'=> 400,
                'message' => 'Tin không tồn tại',
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
                'message' => 'Bạn chưa chọn tin!',
                'data' => null
            ];
        }
        $ids = json_decode($data->id);
        try {
            $this->news->whereIn('id', $ids)->update([
                'deleted' => self::ACTIVE,
                'updated_at' =>  Carbon::now()
            ]);
            return [
                'status'=> 200,
                'message' => 'Xóa tin thành công',
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
        $validate = $this->newsValidate($request);
        if (!empty($validate)) {
            return $validate;
        }
        $data = $this->getOnlyData($request);
        try {
            $this->news->insert($data);
            return [
                'status' => 200,
                'message' => 'Tạo tin thành công',
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

    public function updateNews($request)
    {
        $id = $request->id;
        $newsExists = $this->getNewsById($id)->exists();
        if (!$newsExists) {
            return [
                'status'=> 400,
                'message' => 'Tin đã bị xóa',
                'data' => null
            ];
        }
        $validate = $this->newsValidate($request);
        if (!empty($validate)) {
            return $validate;
        }
        $data = $this->getOnlyData($request);
        try {
            $this->update($data, $id);
            return [
                'status' => 200,
                'message' => 'Tạo tin thành công',
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

    private function newsValidate($request)
    {
        $rules = [
            'content' => 'required',
            'title' => 'required',
            'short_content' => 'required',
            'id_category' => 'required',
        ];
        $messages = [
            'required' => 'Không được để trống',
        ];

        if (empty($request->id) || $request->file('thuml')) {
            $rules['thuml'] = 'required|image';
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
        $uploadPath = '/home/netbee.vn/html/static/uploads/news/';
        $response = [
            'title' => $request->title,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'id_category' => $request->id_category,
            'updated_at' => Carbon::now()
        ];

        if ($request->file('thuml')) {
            $file = $request->file('thuml');
            $fileInfo = pathinfo($file->getClientOriginalName());
            $image = time().'.'.seoname($fileInfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
            $response['thuml'] = $image;
            $file->move($uploadPath, $image);
            if (empty($request->id)) {
                $response['user_created'] = Auth::user()->id;
                $response['created_at'] = Carbon::now();
            } else {
                $news = $this->getNewsById($request->id)->first();
                if(file_exists($uploadPath.$news->thuml)){
                    unlink($uploadPath.$news->thuml);
                }
            }
        }
        return $response;
    }

    public function searchNews($request)
    {
        $perPage = 6;
        $search = $request->search;
        $searchTitle = $request->searchTitle;
        $searchCategory = $request->searchCategory;
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
                'status' => $searchStatus
            ];
        }
        if($searchCategory != ''){
            $conditions[] = [
                'id_category' => $searchCategory
            ];
        }

        $query = $this->news->whereDeleted(self::INACTIVE);
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

    public function getNewsClient($request, $paginate = false)
    {
        $query = $this->news->whereStatus(self::ACTIVE)
            ->whereDeleted(self::INACTIVE)
            ->whereHas('user', function($q) {
                $q->whereBlock(self::INACTIVE);
            });
        if (!empty($request->category)) {
            $query->whereIdCategory($request->category);
        }
        if (!empty($request->limit)) {
            $query->limit($request->limit);
        }
        $query->orderBy('id', 'DESC');
        $news = $paginate ? $query->paginate($paginate) : $query->get();
        $news->makeHidden(['content']);
        return [
            'status'=> 200,
            'message' => 'Thành công',
            'data' => [
                'tintuc' => $news
            ]
        ];
    }

    public function getNewsDetailClient($id)
    {
        $news = $this->getNewsById($id)->with(['user' => function ($q) {
            $q->select('id', 'name');
        }])->first();
        return [
            'status'=> 200,
            'message' => 'Thành công',
            'data' => $news
        ];
    }
}
