<script>
    $(document).ready( function () {
        var table = $('#main-table').DataTable({
            "serverSide": true,
            scrollY: 600,
            select: 'single',

            "columns": [
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'other'
                },
            ],

        });

        table.on('select', function (event, dt, type, indexes) {
            var id = table.rows( indexes ).data().pluck( 'id' )[0];

            console.log(id);
            alert('Selected row no ' + id);

        } );

    } );
</script>


<table
        id="main-table"
        class="table table-hover table-condensed table-striped table-bordered"
        data-ajax="{{ route('larapanel.admin.table.data', ['panel'=>$panel, 'key' => $key]) }}"
        >
    <thead>
        <tr>
            <th>
                Name
            </th>
            <th>
                Email
            </th>
            <th>
                Other
            </th>
        </tr>
    </thead>
</table>