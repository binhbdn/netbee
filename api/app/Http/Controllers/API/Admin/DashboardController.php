<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Services\UserService;
use Auth;
use Validator;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService, UserService $userService)
    {
        $this->dashboardService = $dashboardService;
        $this->userService = $userService;
    }

    public function getAnalytic(Request $request)
    {
        $data['fetchTopReferrers'] = $this->dashboardService->fetchTopReferrers();
        $data['fetchTotalVisitorsAndPageViews'] = $this->dashboardService->fetchTotalVisitorsAndPageViews($request->day ?? 7);
        $data['fetchTopBrowsers'] = $this->dashboardService->fetchTopBrowsers();
        $data['fetchTopCountry'] = $this->dashboardService->fetchTopCountry();
        $data['countPageView'] = $this->dashboardService->countPageView();
        $data['countUserHr'] = $this->userService->countUser(3);
        $data['countUserCompany'] = $this->userService->countUser(2);
        $data['countUserUser'] = $this->userService->countUser(1);
        return response()->json($data);
    }

}
