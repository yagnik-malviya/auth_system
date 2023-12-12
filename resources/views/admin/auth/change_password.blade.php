@component('admin.component.content')
    @slot('title') Change Password @endslot

    @slot('navigation')
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Change Password</li>
        </ol>
    @endslot

    @slot('addicon')
        {{-- <a class="icon" href="#" data-bs-toggle="dropdown"><img src="{{ asset('public/admin/icon/more.png') }}" class="mt-2" alt="" style="width: 30px"></a> --}}
    @endslot

    @slot('content')
    <form class="row m-0 py-4" name="formData" onsubmit="return false;" method="POST">
        @csrf

        <div class="col-lg-12 row m-0 py-3">
            <div class="col-lg-5 err_password">
                <input type="password" class="form-control" name="password" placeholder="Enter Password">
                <small class="text-danger errmsg errmsg_password"></small>
            </div>
            <div class="col-lg-5 err_confirm_password">
                <input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password">
                <small class="text-danger errmsg errmsg_confirm_password"></small>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-success w-100" id="submitData">Update</button>
            </div>
        </div>
    </form>
    @endslot

    @slot('js')
        <script>
            $('#submitData').on('click', function(e)
            {
                $('input').removeClass('border border-danger');
                $('.errmsg').text('');

                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });

                var form = document.formData;
                var formData = new FormData(form);
                var url = '{{ route('admin.change_password') }}';
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
                            $('form')[0].reset();
                            Swal.fire({
                                title: data.message,
                                icon: "success",
                            });
                            // window.location.href = data.redirect;
                            // $('.department_table').DataTable().draw(true);
                        }
                    }
                });
            });


        </script>
    @endslot
@endcomponent
