<script>
    var _token = "{{ csrf_token() }}";
    const studentModal = new bootstrap.Modal('#createStudent', {
        keyboard: false,
        backdrop: 'static'
    });

    function save_data(modal_title, btn_name) {
        $('form#formData').addClass('formData');
        $('form#formData').removeClass('update-form');
        $('form.formData #update').val('');
        $('form.formData').find('.error-msg').remove();
        $('form.formData')[0].reset();
        $('form.formData .avater').html('');
        $('form.formData .board-select').html(`
            <label class="form-label" for="board">Board</label>
            <select class="form-control" name="board" id="board">
                <option value="">select board</option>
                <option value="Dhaka">Dhaka</option>
                <option value="Sylhet">Sylhet</option>
                <option value="Rajshahi">Rajshahi</option>
            </select>
        `);
        $('h1#modal-title').text(modal_title);
        $('button.btn-name').text(btn_name);
        studentModal.show(); //Show Modal
    }
    
    // Store Data 
    $(document).on('submit', 'form.formData', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('ajax.store') }}",
            type: "post",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (response) {
                $('form.formData').find('.error-msg').remove();
                if (response.status == false) {
                    $.each(response.errors, function (key, value) { 
                         $('form.formData #'+key).parent().append('<span class="text-danger error-msg">'+value+'</span>');
                    });
                }else{
                    if (response.status == 'success') {
                        showData();
                        $('form.formData')[0].reset();
                        studentModal.hide();
                        Command: toastr["success"](response.message, "Success")
                            toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                }
            }
        });
    });

    // Show Data 
    function showData() {
        $.ajax({
            url: "{{ route('ajax.show') }}",
            type: "post",
            data: {_token:_token},
            dataType: "json",
            success: function (response) {
                $('#showData').html(response);
            }
        });
    }
    showData();

    // Edit Data 
    $(document).on('click', 'button.edit-btn', function () {
        let student_id = $(this).data('id');
        $('form.formData #update').val(student_id);
        $('form.formData').addClass('update-form');
        $('form.update-form').removeClass('formData');

        $.ajax({
            type: "post",
            url: "{{ route('ajax.edit') }}",
            data: {_token:_token, student_id:student_id},
            dataType: "json",
            success: function (response) {
                if (response) {
                    $('form#formData').find('.error-msg').remove();
                    $('form#formData #name').val(response.name);
                    $('form#formData #email').val(response.email);
                    $('form#formData #phone').val(response.phone);
                    $('form#formData #roll').val(response.roll);
                    $('form#formData #reg').val(response.reg);
                    student_board(response.id);
                    $('form#formData #session').val(response.session);
                    $('form#formData .avater').html('<img src="{{ asset("avater") }}/'+response.avater+'" alt="" class="avater-img mt-2">');
                    
                    studentModal.show(); //Show Modal
                }
            }
        });
    });

    // Board Select 
    function student_board(student_id) {
        $.ajax({
            url: "{{ route('ajax.borad-select') }}",
            type: "post",
            data: {_token:_token, student_id:student_id},
            dataType: "json",
            success: function (response) {
                if (response) {
                    $('.board-select').html(response);
                }
            }
        });
    }

    // update Data 
    $(document).on('submit', 'form.update-form', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('ajax.update') }}",
            type: "post",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (response) {
                $('form.formData').find('.error-msg').remove();
                if (response.status == false) {
                    $.each(response.errors, function (key, value) { 
                         $('form.formData #'+key).parent().append('<span class="text-danger error-msg">'+value+'</span>');
                    });
                }else{
                    if (response.status == 'success') {
                        showData();
                        // $('form.formData')[0].reset();
                        studentModal.hide();
                        Command: toastr["success"](response.message, "Success")
                            toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                }
            }
        });
    });

    // Modal Title and button name 
    function edit(modal_title, btn_name) {
        $('h1#modal-title').text(modal_title);
        $('button.btn-name').text(btn_name);
    }

    // Delete Data 
    $(document).on('click', 'button.delete-btn', function () {
        let student_id = $(this).data('id');
        $.ajax({
            url: "{{ route('ajax.destroy') }}",
            type: "post",
            data: {_token:_token, student_id:student_id},
            dataType: "json",
            success: function (response) {
                if (response.status == 'success') {
                    showData();
                    // $('.alert-box').append('<span class="alert alert-success d-block">'+response.message+'</span>');
                    Command: toastr["success"](response.message, "Success")
                        toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                }
            }
        });
    });
</script>