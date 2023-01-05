<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    private $dbSiswa;

    public function __construct()
    {
        //
        $this->dbSiswa = app('db')->table('siswa');
    }

    public function index() {
        $results = app('db')->select('SELECT * FROM siswa');

        return response()->json($results);
    }

    public function getOne($id) {
        $siswa = $this->dbSiswa->find($id);

        if(!$siswa) {
            return response()->json([
                'status' => 'sukses', 
                'message' => 'siswa dengan id '.$id.' tidak ditemukan'], 
                404);
        }

        return response()->json($siswa);
    }
 
    public function addOne(Request $request) {
        $insertSiswa = $this->dbSiswa->insertGetId([
            'nama' => $request->input('nama'),
            'kota' => $request->input('kota'),
            'gender' => $request->input('gender')
        ]);

        return response()->json(['status' => 'sukses', 'message' => 'berhasil menambahkan siswa', 'id' => $insertSiswa]);
    }    

    public function updateOne(Request $request, $id) {
        $updateData = [
            'nama' => $request->input('nama'),
            'kota' => $request->input('kota'),
            'gender' => $request->input('gender')
        ];

        $updateSiswa = $this->dbSiswa
                            ->where('id', $id)
                            ->update($updateData);

        if($updateSiswa == 0) {
            return response()->json(['status' => 'gagal', 'message' => 'id siswa tidak ditemukan'], 404);
        }

        return response()->json(['status' => 'sukses', 'message' => 'siswa dengan id '.$id.' berhasil diperbarui']);
    }

    public function deleteOne($id) {
        $deleteSiswa = $this->dbSiswa->where('id', $id)->delete();

        if($deleteSiswa == 0) {
            return response()->json(['status' => 'gagal', 'message' => 'id siswa tidak ditemukan'], 404);
        } 
        
        return response()->json(['status' => 'sukses', 'message' => 'siswa dengan id '.$id.' berhasil dihapus']);
        
    }
}
