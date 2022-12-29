<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Ajax Crud Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <style>
        .profile-img{
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto mt-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>All Student List</h4>
                        <button type="button" class="btn btn-sm btn-primary" onclick="showModal('Create New Student', 'Create Student')">Add New</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-stripted table-bordered">
                            <thead>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date Of Birth</th>
                                <th>Avater</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="student-data">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('student.modal.student')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var _token = "{{ csrf_token() }}";
        const studentModal = new bootstrap.Modal('#studentModal', {
            keyboard: false,
            backdrop: 'static'
        });
        // Show Modal
        function showModal(modalTitle, btnName) {
            
            $('form#form-data')[0].reset();
            $('form.update-form .avater').html('');
            $('form#form-data').addClass('form-data')
            $('form#form-data').removeClass('update-form');
            $('form#form-data').find('.error-msg').remove();
            $('form.form-data #update').val('');
            $('.modal-title').text(modalTitle);
            $('.btn-name').text(btnName);
            studentModal.show();
        }

        // Insert 
        $(document).on('submit', 'form.form-data', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('students.store') }}",
                type: "post",
                data: new FormData(this),
                contentType: false,
                processData:false,
                success: function (response) {
                    if (response.status == false) {
                        $.each(response.errors, function (key, value) { 
                             $('form#form-data #'+key).parent().append('<span class="error-msg text-danger">'+value+'</span>');
                        });
                    }else{
                        if (response.status == 'success') {
                            $('form.form-data')[0].reset();
                            showStudentData();
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

        // Show Students Data 
        function showStudentData() {
            $.ajax({
                url: "{{ route('students.show') }}",
                type: "post",
                data: {_token:_token},
                dataType: "json",
                success: function (response) {
                    $('#student-data').html(response);
                }
            });
        }
        showStudentData();

        // Edit
        $(document).on('click', 'button.edit-btn', function(){
            let student_id = $(this).data('id');
            $('form.form-data #update').val(student_id);
            $('form.form-data ').addClass('update-form');
            $('form.update-form ').removeClass('form-data');
            $.ajax({
                type: "post",
                url: "{{ route('students.edit') }}",
                data: {_token:_token, student_id:student_id},
                dataType: "json",
                success: function (response) {
                    $('form#form-data').find('.error-msg').remove();
                    if (response) {
                        $('form.update-form #name').val(response.name);
                        $('form.update-form #email').val(response.email);
                        $('form.update-form #birthday').val(response.birthday);
                        $('form.update-form .avater').html('<img src="{{ asset("profile") }}/'+response.avater+'" class="profile-img">');
                    }
                }
            });
        });

        function edit_data(modalTitle, btnName) {
            $('.modal-title').text(modalTitle);
            $('.btn-name').text(btnName);
            studentModal.show();
        }

        // Update
        $(document).on('submit', 'form.update-form', function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('students.update') }}",
                type: "post",
                data: new FormData(this),
                contentType: false,
                processData:false,
                success: function (response) {
                    if (response.status == false) {
                        $.each(response.errors, function (key, value) { 
                             $('form#form-data #'+key).parent().append('<span class="error-msg text-danger">'+value+'</span>');
                        });
                    }else{
                        if (response.status == 'success') {
                            $('form#form-data')[0].reset();
                            showStudentData();
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

        // Delete
        $(document).on('click', 'button.delete-btn', function () {
            let student_id = $(this).data('id');
            $.ajax({
                url: "{{ route('students.destroy') }}",
                type: "post",
                data: {_token:_token, student_id:student_id},
                dataType: "json",
                success: function (response) {
                    showStudentData();
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
            });
        });
    </script>
    
    {!! Toastr::message() !!}
  </body>
</html>
