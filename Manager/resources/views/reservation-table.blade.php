<table class="table table-separate table-head-custom table-checkable" id="table">
    <thead>
    <tr>
        <th class="text-center">{{__('reservation')}}ID</th>
        <th class="text-center">{{__('shop-name')}}</th>
        <th class="text-center">{{__('client-name')}}</th>
        <th class="text-center">{{__('phone-number')}}</th>
        <th class="text-center">{{__('email')}}</th>
        <th class="text-center">{{__('diagnosis')}}</th>
        <th class="text-center">{{__('time')}}</th>
        <th class="text-center">{{__('price')}}</th>
        <th class="text-center">{{__('request')}}</th>
        <th class="text-center">{{__('detail')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $index => $item)
        <tr>
            <td class="p-0 border text-center align-middle">{{$item['reservation_code']}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['shop']['shop_name']}}</td>
            <td class="p-0 border text-left align-middle px-1 text-ellipsis">{{$item['client']['last_name'] . $item['client']['first_name']}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['client']['phone']}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['client']['email']}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['client']['is_first'] == 1 ? __('first') : __('twice')}}</td>
            <td class="p-0 border text-left align-middle px-1">{{date('Y/m/d H:i', strtotime($item['reservation_time']))}}</td>
            <td class="p-0 border text-center align-middle">price</td>
            <td class="p-0 border text-left align-middle px-1 whitespace-nowrap overflow-hidden" style="text-overflow: ellipsis">{{$item['note']}}</td>
            <td class="p-0 border text-center align-middle">
                <a href="{{route('reservation-edit', $item['id'])}}" class="btn btn-outline-dark waves-effect ex_change edit-shop"
                   style="padding: 8px; margin: 5px;">{{__('edit')}}</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
