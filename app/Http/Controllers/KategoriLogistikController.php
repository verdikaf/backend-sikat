<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriLogistikController extends Controller
{

    public function index(Request $request)
    {
        $item = DB::table('t_kategori_logistik')
            ->select(DB::raw('t_kategori_logistik.*'))->orderByDesc('t_kategori_logistik.id')->paginate(5);
        $data['role'] = array(
            'nama' => $request->session()->get('nama'),
            'role' => $request->session()->get('role')
        );
        return view('/kategori', ['item' => $item], $data);
    }

    public function kategoriAdd(Request $request)
    {
        $data['role'] = array(
            'nama' => $request->session()->get('nama'),
            'role' => $request->session()->get('role')
        );
        $data['item'] = DB::select("SELECT * FROM t_kategori_logistik");
        return view('kategori/add', $data);
    }

    public function kategoriAddSave(Request $request)
    {
        $method = $request->method();
        if ($method == "POST") {
            DB::insert("INSERT INTO t_kategori_logistik (jenis_kategori) VALUES (?)", [
                $request->input('jenis_kategori'),
                0,
                "Proses"
            ]);
            return redirect('/kategori');
        } else {
            return redirect('/kategori/add/save');
        }
    }

    public function kategoriEdit(Request $request)
    {
        $data['role'] = array(
            'nama' => $request->session()->get('nama'),
            'role' => $request->session()->get('role')
        );
        $data['item'] = DB::selectOne("SELECT * FROM t_kategori_logistik WHERE id = ?");
        return view('kategori/edit', $data);
    }

    public function kategoriEditSave(Request $request)
    {
        $method = $request->method();
        $id = $request->input('id');
        if ($method == "POST") {
            DB::update("UPDATE t_kategori_logistik SET jenis_kategori = ? WHERE id = ?", [
                $request->input('jenis_kategori')
            ]);
            return redirect('/kategori');
        } else {
            return redirect('/kategori/edit/save');
        }
    }
    // public function kategoriDelete(Request $request)
    // {
    //     DB::delete("DELETE * FROM t_kategori_logistik WHERE id = ?");
    //     return redirect('/kategori');
    // }
}