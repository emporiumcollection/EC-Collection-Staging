<table class="table table-striped table-bordered table-hover table-checkable order-column" id="crmlayoutlist">
    <thead>
        <td>
            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                <span></span>
            </label>
        </td>
        <th>Template</th>
        <th>Date Created</th>
        <th>Action</th>
    </thead>
<tbody>
    @foreach($crmlayouts as $crmlayout)
    <tr>
        <td>
            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="checkboxes" value="1" />
                <span></span>
            </label>
        </td>
        <td>{!! $crmlayout->template_name !!}</td>
        <td><?php echo date('d M, Y', strtotime($crmlayout->created_at)); ?></td>
        <td>
            @if(isset($access['is_edit']) && $access['is_edit'] != 0)
            <a href="{{ url('admin/crmlayouts/'.$crmlayout->template_id.'/edit/') }}" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> </a>
            @endif
            @if(isset($access['is_detail']) && $access['is_detail'] != 0)
            <a href="{{ url('admin/crmlayouts/delete/'.$crmlayout->template_id) }}" class="btn btn-sm btn-default btn-circle " data-action="remove" ><i class="fa fa-remove"></i> </a>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
</table>