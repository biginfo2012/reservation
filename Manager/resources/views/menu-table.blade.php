<table class="table table-separate table-head-custom table-checkable" id="table">
    <thead>
    <tr>
        <th class="text-center">ID</th>
        <th class="text-center">{{__('menu-name')}}</th>
        <th class="text-center">{{__('description')}}</th>
        <th class="text-center">{{__('price')}}</th>
        <th class="text-center">{{__('require-time')}}</th>
        <th class="text-center">{{__('display')}}</th>
        <th class="text-center">{{__('action')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $index => $item)
        <tr>
            <td class="p-0 border text-center align-middle">000000-{{$item['menu_code']}}</td>
            <td class="p-0 border text-left align-middle px-1">{{$item['menu_name']}}</td>
            <td class="p-0 border text-left align-middle px-1"><label class="text-hide">{{$item['description']}}</label></td>
            <td class="p-0 border text-center align-middle">{{$item['ask'] == 1 ? __('ask') : ($item['over'] == 1 ? number_format($item['price']) . __('en-char') . __('over') : number_format($item['price']) . __('en-char'))}}</td>
            <td class="p-0 border text-center align-middle">{{$item['require_time'] . __('min')}}</td>
            <td class="p-0 border text-center align-middle">
                <div class="ms-1 d-flex text-center">
                    <div class="form-check me-1">
                        <input type="radio" name="display_table_{{$item['id']}}" class="form-check-input display_table" {{$item['display'] == 1 ? "checked" : ""}} value="1"/>
                        <label class="form-check-label publish-status">{{__('on')}}</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="display_table_{{$item['id']}}" class="form-check-input display_table" {{$item['display'] == 0 ? "checked" : ""}} value="0"/>
                        <label class="form-check-label">{{__('off')}}</label>
                    </div>
                </div>
            </td>
            <td class="p-0 border text-center align-middle">
                <input type="hidden" value="{{$item['id']}}" class="id">
                <input type="hidden" value="{{$item['menu_name']}}" class="menu_name">
                <input type="hidden" value="{{$item['description']}}" class="description">
                <input type="hidden" value="{{$item['price']}}" class="price">
                <input type="hidden" value="{{$item['require_time']}}" class="require_time">
                <input type="hidden" value="{{$item['note']}}" class="note">
                <input type="hidden" value="{{$item['over']}}" class="over">
                <input type="hidden" value="{{$item['ask']}}" class="ask">
                <button class="btn btn-outline-dark waves-effect ex_change edit-menu" style="padding: 8px; margin: 5px;"
                        data-id="{{$item['id']}}" data-code="{{$item['menu_code']}}" data-display="{{$item['display']}}">{{__('edit')}}</button>
                <button class="btn btn-outline-dark waves-effect ex_change delete-menu" style="padding: 8px; margin: 5px;" data-id="{{$item['id']}}">{{__('delete')}}</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
