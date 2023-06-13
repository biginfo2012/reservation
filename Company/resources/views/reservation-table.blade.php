<table class="table table-separate table-head-custom table-checkable" id="table">
    <thead>
    <tr>
        <th class="text-center" width="15">{{__('reservation')}}ID</th>
        <th class="text-center" width="10">{{__('shop-name')}}</th>
        <th class="text-center" width="10">{{__('client-name')}}</th>
        <th class="text-center" width="10">{{__('phone-number')}}</th>
        <th class="text-center" width="15">{{__('email')}}</th>
        <th class="text-center" width="5">{{__('diagnosis')}}</th>
        <th class="text-center" width="10">{{__('time')}}</th>
        <th class="text-center" width="5">{{__('price')}}</th>
        <th class="text-center" width="15">{{__('request')}}</th>
        <th class="text-center" width="5">{{__('detail')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $index => $item)
        <tr>
            <td class="p-0 border text-center align-middle" width="15">{{$item['reservation_code']}}</td>
            <td class="p-0 border text-left align-middle px-1" width="10">{{$item['shop']['shop_name']}}</td>
            <td class="p-0 border text-left align-middle px-1 text-ellipsis" width="10">{{$item['client']['last_name'] . $item['client']['first_name']}}</td>
            <td class="p-0 border text-left align-middle px-1" width="10">{{$item['client']['phone']}}</td>
            <td class="p-0 border text-left align-middle px-1" width="15">{{$item['client']['email']}}</td>
            <td class="p-0 border text-left align-middle px-1" width="5">{{$item['client']['is_first'] == 1 ? __('first') : __('twice')}}</td>
            <td class="p-0 border text-center align-middle" width="10">@php
                    $require_time = 0;
                    foreach($item['menu'] as $reservation_menu) {
                        $require_time += $reservation_menu['menu']['require_time'];
                    }
                    echo $require_time
                @endphp</td>
            <td class="p-0 border text-center align-middle" width="5">
                @php
                    $price = 0;
                    foreach($item['menu'] as $reservation_menu) {
                        $price += $reservation_menu['menu']['price'];
                    }
                    echo number_format($price)
                @endphp
            </td>
            <td class="p-0 border text-left align-middle px-1 whitespace-nowrap overflow-hidden"
                style="overflow:hidden !important; white-space: nowrap; text-overflow: ellipsis" width="15">{{$item['note']}}</td>
            <td class="p-0 border text-center align-middle" width="5">
                <a href="{{route('reservation-edit', $item['id'])}}" class="btn btn-outline-dark waves-effect ex_change edit-shop"
                   style="padding: 8px; margin: 5px;">{{__('edit')}}</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
