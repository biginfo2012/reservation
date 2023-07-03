<h2>【{{$details['shop_name']}}】 予約完了のお知らせ</h2>
<p>{{$details['last_name']. " " . $details['first_name']}}さま</p>
<br>
<p>予約の受付が完了しました。以下が予約の詳細になります。</p>
<br>
<p>店舗：{{$details['shop_name']}}</p>
<p>予約番号：{{$details['reservation_code']}}</p>
<p>予約日時：{{$details['reservation_time']}}</p>
<p>メニュー：{{$details['menu']}}</p>
<p>料金：{{$details['price']}}</p>
<p>ご要望：{{$details['note']}}</p>
<br>
<p>ご来店をお待ちしております。<br>ご不明な点などござましたら、<br>下記の電話番号にご連絡下さい。</p>
<br>
<p>{{$details['shop_name']}}</p>
<p>{{$details['shop_address']}}</p>
<p>電話　{{$details['shop_phone']}}</p>
<br>
<p>■ご注意<br>
    ※予約のキャンセルを行う場合は、下記URLからキャンセル処理を行って下さい。<br>
    尚、予約の変更を行う場合は当予約のキャンセルを行ってから再度予約を行って頂きます様お願い申し上げます。
</p>
<p>{{route('reservation-cancel', $details['reservation_code'])}}</p>
<br>
<p>※ご予約をキャンセルされる場合は {{$details['cancel_time']}} までにお願いします。</p>
<br>
<p>※本メールに返信されましても、店舗にメールは届きません。<br>
    店舗へのご質問やご要望などありましたら、ご予約を頂いた店舗へ直接お問い合わせ下さい。</p>
