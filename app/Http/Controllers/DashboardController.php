<?php

namespace App\Http\Controllers;

use App\Models\AmbulanceInfo;
use App\Models\ERequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Dashboard - Analytics
  public function dashboardAnalytics()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-analytics', ['pageConfigs' => $pageConfigs]);
  }

  // Dashboard - Ecommerce
  public function dashboardEcommerce()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('/content/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
  }

    public function count_ambulances()
    {
        $count_ambulances = AmbulanceInfo::all()->count();
        return response()->json($count_ambulances);
    }

    public function count_request()
    {
        $count_request = ERequest::all()->count();
        return response()->json($count_request);
    }
}
