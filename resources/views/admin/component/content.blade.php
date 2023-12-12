@extends('admin.layout.app')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>{{$title}}</h1>
                <nav>
                    {{$navigation}}
                    {{-- <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol> --}}
                </nav>
            </div>
            {{$addicon}}
            {{-- <a class="icon" href="#" data-bs-toggle="dropdown"><img src="{{ asset('public/admin/icon/more.png') }}" class="mt-2" alt="" style="width: 30px"></a> --}}
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body py-3">
                                    {{$content}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @push('js')
    {{$js}}
    @endpush
@endsection
