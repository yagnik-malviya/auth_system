@component('admin.component.content')
    @slot('title') Profile @endslot

    @slot('navigation')
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    @endslot

    @slot('addicon')
        {{-- <a class="icon" href="#" data-bs-toggle="dropdown"><img src="{{ asset('public/admin/icon/more.png') }}" class="mt-2" alt="" style="width: 30px"></a> --}}
    @endslot

    @slot('content')
    @php
        $image = asset('public/admin/img/user.png');
        if(Storage::disk('public')->exists(Auth::guard('admin')->user()->image ?? '-') && !empty(Auth::guard('admin')->user()->image))
        {
            $image = asset('public/storage/'.Auth::guard('admin')->user()->image);
        }
    @endphp
    <form class="row m-0 py-4" name="formData" onsubmit="return false;" method="POST">
        @csrf
        <div class="col-lg-2 d-flex justify-content-center align-items-center ">
            <div class="user_profile_image">
                <div class="w-100 h-100">
                    <div class="image-upload w-100 h-100">
                       <label for="file-input" style="width: 100%; height: 100%;">
                         <div class="upload-icon">
                            <img id="sampleImageId" src="{{ $image }}" class="w-100 h-100">
                          </div>
                        </label>
                     <input id="file-input" type="file" class="d-none" name="image" />
                    </div>
               </div>
            </div>
        </div>
        <div class="col-lg-10 row m-0 py-3">
            <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{Auth::guard('admin')->user()->name}}">
            <input type="email" class="form-control mt-3" name="email" placeholder="Enter email" value="{{Auth::guard('admin')->user()->email}}">
            <input type="text" class="form-control mt-3" name="mobile" placeholder="Enter mobile" value="{{Auth::guard('admin')->user()->mobile}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\.*?)\..*/g, '$1').replace(/^0[^.]/, '0');">
            <input type="text" class="form-control mt-3" name="userName" placeholder="Enter User Name" value="{{Auth::guard('admin')->user()->userName}}">

            <div class="mt-3 text-end p-0">
                <button class="btn btn-success" id="submitData">Update</button>
            </div>
        </div>
    </form>
    @endslot

    @slot('js')
        <script>
            $("#file-input").change(function () {
                readURL(this, 'sampleImageId');
                $('.upload-icon').css('border-style','none');
            });

            function readURL(input, id) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#' + id).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);

                }
            }

            $('#submitData').on('click', function(e)
            {
                $('input').removeClass('border border-danger');
                $('textarea').removeClass('border border-danger');

                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });

                var form = document.formData;
                var formData = new FormData(form);
                var url = '{{ route('admin.profile') }}';
                $.ajax({
                    type: 'POST',
                    url: url,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formData,
                    dataSrc: "",
                    beforeSend: function()
                    {
                        $('#loader').removeClass('d-none');
                    },
                    complete: function(data, status)
                    {
                        $('#loader').addClass('d-none');
                    },
                    success: function(data)
                    {
                        if (data.status == 401)
                        {
                            $.each(data.error1, function(index, value)
                            {
                                $('.err_' + index + ' input').addClass('border border-danger');
                                $('.err_' + index + ' select').addClass('border-danger');
                                $('.err_' + index + ' textarea').addClass('border border-danger');
                                $('.errmsg_'+index).text(value);
                            });
                        }
                        if (data.status == 1)
                        {
                            window.location.href = data.redirect;
                            // $('.department_table').DataTable().draw(true);
                        }
                    }
                });
            });


        </script>
    @endslot
@endcomponent
