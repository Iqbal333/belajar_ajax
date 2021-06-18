<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Hello, world!</title>

    <style>
      .error {
        color: red;
      }
    </style>
  </head>
  <body>

    <div class="card">

      <div class="card-header">
        <h3 class="text-center">Data Student</h3> 

        <div class="btn-group float-right">
          <button class="btn btn-primary" type="button" id="btn_reload">Reload Data</button>
          <button class="btn btn-info" type="button" id="btn_add">New Data</button>
        </div>

      </div>

      <div class="card-body">
        <table class="table table-striped table-responsive" id="t_user">
          <thead>
            <tr class="text-center table-info">
              <th>ID</th>
              <th>NIM</th>
              <th>Name</th>
              <th>Date Of Birth</th>
              <th>Prodi</th>
              <th>Faculty</th>
              <th>Phone Number</th>
              <th>Religion</th>
              <th>Email</th>
              <th>Gender</th>
              <th>Address</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="4" class="text-center">
                <h4>Loading... Please Wait</h4>
              </td>
            </tr>
          </tbody>
          <tfoot></tfoot>
        </table>
      </div>
    </div>

    <form action="" id="form_add">
      <div class="modal" id="modal_add" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">

              <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" class="form-control" id="nim" required>
              </div>

              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
              </div>

              <div class="form-group">
                <label for="date_of_birth">Date Of Birth</label>
                <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" required>
              </div>

              <div class="form-group">
                <label for="prodi">Prodi</label>
                <input type="text" name="prodi" class="form-control" id="prodi" required>
              </div>

              <div class="form-group">
                <label for="faculty">Faculty</label>
                <input type="text" name="faculty" class="form-control" id="faculty" required>
              </div>

              <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" id="phone_number" required>
              </div>

              <div class="form-group">
                <label for="religion">Religion</label>
                <input type="text" name="religion" class="form-control" id="religion" required>
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" id="email" required>
              </div>

              <div class="form-group">
                <label for="gender">Gender</label>
                <input type="text" name="gender" class="form-control" id="gender" required>
              </div>

              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" id="address" required>
              </div>

            </div>

            <div class="modal-footer">
              @csrf
              <button type="submit" id="btn_save" class="btn btn-primary">Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <form action="" id="form_edit">
      <div class="modal" id="modal_edit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">

              <div class="form-group">
                <label for="name">NIM</label>
                <input type="text" name="nim" value="{{ old('nim') }}" class="form-control" id="edit_nim" required>
              </div>

              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="edit_name" required>
              </div>

              <div class="form-group">
                <label for="name">Date Of Birth</label>
                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control" id="edit_date_of_birth" required>
              </div>

              <div class="form-group">
                <label for="name">Prodi</label>
                <input type="text" name="prodi" value="{{ old('prodi') }}" class="form-control" id="edit_prodi" required>
              </div>

              <div class="form-group">
                <label for="name">Faculty</label>
                <input type="text" name="faculty" value="{{ old('faculty') }}" class="form-control" id="edit_faculty" required>
              </div>

              <div class="form-group">
                <label for="name">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" id="edit_phone_number" required>
              </div>

              <div class="form-group">
                <label for="name">Religion</label>
                <input type="text" name="religion" class="form-control" id="edit_religion" required>
              </div>

              <div class="form-group">
                <label for="name">Email</label>
                <input type="text" name="email" class="form-control" id="edit_email" required>
              </div>

              <div class="form-group">
                <label for="name">Gender</label>
                <input type="text" name="gender" class="form-control" id="edit_gender" required>
              </div>

              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" id="edit_address" required>
              </div>

              

            </div>

            <div class="modal-footer">
              @csrf
              @method('PUT')

              <input type="hidden" name="id" id="edit_id">
              <button type="submit" id="btn_update" class="btn btn-primary">Update</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <form action="" id="form_delete">
      <div class="modal" id="modal_delete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">

              <h4>Apakah Anda yakin akan menghapus data ini?</h4>
              <p>Data akan terhapus secara permanen. <span id="delete_nama"></span></p>

            </div>

            <div class="modal-footer">
              @csrf
              @method('DELETE')

              <input type="hidden" name="id" id="delete_id">
              <button type="submit" id="btn_delete" class="btn btn-primary">Ya</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="{{ asset('siswa/siswa.js') }}"></script>

</body>
</html>