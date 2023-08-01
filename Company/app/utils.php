<?php
use Illuminate\Support\Facades\Mail;

//function sendReservationCompleteClientEmail($details, $email){
//    Mail::to($email)->send(new \App\Mail\SendReservationCompleteClientEmail($details));
//}
//function sendReservationCompleteShopEmail($details, $email){
//    Mail::to($email)->send(new \App\Mail\SendReservationCompleteShopEmail($details));
//}
//function sendReservationCompleteManagerEmail($details, $email){
//    Mail::to($email)->send(new \App\Mail\SendReservationCompleteManagerEmail($details));
//}
//function sendReservationChangeShopEmail($details, $email){
//    Mail::to($email)->send(new \App\Mail\SendReservationChangeShopEmail($details));
//}
//function sendReservationChangeManagerEmail($details, $email){
//    Mail::to($email)->send(new \App\Mail\SendReservationChangeManagerEmail($details));
//}
function sendReservationCancelClientEmail($details, $email){
    Mail::to($email)->send(new \App\Mail\SendReservationCancelClientEmail($details));
}
function sendReservationCancelShopEmail($details, $email){
    Mail::to($email)->send(new \App\Mail\SendReservationCancelShopEmail($details));
}
function sendReservationCancelManagerEmail($details, $email){
    Mail::to($email)->send(new \App\Mail\SendReservationCancelManagerEmail($details));
}
//function sendReservationPreviousConfirmEmail($details, $email){
//    Mail::to($email)->send(new \App\Mail\SendReservationPreviousConfirmEmail($details));
//}
