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
}
