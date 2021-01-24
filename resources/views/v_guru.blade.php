@extends('layout/v_template')
@section('title','Guru')

@section('content')
@if (session('pesan'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Success!</h5>
   {{ session('pesan')}}.
  </div>
@endif
<table class="table table-bordered">
    <a href="/guru/add" class="btn btn-primary btn-sm mb-2">Tambah Data</a>
<thead>
    <th>No</th>
    <th>NIP</th>
    <th>Nama Guru</th>
    <th>Mata Pelajaran</th>
    <th>Foto Guru</th>
    <th>Action</th>

</thead>
<tbody>
    <?php $no=1; ?>
    @foreach ($guru as $data)
    <tr>
        <td>{{$no++}}</td>
        <td>{{$data->nip}}</td>
        <td>{{$data->nama_guru}}</td>
        <td>{{$data->mapel}}</td>
        <td><img src="{{url('foto_guru/'.$data->foto_guru)}}" width="100px"></td>
        <td>
            <a class="btn btn-success" href="/guru/detail/{{$data->id_guru}}">Detail</a>
            <a class="btn btn-warning" href="/guru/edit/{{$data->id_guru}}">Edit</a>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$data->id_guru}}">
              Delete
              </button>
        </td>

    </tr>
    @endforeach


</tbody>

</table>

@foreach ($guru as $data)

<div class="modal fade" id="delete{{$data->id_guru}}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Data {{$data->nama_guru}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin meghapus data ini ?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <a  class="btn btn-outline-light" data-dismiss="modal">No</a>
          <a href="/guru/delete/{{$data->id_guru}}" class="btn btn-outline-light">Yes</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endforeach

@endsection
