@extends('layouts.app')

@section('page_content')
<meta name="csrf-token" content="{{ csrf_token() }}">


<div class="card mb-4">
    <div class="card-header">Manage Groups</div>
    <div class="card-body">

        <form id="createGroup" class="mb-3">
            <div class="input-group">
                <input class="form-control" name="name" placeholder="Group name" required>
                <button class="btn btn-dark">Add Group</button>
            </div>
        </form>

        <table class="table table-bordered" id="groupTable">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Group Name</th>
                    <th width="220">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groups as $group)
                <tr data-id="{{ $group->id }}">
                    <td class="order">{{ $group->order }}</td>
                    <td>
                        <input class="form-control"
                            value="{{ $group->name }}"
                            disabled>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-secondary up">↑</button>
                        <button class="btn btn-sm btn-secondary down">↓</button>
                        <button class="btn btn-sm btn-warning edit">Edit</button>
                        <button class="btn btn-sm btn-success update d-none">Update</button>
                        <button class="btn btn-sm btn-danger delete">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>



<div class="card mb-4">








    <div class="card mb-4">
        <div class="card-header">Create Fields</div>
        <div class="card-body">
            <form id="createField">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Field Label</label>
                        <input class="form-control col" name="label" placeholder="Label" required>
                        <br />
                    </div>
                    <div class="col-sm-6">
                        <label>DB Name</label>

                        <input class="form-control col" name="name" placeholder="DB Name" required>
                        <br />
                    </div>
                    <div class="col-sm-6">

                        <label>Field Type</label>

                        <select class="form-control col" name="type">
                            <option>text</option>
                            <option>email</option>
                            <option>number</option>
                            <option>textarea</option>
                            <option>select</option>
                            <option>checkbox</option>
                            <option>radio</option>
                        </select>

                        <br />

                    </div>

                    <div class="col-sm-6">

                        <label>Placeholder</label>

                        <input class="form-control col" name="placeholder" placeholder="Placeholder">
                        <br />

                    </div>
                    <div class="col-sm-6">
                        <label>Options</label>
                        <input class="form-control col" name="options" placeholder="Options (a,b,c)">

                        <br />
                    </div>
                    <div class="col-sm-6">
                        <label>Field Group</label>

                        <select class="form-control" name="field_group_id">
                            <option value="">No Group</option>
                            @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>

                    </div>

                </div>

                <div class="mt-2">
                    <label>
                        <input type="checkbox" name="required"> Required
                    </label>
                </div>

                <button class="btn btn-primary mt-2">Save</button>
            </form>
        </div>
    </div>
    <table class="table table-bordered" id="fieldsTable">
        <thead>


            <th width="50">#</th>
            <th>Label</th>
            <th>Type</th>
            <th>Group</th>
            <th width="220">Action</th>

        </thead>

        <tbody>

            @foreach($fields as $field)


            <tr data-id="{{ $field->id }}" data-group="{{ $field->field_group_id }}">
                <td class="order">{{ $field->order }}</td>

                <td>
                    <input class="form-control" value="{{ $field->label }}" disabled>
                </td>

                <td>
                    <select class="form-control" disabled>
                        @foreach(['text','email','number','textarea','select','checkbox','radio'] as $t)
                        <option {{ $field->type==$t?'selected':'' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <select class="form-control" disabled>
                        <option value="">None</option>
                        @foreach($groups as $group)
                        <option value="{{ $group->id }}"
                            {{ $field->field_group_id==$group->id?'selected':'' }}>
                            {{ $group->name }}
                        </option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <button class="btn btn-sm btn-secondary field-up">↑</button>
                    <button class="btn btn-sm btn-secondary field-down">↓</button>
                    <button class="btn btn-sm btn-warning edit">Edit</button>
                    <button class="btn btn-sm btn-success update d-none">Update</button>
                    <button class="btn btn-sm btn-danger delete">Delete</button>
                </td>
            </tr>

            @endforeach

        </tbody>

    </table>










</div>



@endsection

@section('page_scripts')


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var admin = "/admin";






    /* CREATE */
    $('#createField').submit(function(e) {
        e.preventDefault();
        $.post(admin + '/form-fields', $(this).serialize(), function(field) {
            location.reload();
        });
    });

    /* EDIT MODE */
    $('.edit').click(function() {
        let row = $(this).closest('tr');
        row.find('input, select').prop('disabled', false);
        row.find('.edit').addClass('d-none');
        row.find('.update').removeClass('d-none');
    });

    /* UPDATE */
    $('.update').click(function() {
        let row = $(this).closest('tr');
        let id = row.data('id');

        let data = {
            label: row.find('input:eq(0)').val(),
            type: row.find('select').val(),
            required: row.find('input[type=checkbox]').is(':checked'),
            options: row.find('input:eq(1)').val(),
            field_group_id: row.find('select:eq(1)').val(),
            _method: 'PUT'
        };

        $.post(admin + '/form-fields/' + id, data, function() {
            row.find('input, select').prop('disabled', true);
            row.find('.update').addClass('d-none');
            row.find('.edit').removeClass('d-none');
        });
    });

    /* DELETE */
    $('.delete').click(function() {
        if (!confirm('Delete this field?')) return;

        let row = $(this).closest('tr');
        let id = row.data('id');

        $.ajax({
            url: admin + '/form-fields/' + id,
            type: 'DELETE',
            success: function() {
                row.remove();
            }
        });
    });

    $('#createGroup').submit(function(e) {
        e.preventDefault();
        $.post(admin + '/field-groups', $(this).serialize(), function() {
            location.reload();
        });
    });
</script>

<!-- order fields  -->

<script>
    /* MOVE FIELD UP / DOWN */
    $('#fieldsTable').on('click', '.field-up, .field-down', function() {

        let row = $(this).closest('tr');
        let groupId = row.data('group');

        let target = $(this).hasClass('field-up') ?
            row.prevAll(`tr[data-group="${groupId}"]`).first() :
            row.nextAll(`tr[data-group="${groupId}"]`).first();

        if (target.length) {
            $(this).hasClass('field-up') ?
                target.before(row) :
                target.after(row);

            updateFieldOrder(groupId);
        }
    });

    /* SAVE FIELD ORDER */
    function updateFieldOrder(groupId) {

        let orders = {};

        $('#fieldsTable tbody tr').each(function(index) {
            if ($(this).data('group') == groupId) {
                let id = $(this).data('id');
                $(this).find('.order').text(index + 1);
                orders[id] = index + 1;
            }
        });

        $.post(admin + '/form-fields/reorder', {
            orders
        });
    }
</script>

<!-- group code -->


<script>
    /* CSRF */


    /* CREATE GROUP */
    $('#createGroup').submit(function(e) {
        e.preventDefault();
        $.post(admin + '/field-groups', $(this).serialize(), function() {
            location.reload();
        });
    });

    /* EDIT MODE */
    $('#groupTable').on('click', '.edit', function() {
        let row = $(this).closest('tr');
        row.find('input').prop('disabled', false);
        row.find('.edit').addClass('d-none');
        row.find('.update').removeClass('d-none');
    });

    /* UPDATE */
    $('#groupTable').on('click', '.update', function() {
        let row = $(this).closest('tr');
        let id = row.data('id');

        $.ajax({
            url: admin + '/field-groups/' + id,
            type: 'PUT',
            data: {
                name: row.find('input').val()
            },
            success: function() {
                row.find('input').prop('disabled', true);
                row.find('.update').addClass('d-none');
                row.find('.edit').removeClass('d-none');
            }
        });
    });

    /* DELETE */
    $('#groupTable').on('click', '.delete', function() {
        if (!confirm('Delete this group?')) return;

        let row = $(this).closest('tr');
        let id = row.data('id');

        $.ajax({
            url: admin + '/field-groups/' + id,
            type: 'DELETE',
            success: function() {
                row.remove();
                updateOrder();
            }
        });
    });

    /* MOVE UP / DOWN */
    $('#groupTable').on('click', '.up, .down', function() {
        let row = $(this).closest('tr');

        if ($(this).hasClass('up')) {
            row.prev().before(row);
        } else {
            row.next().after(row);
        }

        updateOrder();
    });

    /* SAVE ORDER */
    function updateOrder() {
        let orders = {};

        $('#groupTable tbody tr').each(function(index) {
            let id = $(this).data('id');
            $(this).find('.order').text(index + 1);
            orders[id] = index + 1;
        });

        $.post(admin + '/field-groups/reorder', {
            orders
        });
    }
</script>



@endsection