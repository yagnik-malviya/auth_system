@component('admin.component.content')
    @slot('title') Dashboard @endslot

    @slot('navigation')
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    @endslot

    @slot('addicon')
        <a href="#"><img src="{{ asset('public/admin/icon/more.png') }}" class="mt-2" alt="" style="width: 30px"></a>
    @endslot

    @slot('content')
        <h1>Demo</h1>
    @endslot

    @slot('js')
        <script>
        </script>
    @endslot
@endcomponent
