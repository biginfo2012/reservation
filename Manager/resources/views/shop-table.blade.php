<table class="table table-separate table-head-custom table-checkable" id="table">
    <thead>
    <tr>
        <th class="text-center">{{__('shop')}}ID</th>
        <th class="text-center">{{__('shop-name')}}</th>
        <th class="text-center">{{__('address')}}</th>
        <th class="text-center">{{__('phone')}}</th>
        <th class="text-center">{{__('email')}}</th>
        <th class="text-center">{{__('represent')}}</th>
        <th class="text-center">{{__('phone')}}</th>
        <th class="text-center">{{__('action')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $index => $item)
        <tr>
            <td class="p-0 border text-center align-middle">{{$item['shop_code']}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['shop_name']}}</td>
            <td class="p-0 border text-left align-middle px-1 text-ellipsis">{{$item['address_1'] . $item['address_2']}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['phone']}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['user']['email']}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['represent']}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['represent_phone']}}</td>
            <td class="p-0 border text-center align-middle">
                <input type="hidden" value="{{$item['shop_name']}}" class="shop_name">
                <input type="hidden" value="{{$item['post_code']}}" class="post_code">
                <input type="hidden" value="{{$item['address_1']}}" class="address_1">
                <input type="hidden" value="{{$item['address_2']}}" class="address_2">
                <input type="hidden" value="{{$item['phone']}}" class="phone">
                <input type="hidden" value="{{$item['user']['email']}}" class="email">
                <input type="hidden" value="{{$item['represent']}}" class="represent">
                <input type="hidden" value="{{$item['represent_phone']}}" class="represent_phone">
                <input type="hidden" value="{{$item['note']}}" class="note">
                <button class="btn btn-outline-dark waves-effect ex_change edit-shop" style="padding: 8px; margin: 5px;"
                        data-id="{{$item['id']}}" data-code="{{$item['shop_code']}}">{{__('edit')}}</button>
                <button class="btn btn-outline-dark waves-effect ex_change delete-shop" style="padding: 8px; margin: 5px;" data-id="{{$item['id']}}">{{__('delete')}}</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
