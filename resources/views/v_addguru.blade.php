@extends('layout/v_template')
@section('title','Insert')

@section('content')
    <h1>INI HALAMAN TAMBAH DATA</h1>

    <form action="/guru/insert" method="POST" enctype="multipart/form-data">
        @csrf

    <div class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                <label>NIP</label>
                <input name="nip" class="form-control" value="{{old('nip')}}">
                <div class="text-danger">
                    @error('nip')
                        {{$message}}
                    @enderror
                </div>
            </div>

                <div class="form-group">
                <label>NAMA GURU</label>
                <input name="nama_guru" class="form-control" value="{{old('nama_guru')}}">
                <div class="text-danger">
                    @error('nama_guru')
                        {{$message}}
                    @enderror
                </div>
             </div>

                <div class="form-group">
                <label>MATA PELAJARAN</label>
                <input name="mapel" class="form-control" value="{{old('mapel')}}">
                <div class="text-danger">
                    @error('mapel')
                        {{$message}}
                    @enderror
                </div>
             </div>

               <div class="form-group">
               <label>FOTO GURU</label>
               <input type="file" name="foto_guru" class="form-control" value="{{old('foto_guru')}}">
               <div class="text-danger">
                @error('foto_guru')
                    {{$message}}
                @enderror
            </div>
               </div>

               <div class="form-group">
               <button class="btn btn-primary btn-sm">Simpan</button>
                </div>

         </div>
     </div>
  </div>
    </form>

@endsection
