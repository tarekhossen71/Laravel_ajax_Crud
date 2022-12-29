<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf" content="{{ csrf_token() }}">
    <title>Laravel Ajax</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <style>
        .avater-img{
            width:50px;
            height:50px;
            border-radius:50%;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 my-5">
                <div class="card shadow">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3>Create</h3>
                        <button type="button" class="btn btn-sm btn-primary create-student" onclick="save_data('New Student', 'Create')">Add New</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sripted table-hover table-bordered">
                                <thead>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Roll</th>
                                    <th>Reg</th>
                                    <th>Board</th>
                                    <th>Session</th>
                                    <th>Avater</th>
                                    <th>Action</th>
                                </thead>
                                <tbody id="showData">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('ajax.modals.create')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @include('ajax.js')
    
    {!! Toastr::message() !!}
  </body>
</html>
