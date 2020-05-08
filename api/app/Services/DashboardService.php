<?php
namespace App\Services;

use JWTAuth;
use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class DashboardService extends BaseService {

    public function fetchTopReferrers()
    {
        $startDate = Carbon::now()->subYear(10);
        $endDate = Carbon::now();
        return Analytics::fetchTopReferrers(Period::create($startDate, $endDate), 20);
    }
    public function fetchTotalVisitorsAndPageViews(int $day)
    {
        $startDate = Carbon::now()->subDays($day);
        $endDate = Carbon::now();
        return Analytics::fetchTotalVisitorsAndPageViews(Period::create($startDate, $endDate));
    }
    public function fetchTopBrowsers()
    {
        $startDate = Carbon::now()->subYear(10);
        $endDate = Carbon::now();
        return Analytics::performQuery(Period::create($startDate, $endDate),'ga:sessions',['dimensions'=>'ga:deviceCategory']);
    }
    public function fetchTopCountry()
    {
        $startDate = Carbon::now()->subYear(10);
        $endDate = Carbon::now();
        return Analytics::performQuery(Period::create($startDate, $endDate),'ga:sessions',['dimensions'=>'ga:country']);
    }
    public function countPageView()
    {
        $startDate = Carbon::now()->subYear(10);
        $endDate = Carbon::now();
        return Analytics::performQuery(Period::create($startDate, $endDate),'ga:pageviews');
    }
}
