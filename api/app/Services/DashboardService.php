<?php
namespace App\Services;

use JWTAuth;
use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use App\Models\NbJoblist;
use App\Models\ProfileUser;

class DashboardService extends BaseService {

    protected $nbJobList;
    protected $profileUser; 

    const
        ACTION = 0,
        NOACTION = 1;

    public function __construct(NbJoblist $nbJobList, ProfileUser $profileUser)
    {
        $this->nbJobList = $nbJobList;
        $this->profileUser = $profileUser; 
    }

    public function fetchTopReferrers()
    {
        $startDate = Carbon::now()->subYear(10);
        $endDate = Carbon::now()->format('d-m-Y');
        return Analytics::fetchTopReferrers(Period::create($startDate, $endDate), 20);
    }
    public function fetchTotalVisitorsAndPageViews(int $day)
    {
        $startDate = Carbon::now()->subDays($day);
        $endDate = Carbon::now()->format('d-m-Y');
        return Analytics::fetchTotalVisitorsAndPageViews(Period::create($startDate, $endDate));
    }
    public function fetchTopBrowsers()
    {
        $startDate = Carbon::now()->subYear(10);
        $endDate = Carbon::now()->format('d-m-Y');
        return Analytics::performQuery(Period::create($startDate, $endDate),'ga:sessions',['dimensions'=>'ga:deviceCategory']);
    }
    public function fetchTopCountry()
    {
        $startDate = Carbon::now()->subYear(10);
        $endDate = Carbon::now()->format('d-m-Y');
        return Analytics::performQuery(Period::create($startDate, $endDate),'ga:sessions',['dimensions'=>'ga:country']);
    }
    public function countPageView()
    {
        $startDate = Carbon::now()->subYear(10);
        $endDate = Carbon::now()->format('d-m-Y');
        return Analytics::performQuery(Period::create($startDate, $endDate),'ga:pageviews');
    }

    public function countJob()
    {
        return $this->nbJobList->where('deleted', self::INACTIVE)->count();
    }

    public function countUserUT()
    {
        return $this->profileUser->where('deleted', self::INACTIVE)->count();
    }
}
