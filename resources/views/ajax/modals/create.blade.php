
  <!-- Modal -->
  <div class="modal fade" id="createStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header p-3">
          <h1 class="modal-title fs-5" id="modal-title"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" id="formData" class="formData" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="update" id="update">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="Enter Name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="Enter Email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="phone">Phone</label>
                            <input class="form-control" type="number" name="phone" id="phone" placeholder="Enter Phone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="roll">Roll</label>
                            <input class="form-control" type="number" name="roll" id="roll" placeholder="Enter Roll">
                        </div>
                        
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label" for="reg">Reg</label>
                            <input class="form-control" type="number" name="reg" id="reg" placeholder="Enter reg">
                        </div>
                        <div class="mb-3 board-select">
                            
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="session">Session</label>
                            <input class="form-control" type="text" name="session" id="session" placeholder="Enter session">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="avater">Avater</label>
                            <input class="form-control" type="file" name="avater" id="avater" placeholder="Enter avater">
                            <div class="avater"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-end">
                    <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                    <button type="submit" class="btn btn-sm btn-outline-success data-create btn-name"></button>
                </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>
  