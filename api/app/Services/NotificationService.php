<?php
namespace App\Services;

use Auth;
use App\Models\NbNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NotificationService extends BaseService {

    protected $nbNotification;

    public function __construct(NbNotification $nbNotification)
    {
        $this->nbNotification = $nbNotification;
    }

    private function notificationValid()
    {
        $userId = Auth::user()->id;
        return $this->nbNotification->whereIdRecever($userId);
    }

    public function index()
    {
        $response['notifications'] = $this->notificationValid()
            ->orderBy('status_notification', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->paginate(7);

        $response['countNotRead'] = $this->notificationValid()
            ->whereStatusNotification(self::INACTIVE)
            ->count();

        return [
            'status'=> 200,
            'message' => 'Thành công',
            'data' => $response
        ];
    }

    public function store($content = null, $idRecever = null,  $url = null)
    {
        $insert = [
            'content' => $content,
            'id_recever' => $idRecever,
            'url' => $url,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        try {
            $this->nbNotification->insert($insert);
            return [
                'status' => 200,
                'message' => 'View thành công',
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

    public function updateById($id)
    {
        try {
            $this->nbNotification->whereIdNotification($id)->update([
                'status_notification' => self::ACTIVE,
                'updated_at' => Carbon::now()
            ]);
            return [
                'status' => 200,
                'message' => 'View thành công',
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

    public function updateByRecever()
    {
        try {
            $this->nbNotification->whereIdRecever(Auth::user()->id)->update([
                'status_notification' => self::ACTIVE,
                'updated_at' => Carbon::now()
            ]);
            return [
                'status' => 200,
                'message' => 'View thành công',
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
