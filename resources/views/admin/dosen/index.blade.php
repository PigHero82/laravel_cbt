@extends('layout')

@section('judul')
    Data Dosen
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
@endsection

@section('content')
    @if(session()->get('success'))
        <div class ="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
    @endif

    <div class="card">
        <div class="card-header">
            <div class="d-inline">
                <select name="" id="" class="form-control">
                    <option value="">--Semua--</option>
                </select>
            </div>
            <div class="d-inline">
                <button type="button" class="btn btn-success px-1"><i class="feather icon-plus"></i> Tambah</button>
                <button type="button" class="btn btn-danger px-1"><i class="feather icon-trash"></i> Hapus</button>
                <button type="button" class="btn btn-warning px-1"><i class="feather icon-check-square"></i> Set Aktif</button>
                <button type="button" class="btn btn-primary px-1"><i class="feather icon-upload"></i> Upload Excel</button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="myTable" class="table zero-configuration table-striped text-center" style="width:100%">
                <thead>
                    <tr>
                        <th>NIDN</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Aktif</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>0898841078</td>
                        <td><a href="{{ route('admin.portal.dosen.show') }}">Tiger Nixon</a></td>
                        <td>Laki-laki</td>
                        <td class="text-success"><i class="feather icon-check"></i></td>
                        <td>
                            <button type="button" class="btn btn-primary px-1"><i class="feather icon-lock"></i></button>
                            <button type="button" class="btn btn-danger px-1"><i class="feather icon-trash-2"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>0843098017</td>
                        <td><a href="{{ route('admin.portal.dosen.show') }}">Garrett Winters</a></td>
                        <td>Laki-laki</td>
                        <td class="text-danger"><i class="feather icon-slash"></i></td>
                        <td>
                            <button type="button" class="btn btn-primary px-1"><i class="feather icon-lock"></i></button>
                            <button type="button" class="btn btn-danger px-1"><i class="feather icon-trash-2"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('.zero-configuration').DataTable();
        } );
    </script>
@endsection