<table class="table table-separate table-head-custom table-checkable" id="table">
    <thead>
    <tr>
        <th class="text-center">ID</th>
        <th class="text-center">{{__('client-name')}}</th>
        <th class="text-center">{{__('sei')}}</th>
        <th class="text-center">{{__('mei')}}</th>
        <th class="text-center">{{__('phone-number')}}</th>
        <th class="text-center">{{__('email')}}</th>
        <th class="text-center">{{__('gender')}}</th>
        <th class="text-center">{{__('detail')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $index => $item)
        <tr>
            <td class="p-0 border text-center align-middle">{{$index}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['last_name'] . $item['first_name']}}</td>
            <td class="p-0 border text-left align-middle px-1 text-ellipsis">{{$item['sei']}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['mei']}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['email']}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['gender'] == 1 ? __('female') : __('male')}}</td>
            <td class="p-0 border text-center align-middle">
                <a href="{{route('client-edit', $item['id'])}}" class="btn btn-outline-dark waves-effect ex_change edit-shop"
                   style="padding: 8px; margin: 5px;">{{__('edit')}}</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
