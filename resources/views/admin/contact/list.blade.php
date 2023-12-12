@component('admin.component.content')
    @slot('title') Conatct List @endslot

    @slot('navigation')
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">List</li>
        </ol>
    @endslot

    @slot('addicon')

    @endslot

    @slot('content')
        <table class="table">
		        <thead>
		            <tr>
		                <th> SL </th>
		                <th> Name </th>
		                <th> Email </th>
		                <th> Mobile </th>
		                <th> Action </th>
		            </tr>
		        </thead>
		        <tbody>
		        </tbody>
		    </table>
    @endslot

    @slot('js')
        <script>
            $(function () {
		        var table = $('.table').DataTable({
		            processing: true,
		            serverSide: true,
		            ajax: "{{ route('admin.contact.list') }}",
		            columns: [
		                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
		                {data: 'name', name: 'name'},
		                {data: 'email', name: 'email'},
		                {data: 'number', name: 'number'},
		                {data: 'action',name: 'action',orderable: true,searchable: true},
		            ]
		        });
		    });
        </script>
    @endslot
@endcomponent
