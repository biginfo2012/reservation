<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\Reservation;
use App\Models\Shop;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(){
        $data = Notification::where('status', 2)->orderBy('created_at', 'desc')->get()->take(3);
        $notifications = array();
        foreach ($data as $item){
            $tmp['id'] = $item->id;
            $tmp['title'] = $item->title;
            $tmp['content'] = $item->content;
            $tmp['publish_time'] = $item->publish_time;
            $nu = NotificationUser::where('user_id', Auth::user()->id)->where('notification_id', $item->id)->first();
            $tmp['status'] = empty($nu) ? 0 : 1;
            array_push($notifications, $tmp);
        }
        $shop_id = Shop::where('user_id', Auth::user()->id)->first()->id;
        // Get the current date
        $today = new DateTime();
        // Set the current date to last week
        $lastWeek = $today->modify('-2 week');
        // Get the last week's Monday
        $lastMonday = $lastWeek->modify('monday')->format('Y-m-d');
        // Get the last week's Sunday
        $lastSunday = $lastWeek->modify('sunday')->format('Y-m-d');
        $lastWeekData = Reservation::select('client_id')->whereNull('deleted_at')->where('shop_id', $shop_id)->where('reservation_time', '>=', $lastMonday . " 00:00:00")
            ->where('reservation_time', '<=', $lastSunday . " 23:59:59")->groupBy('client_id')->get();
        $lastWeekCnt = $lastWeekData->count();
        $lastWeekPrice = 0;
        foreach ($lastWeekData as $item){
            $client_id = $item->client_id;
            $lastWeekReservation = Reservation::with('menu')->whereNull('deleted_at')->where('reservation_time', '>=', $lastMonday . " 00:00:00")
                ->where('reservation_time', '<=', $lastSunday . " 23:59:59")->where('shop_id', $shop_id)->where('client_id', $client_id)->get();
            foreach ($lastWeekReservation as $reservation){
                foreach($reservation['menu'] as $reservation_menu) {
                    $lastWeekPrice += $reservation_menu['menu']['price'];
                }
            }
        }

        // Get the current date
        $today1 = new DateTime();
        $lastWeek = $today1->modify('-1 week');
        // Get the current week's Monday
        $thisMonday = $lastWeek->modify('monday')->format('Y-m-d');
        // Get the current week's Sunday
        $thisSunday = $lastWeek->modify('sunday')->format('Y-m-d');
        $thisWeekData = Reservation::select('client_id')->whereNull('deleted_at')->where('shop_id', $shop_id)->where('reservation_time', '>=', $thisMonday . " 00:00:00")
            ->where('reservation_time', '<=', $thisSunday . " 23:59:59")->groupBy('client_id')->get();
        $thisWeekCnt = $thisWeekData->count();
        $thisWeekPrice = 0;
        foreach ($thisWeekData as $item){
            $client_id = $item->client_id;
            $thisWeekReservation = Reservation::with('menu')->whereNull('deleted_at')->where('reservation_time', '>=', $thisMonday . " 00:00:00")
                ->where('reservation_time', '<=', $thisSunday . " 23:59:59")->where('shop_id', $shop_id)->where('client_id', $client_id)->get();
            foreach ($thisWeekReservation as $reservation){
                foreach($reservation['menu'] as $reservation_menu) {
                    $thisWeekPrice += $reservation_menu['menu']['price'];
                }
            }
        }

        $today2 = new DateTime();
        // Set the current date to next week
        $nextWeek = $today2;
        // Get the next week's Monday
        $nextMonday = $nextWeek->modify('monday')->format('Y-m-d');
        // Get the next week's Sunday
        $nextSunday = $nextWeek->modify('sunday')->format('Y-m-d');
        $nextWeekData = Reservation::select('client_id')->whereNull('deleted_at')->where('shop_id', $shop_id)->where('reservation_time', '>=', $nextMonday . " 00:00:00")
            ->where('reservation_time', '<=', $nextSunday . " 23:59:59")->groupBy('client_id')->get();
        $nextWeekCnt = $nextWeekData->count();
        $nextWeekPrice = 0;
        foreach ($nextWeekData as $item){
            $client_id = $item->client_id;
            $nextWeekReservation = Reservation::with('menu')->whereNull('deleted_at')->where('reservation_time', '>=', $nextMonday . " 00:00:00")
                ->where('reservation_time', '<=', $nextSunday . " 23:59:59")->where('shop_id', $shop_id)->where('client_id', $client_id)->get();
            foreach ($nextWeekReservation as $reservation){
                foreach($reservation['menu'] as $reservation_menu) {
                    $nextWeekPrice += $reservation_menu['menu']['price'];
                }
            }
        }

        // Get the first day of the last month
        $firstDayLastMonth = (new DateTime('first day of last month'))->format('Y-m-d');
        // Get the last day of the last month
        $lastDayLastMonth = (new DateTime('last day of last month'))->format('Y-m-d');
        $lastMonthData = Reservation::select('client_id')->whereNull('deleted_at')->where('shop_id', $shop_id)->where('reservation_time', '>=', $firstDayLastMonth . " 00:00:00")
            ->where('reservation_time', '<=', $lastDayLastMonth . " 23:59:59")->groupBy('client_id')->get();
        $lastMonthCnt = $lastMonthData->count();
        $lastMonthPrice = 0;
        foreach ($lastMonthData as $item){
            $client_id = $item->client_id;
            $lastMonthReservation = Reservation::with('menu')->whereNull('deleted_at')->where('reservation_time', '>=', $firstDayLastMonth . " 00:00:00")
                ->where('reservation_time', '<=', $lastDayLastMonth . " 23:59:59")->where('shop_id', $shop_id)->where('client_id', $client_id)->get();
            foreach ($lastMonthReservation as $reservation){
                foreach($reservation['menu'] as $reservation_menu) {
                    $lastMonthPrice += $reservation_menu['menu']['price'];
                }
            }
        }

        // Get the first day of this month
        $firstDayThisMonth = (new DateTime('first day of this month'))->format('Y-m-d');
        // Get the last day of this month
        $lastDayThisMonth = (new DateTime('last day of this month'))->format('Y-m-d');
        $thisMonthData = Reservation::select('client_id')->whereNull('deleted_at')->where('shop_id', $shop_id)->where('reservation_time', '>=', $firstDayThisMonth . " 00:00:00")
            ->where('reservation_time', '<=', $lastDayThisMonth . " 23:59:59")->groupBy('client_id')->get();
        $thisMonthCnt = $thisMonthData->count();
        $thisMonthPrice = 0;
        foreach ($thisMonthData as $item){
            $client_id = $item->client_id;
            $thisMonthReservation = Reservation::with('menu')->whereNull('deleted_at')->where('reservation_time', '>=', $firstDayThisMonth . " 00:00:00")
                ->where('reservation_time', '<=', $lastDayThisMonth . " 23:59:59")->where('shop_id', $shop_id)->where('client_id', $client_id)->get();
            foreach ($thisMonthReservation as $reservation){
                foreach($reservation['menu'] as $reservation_menu) {
                    $thisMonthPrice += $reservation_menu['menu']['price'];
                }
            }
        }

        // Get the first day of next month
        $firstDayNextMonth = (new DateTime('first day of next month'))->format('Y-m-d');
        // Get the last day of next month
        $lastDayNextMonth = (new DateTime('last day of next month'))->format('Y-m-d');
        $nextMonthData = Reservation::select('client_id')->whereNull('deleted_at')->where('shop_id', $shop_id)->where('reservation_time', '>=', $firstDayNextMonth . " 00:00:00")
            ->where('reservation_time', '<=', $lastDayNextMonth . " 23:59:59")->groupBy('client_id')->get();
        $nextMonthCnt = $nextMonthData->count();
        $nextMonthPrice = 0;
        foreach ($nextMonthData as $item){
            $client_id = $item->client_id;
            $nextMonthReservation = Reservation::with('menu')->whereNull('deleted_at')->where('reservation_time', '>=', $firstDayNextMonth . " 00:00:00")
                ->where('reservation_time', '<=', $lastDayNextMonth . " 23:59:59")->where('shop_id', $shop_id)->where('client_id', $client_id)->get();
            foreach ($nextMonthReservation as $reservation){
                foreach($reservation['menu'] as $reservation_menu) {
                    $nextMonthPrice += $reservation_menu['menu']['price'];
                }
            }
        }

        $date = date('Y-m-d');
        $table_data = Reservation::with('shop', 'client', 'menu')->whereNull('deleted_at')->where('shop_id', $shop_id)
            ->where('reservation_time', '>=', $date . " 00:00:00")->where('reservation_time', '<=', $date . " 23:59:59")
            ->orderBy('reservation_time')->get();
        return view('dashboard', compact('table_data', 'lastWeekCnt', 'lastWeekPrice', 'thisWeekCnt', 'thisWeekPrice', 'nextWeekCnt', 'nextWeekPrice',
            'lastMonthCnt', 'lastMonthPrice', 'thisMonthCnt', 'thisMonthPrice', 'nextMonthCnt', 'nextMonthPrice', 'notifications'));
    }
}
