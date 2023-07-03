<h2>【{{$details['shop_name']}}】 予約受付のお知らせ</h2>
<br>
<p>予約を受け付けました。</p>
<br>
<p>店舗名：{{$details['shop_name']}}</p>
<p>予約番号：{{$details['reservation_code']}}</p>
<p>予約日時：{{$details['reservation_time']}}</p>
<p>予約者名：{{$details['last_name'] . " " . $details['first_name']}}</p>
<p>電話番号：{{$details['client_phone']}}</p>
<p>メールアドレス：{{$details['client_email']}}</p>
<p>メニュー：{{$details['menu']}}</p>
<p>料金：{{$details['price']}}</p>
<p>ご要望：{{$details['note']}}</p>
