
<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div   div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-data" class="form-data" enctype="multipart/form-data">
                @csrf
                
                <div class="modal-body">
                    <input type="hidden" id="update" name="update">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Date of Birth</label>
                        <input type="date" name="birthday" id="birthday" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="avater" class="form-label">Avater</label>
                        <input type="file" name="avater" id="avater" class="form-control">
                        <div class="avater"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submt" class="btn btn-outline-success btn-name"></button>
                </div>
            </form>
        </div>
    </div>
</div>
  