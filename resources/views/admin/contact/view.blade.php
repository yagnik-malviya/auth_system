@component('admin.component.content')
    @slot('title') Conatct View @endslot

    @slot('navigation')
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.contact.list') }}">List</a></li>
            <li class="breadcrumb-item active">View</li>
        </ol>
    @endslot

    @slot('addicon')

    @endslot

    @slot('content')
        <h3>Contact Us Details</h3>

        <div class="mt-4">
            <h5><b>Name</b>:- {{$data->name}}</h5>
            <h5><b>Email</b>:- {{$data->email}}</h5>
            <h5><b>Mobile</b>:- {{$data->number}}</h5>
            @if ($data->message)
                <h5><b>Message</b>:- {{$data->message}}</h5>
            @endif
        </div>

    @endslot

    @slot('js')
        <script>
            $('.contact').addClass('active')
        </script>
    @endslot
@endcomponent
