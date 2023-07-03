<h2>【{{$details['shop_name']}}】 予約変更のお知らせ</h2>
<br>
<p>予約が変更されました。以下予約変更の詳細です。</p>
<br>
<p>変更前の予約内容</p>
<p>店舗：{{$details['shop_name1']}}</p>
<p>予約番号：{{$details['reservation_code1']}}</p>
<p>予約日時：{{$details['reservation_time1']}}</p>
<p>予約者名：{{$details['last_name1'] . " " . $details['first_name1']}}</p>
<p>電話番号：{{$details['client_phone1']}}</p>
<p>メールアドレス：{{$details['client_email1']}}</p>
<p>メニュー：{{$details['menu1']}}</p>
<p>料金：{{$details['price1']}}</p>
<p>ご要望：{{$details['note1']}}</p>
<br>
<p>変更後の予約内容</p>
<p>予約番号：{{$details['reservation_code']}}</p>
<p>予約日時：{{$details['reservation_time']}}</p>
<p>予約者名：{{$details['last_name'] . " " . $details['first_name']}}</p>
<p>電話番号：{{$details['client_phone']}}</p>
<p>メールアドレス：{{$details['client_email']}}</p>
<p>メニュー：{{$details['menu']}}</p>
<p>料金：{{$details['price']}}</p>
<p>ご要望：{{$details['note']}}</p>
