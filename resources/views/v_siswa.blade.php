@extends('layout/v_template')
@section('title','Siswa')

@section('content')
    <h1>INI HALAMAN SISWA</h1>

    <table class="table table-bordered">
        <a href="/siswa/print" target="_blank" class="btn btn-primary btn-sm mb-2 mr-2">Cetak Laporan</a>
        <a href="/siswa/printpdf" target="_blank" class="btn btn-success btn-sm mb-2">Save To PDF</a>

    <thead>
        <th>No</th>
        <th>NIS</th>
        <th>Nama Siswa</th>
        <th>Kelas</th>
        <th>Mata Pelajaran</th>
        {{-- <th>Action</th> --}}
    </thead>
        <tbody>
    <?php $no=1; ?>
        @foreach ($siswa as $data)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$data->nis}}</td>
            <td>{{$data->nama_siswa}}</td>
            <td>{{$data->kelas}}</td>
            <td>{{$data->mapel}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

@endsection
