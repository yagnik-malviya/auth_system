@component('admin.component.auth')
    @slot('meta')
        <title>Forgot Password</title>
    @endslot

    @slot('cardTitle') Forgot Password @endslot

    @slot('cardText') Enter your username @endslot

    @slot('form')
        <form class="row g-3 needs-validation" name="formData" onsubmit="return false;" method="POST">
            @csrf
            <div class="col-12">
            <label for="yourUsername" class="form-label">Email</label>
            <div class="input-group has-validation err_email">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" name="email" class="form-control" id="yourUsername">
            </div>
            <span class="text-danger errmsg errmsg_email"></span>
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
                var url = '{{ route('admin.forgot_password') }}';
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
                            alert(data.message)
                            // $('.department_table').DataTable().draw(true);
                        }
                    }
                });
            });
        </script>
    @endslot
@endcomponent
