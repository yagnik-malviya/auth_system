@component('admin.component.auth')
    @slot('meta')
        <title>Login</title>
    @endslot

    @slot('cardTitle') Login to Your Account @endslot

    @slot('cardText') Enter your username & password to login @endslot

    @slot('form')
        <form class="row g-3 needs-validation" name="formData" onsubmit="return false;" method="POST">
            @csrf
            <div class="col-12">
            <label for="yourUsername" class="form-label">Username</label>
            <div class="input-group has-validation err_user_name">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" name="user_name" class="form-control" id="yourUsername">
            </div>
            <span class="text-danger errmsg errmsg_user_name"></span>
            </div>

            <div class="col-12 err_password">
            <label for="yourPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
            <span class="text-danger errmsg errmsg_password"></span>
            </div>

            <div class="col-12 text-end">
            <p class="small mb-0"><a href="{{route('admin.forgot_password')}}">Forget Password</a></p>
            </div>

            <div class="col-12">
            <button class="btn btn-primary w-100" type="submit" id="submitData">Login</button>
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
                var url = '{{ route('admin.login') }}';
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
