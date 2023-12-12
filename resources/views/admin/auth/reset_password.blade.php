@component('admin.component.auth')
    @slot('meta')
        <title>Reset Password</title>
    @endslot

    @slot('cardTitle') Password Reset @endslot

    @slot('cardText') Enter your new password @endslot

    @slot('form')
        <form class="row g-3 needs-validation" name="formData" onsubmit="return false;" method="POST">
            @csrf

            <div class="col-12 err_new_password">
            <label for="yourPassword" class="form-label">New Password</label>
            <input type="password" name="new_password" class="form-control" placeholder="New Password">
            <span class="text-danger errmsg errmsg_new_password"></span>
            </div>

            <div class="col-12 err_conform_password">
            <label for="yourPassword" class="form-label">Conform Password</label>
            <input type="password" name="conform_password" class="form-control" placeholder="Conform Password">
            <span class="text-danger errmsg errmsg_conform_password"></span>
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
                formData.append("url", $(location).attr('href'));

                var url = '{{ route('admin.reset_password') }}';
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
