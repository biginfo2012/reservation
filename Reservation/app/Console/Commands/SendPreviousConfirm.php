<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Console\Command;

class SendPreviousConfirm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-previous-confirm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email Previous Day Confirm';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tomorrow = date('Y-m-d', strtotime('tomorrow'));
        $reservations = Reservation::whereNull('deleted_at')->where('reservation_time', '>=', $tomorrow . " 00:00:00")->where('reservation_time', '<=', $tomorrow . " 23:59:59")->get();
        foreach ($reservations as $reservation){
            $client = Client::find($reservation->client_id);
            $shop = Shop::find($reservation->shop_id);
            $weeks = ['月', '火', '水', '木', '金', '土', '日'];
            $w_index = date('w', strtotime($reservation->reservation_time));
            $weekday = $weeks[$w_index];
            $reservation_time_str = date('Y年m月d日', strtotime($reservation->reservation_time)) . "(" . $weekday . ") " . date("H:i", strtotime($reservation->reservation_time));
            $menu = $reservation->menu;
            $menu_name = "";
            $menu_price = 0;
            $menu_price_over = false;
            $menu_price_ask = false;
            foreach ($menu as $index => $item){
                if($index != count($menu) - 1){
                    $menu_name .= $item->menu->menu_name . ",";
                }
                else{
                    $menu_name .= $item->menu->menu_name;
                }
                $menu_price += $item->menu->price;
                if($item->menu->over){
                    $menu_price_over = true;
                }
                if($item->menu->ask){
                    $menu_price_ask = true;
                }
            }
            $menu_price = $menu_price_ask ? __('ask') : ($menu_price_over ? __('symbol-en') . number_format($menu_price) . "~" : __('symbol-en') . number_format($menu_price));
            $cancel_time = date('Y年m月d日H:i', strtotime($reservation->reservation_time . ' -2 hours'));
            $details = [
                'shop_name' => $shop->shop_name,
                'last_name' => $client->last_name,
                'first_name' => $client->first_name,
                'reservation_code' => $reservation->reservation_code,
                'reservation_time' => $reservation_time_str,
                'price' => $menu_price,
                'menu' => $menu_name,
                'shop_address' => $shop->address_1,
                'shop_phone' => $shop->phone,
                'note' => $reservation->note,
                'shop_id' => $reservation->shop_id,
                'cancel_time' => $cancel_time,
                'client_phone' => $client->phone,
                'client_email' => $client->email,
            ];
            sendReservationPreviousConfirmEmail($details, $client->email);
        }
        return 0;
    }
}
