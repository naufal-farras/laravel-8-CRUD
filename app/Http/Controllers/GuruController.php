<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GuruModel;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->GuruModel = new GuruModel();
        $this->middleware('auth');
    }
    public function index()
    {
        $data = [
            'guru' => $this->GuruModel->allData(),
        ];
        return view('v_guru', $data);
    }

    public function detail($id_guru)
    {
        if (!$this->GuruModel->detailData($id_guru)) {
            abort(404);
        } else {
            $data = [
                'guru' => $this->GuruModel->detailData($id_guru),
            ];
            return view('v_detailguru', $data);
        }
    }

    public function add()
    {
        return view('v_addguru');
    }

    public function insert()
    {
        request()->validate([
            'nip' => 'required|unique:tbl_guru,nip|min:4|max:5',
            'nama_guru' => 'required',
            'mapel' => 'required',
            'foto_guru' => 'required|mimes:png,jpg,jpeg|max:1024'
        ], [
            'nip.required' => 'Wajib di Isi !!!',
            'nip.unique' => 'Nip Sudah terpakai !!',
            'nip.min' => 'Nip Minimal 4 karaktr !!!',
            'nip.max' => 'Nip Maximall 5 karaktr  !!!',
            'nama_guru.required' => 'Wajib di Isi !!!',
            'mapel.required' => 'Wajib di Isi !!!',
            'foto_guru.required' => 'Wajib di Isi !!!',
        ]);
        //Jika validasi tidak di terpenuhi Simpan Data
        //uplaod foto
        $file = request()->foto_guru;
        $fileName = request()->nip . '.' . $file->extension();
        $file->move(public_path('foto_guru'), $fileName);

        $data = [
            'nip' => request()->nip,
            'nama_guru' => request()->nama_guru,
            'mapel' => request()->mapel,
            'foto_guru' => $fileName,
        ];
        $this->GuruModel->addData($data);
        return redirect()->route('guru')->with('pesan', 'Data Berhasil di Tambahkan !!');
    }

    public function edit($id_guru)
    {
        if (!$this->GuruModel->detailData($id_guru)) {
            abort(404);
        } else {
            $data = [
                'guru' => $this->GuruModel->detailData($id_guru),
            ];
            return view('v_editguru', $data);
        }
    }

    public function update($id_guru)
    {

        request()->validate([
            // 'nip' => 'required|min:4|max:5',
            'nip' => 'required|unique:tbl_guru,nip|min:4|max:5',

            'nama_guru' => 'required',
            'mapel' => 'required',
            'foto_guru' => 'mimes:png,jpg,jpeg|max:1024'
        ], [
            'nip.required' => 'Wajib di Isi !!!',
            'nip.unique' => 'Nip Sudah terpakai !!',
            'nip.min' => 'Nip Minimal 4 karaktr !!!',
            'nip.max' => 'Nip Maximall 5 karaktr  !!!',
            'nama_guru.required' => 'Wajib di Isi !!!',
            'mapel.required' => 'Wajib di Isi !!!',
        ]);
        //Jika validasi tidak di terpenuhi Simpan Data
        if (request()->foto_guru <> "") {
            //uplaod foto
            //Jika ingin Ganti Foto
            $file = request()->foto_guru;
            $fileName = request()->nip . '.' . $file->extension();
            $file->move(public_path('foto_guru'), $fileName);

            $data = [
                'nip' => request()->nip,
                'nama_guru' => request()->nama_guru,
                'mapel' => request()->mapel,
                'foto_guru' => $fileName,
            ];
            $this->GuruModel->editData($id_guru, $data);
        } else {
            //Jika Tidak ingin Ganti Foto

            $data = [
                'nip' => request()->nip,
                'nama_guru' => request()->nama_guru,
                'mapel' => request()->mapel,
            ];
            $this->GuruModel->editData($id_guru, $data);
        }
        return redirect()->route('guru')->with('pesan', 'Data Berhasil di Update !!');
    }

    public function delete($id_guru)
    {
        $guru = $this->GuruModel->detailData($id_guru);
        if ($guru->foto_guru <> "") {
            unlink(public_path('foto_guru') . '/' . $guru->foto_guru);
        }
        $this->GuruModel->deleteData($id_guru);
        return redirect()->route('guru')->with('pesan', 'Data Berhasil di Hapus !!');
    }
}
