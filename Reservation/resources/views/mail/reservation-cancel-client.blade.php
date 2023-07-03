<h2>【{{$details['shop_name']}}】 予約キャンセルのお知らせ</h2>
<p>{{$details['last_name']. " " . $details['first_name']}}さま</p>
<br>
<p>予約をキャンセルしました。以下キャンセルした予約の詳細になります。</p>
<br>
<p>店舗：{{$details['shop_name']}}</p>
<p>予約番号：{{$details['reservation_code']}}</p>
<p>予約日時：{{$details['reservation_time']}}</p>
<p>メニュー：{{$details['menu']}}</p>
<p>料金：{{$details['price']}}</p>
<br>
<p>■ご注意<br>
    ※本メールに返信されましても、店舗にメールは届きません。<br>
    店舗へのご質問やご要望などありましたら、ご予約を頂いた店舗へ直接お問い合わせ下さい。
</p>
<br>
<p>{{$details['shop_name']}}</p>
<p>{{$details['shop_address']}}</p>
<p>電話　{{$details['shop_phone']}}</p>
