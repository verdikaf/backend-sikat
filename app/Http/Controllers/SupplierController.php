<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index(Request $request)
    {
        $item = DB::table('t_data_suplier')
            ->select(DB::raw('t_data_suplier.*'))->orderByDesc('t_data_suplier.id')->paginate(5);
        $data['role'] = array(
            'nama' => $request->session()->get('nama'),
            'role' => $request->session()->get('role')
        );
        return view('/supplier', ['item' => $item], $data);
    }

    public function supplierAdd(Request $request)
    {
        $data['role'] = array(
            'nama' => $request->session()->get('nama'),
            'role' => $request->session()->get('role')
        );
        $data['item'] = DB::select("SELECT * FROM t_suplier");
        return view('supplier/add', $data);
    }

    public function supplierAddSave(Request $request)
    {
        $method = $request->method();
        if ($method == "POST") {
            DB::insert("INSERT INTO t_data_suplier (nama, alamat) VALUES (?, ?)", [
                $request->input('nama'),
                $request->input('alamat'),
                0,
                "Proses"
            ]);
            return redirect('/supplier');
        } else {
            return redirect('/supplier/add/save');
        }
    }

    public function supplierEdit(Request $request)
    {
        $data['role'] = array(
            'nama' => $request->session()->get('nama'),
            'role' => $request->session()->get('role')
        );
        $data['item'] = DB::selectOne("SELECT * FROM t_data_suplier WHERE id = ?");
        return view('supplier/edit', $data);
    }

    public function supplierEditSave(Request $request)
    {
        $method = $request->method();
        $id = $request->input('id');
        if ($method == "POST") {
            DB::update("UPDATE t_data_suplier SET nama = ?, alamat = ? WHERE id = ?", [
                $request->input('nama'),
                $request->input('alamat')
            ]);
            return redirect('/supplier');
        } else {
            return redirect('/supplier/edit/save');
        }
    }
    public function supplierDelete(Request $request)
    {
        DB::delete("DELETE * FROM t_suplier WHERE id = ?");
        return redirect('/supplier');
    }
}
