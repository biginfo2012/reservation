<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(){
        // Get the current date
        $today = new DateTime();
        // Set the current date to last week
        $lastWeek = $today->modify('-2 week');
        // Get the last week's Monday
        $lastMonday = $lastWeek->modify('monday')->format('Y-m-d');
        // Get the last week's Sunday
        $lastSunday = $lastWeek->modify('sunday')->format('Y-m-d');
        $lastWeekData = Reservation::select('client_id')->whereNull('deleted_at')->where('reservation_time', '>=', $lastMonday . " 00:00:00")
            ->where('reservation_time', '<=', $lastSunday . " 23:59:59")->groupBy('client_id')->get();
        $lastWeekCnt = $lastWeekData->count();
        $lastWeekPrice = 0;
        foreach ($lastWeekData as $item){
            $client_id = $item->client_id;
            $lastWeekReservation = Reservation::with('menu')->whereNull('deleted_at')->where('reservation_time', '>=', $lastMonday . " 00:00:00")
                ->where('reservation_time', '<=', $lastSunday . " 23:59:59")->where('client_id', $client_id)->get();
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
        $thisWeekData = Reservation::select('client_id')->whereNull('deleted_at')->where('reservation_time', '>=', $thisMonday . " 00:00:00")
            ->where('reservation_time', '<=', $thisSunday . " 23:59:59")->groupBy('client_id')->get();
        $thisWeekCnt = $thisWeekData->count();
        $thisWeekPrice = 0;
        foreach ($thisWeekData as $item){
            $client_id = $item->client_id;
            $thisWeekReservation = Reservation::with('menu')->whereNull('deleted_at')->where('reservation_time', '>=', $thisMonday . " 00:00:00")
                ->where('reservation_time', '<=', $thisSunday . " 23:59:59")->where('client_id', $client_id)->get();
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
        $nextWeekData = Reservation::select('client_id')->whereNull('deleted_at')->where('reservation_time', '>=', $nextMonday . " 00:00:00")
            ->where('reservation_time', '<=', $nextSunday . " 23:59:59")->groupBy('client_id')->get();
        $nextWeekCnt = $nextWeekData->count();
        $nextWeekPrice = 0;
        foreach ($nextWeekData as $item){
            $client_id = $item->client_id;
            $nextWeekReservation = Reservation::with('menu')->whereNull('deleted_at')->where('reservation_time', '>=', $nextMonday . " 00:00:00")
                ->where('reservation_time', '<=', $nextSunday . " 23:59:59")->where('client_id', $client_id)->get();
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
        $lastMonthData = Reservation::select('client_id')->whereNull('deleted_at')->where('reservation_time', '>=', $firstDayLastMonth . " 00:00:00")
            ->where('reservation_time', '<=', $lastDayLastMonth . " 23:59:59")->groupBy('client_id')->get();
        $lastMonthCnt = $lastMonthData->count();
        $lastMonthPrice = 0;
        foreach ($lastMonthData as $item){
            $client_id = $item->client_id;
            $lastMonthReservation = Reservation::with('menu')->whereNull('deleted_at')->where('reservation_time', '>=', $firstDayLastMonth . " 00:00:00")
                ->where('reservation_time', '<=', $lastDayLastMonth . " 23:59:59")->where('client_id', $client_id)->get();
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
        $thisMonthData = Reservation::select('client_id')->whereNull('deleted_at')->where('reservation_time', '>=', $firstDayThisMonth . " 00:00:00")
            ->where('reservation_time', '<=', $lastDayThisMonth . " 23:59:59")->groupBy('client_id')->get();
        $thisMonthCnt = $thisMonthData->count();
        $thisMonthPrice = 0;
        foreach ($thisMonthData as $item){
            $client_id = $item->client_id;
            $thisMonthReservation = Reservation::with('menu')->whereNull('deleted_at')->where('reservation_time', '>=', $firstDayThisMonth . " 00:00:00")
                ->where('reservation_time', '<=', $lastDayThisMonth . " 23:59:59")->where('client_id', $client_id)->get();
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
        $nextMonthData = Reservation::select('client_id')->whereNull('deleted_at')->where('reservation_time', '>=', $firstDayNextMonth . " 00:00:00")
            ->where('reservation_time', '<=', $lastDayNextMonth . " 23:59:59")->groupBy('client_id')->get();
        $nextMonthCnt = $nextMonthData->count();
        $nextMonthPrice = 0;
        foreach ($nextMonthData as $item){
            $client_id = $item->client_id;
            $nextMonthReservation = Reservation::with('menu')->whereNull('deleted_at')->where('reservation_time', '>=', $firstDayNextMonth . " 00:00:00")
                ->where('reservation_time', '<=', $lastDayNextMonth . " 23:59:59")->where('client_id', $client_id)->get();
            foreach ($nextMonthReservation as $reservation){
                foreach($reservation['menu'] as $reservation_menu) {
                    $nextMonthPrice += $reservation_menu['menu']['price'];
                }
            }
        }

        $date = date('Y-m-d');
        $sql = "SELECT COUNT(c.id) AS client_cnt, s.id AS shopId, SUM(CASE WHEN c.is_first = 1 THEN 1 ELSE 0 END) AS first_cnt, SUM(CASE WHEN c.is_first = 0 THEN 1 ELSE 0 END) AS twice_cnt FROM reservations AS r
LEFT JOIN clients AS c ON c.id = r.client_id
LEFT JOIN shops AS s ON s.id = r.shop_id
WHERE DATE(r.reservation_time) = '" . $date . "' AND r.deleted_at IS NULL
GROUP BY shopId ORDER BY shopId";
        $table_data = DB::select($sql);
        $table_data = json_decode(json_encode($table_data, true), true);
        $arr = array();
        foreach ($table_data as $shop){
//            $tmp = new Object();
            $tmp['client_cnt'] = $shop['client_cnt'];
            $tmp['shopId'] = $shop['shopId'];
            $tmp['first_cnt'] = $shop['first_cnt'];
            $tmp['twice_cnt'] = $shop['twice_cnt'];


            $shop_id = $shop['shopId'];
            $shop_name = Shop::find($shop_id)->shop_name;
            $data = Reservation::with('shop', 'client', 'menu')->whereNull('deleted_at')->where('shop_id', $shop_id)
                ->where('reservation_time', '>=', $date . " 00:00:00")
                ->where('reservation_time', '<=', $date . " 23:59:59")
                ->get();
            $price = 0;
            foreach ($data as $item){
                foreach($item['menu'] as $reservation_menu) {
                    $price += $reservation_menu['menu']['price'];
                }
            }
            $tmp['price'] = $price;
            $tmp['shop_name'] = $shop_name;
            array_push($arr, $tmp);
        }
        $table_data = $arr;
        return view('dashboard', compact('table_data', 'lastWeekCnt', 'lastWeekPrice', 'thisWeekCnt', 'thisWeekPrice', 'nextWeekCnt', 'nextWeekPrice',
            'lastMonthCnt', 'lastMonthPrice', 'thisMonthCnt', 'thisMonthPrice', 'nextMonthCnt', 'nextMonthPrice'));
    }
}
