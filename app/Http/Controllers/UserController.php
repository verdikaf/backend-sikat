<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //login
    public function login(){
        $data['title'] = "Login Sikat";
        return view('login',$data);
    }

    //login action
    public function loginAction(Request $request){
        $method =$request->method();
        if($method == "POST"){
            $result =DB::selectOne("SELECT u.nama,u.jenis_kelamin,u.agama,u.tempat_lahir,u.tgl_lahir,u.no_telp,u.alamat,u.foto,r.nama_role AS roole FROM t_user AS u RIGHT JOIN t_role AS r
            ON u.id_role = r.id WHERE u.id=? AND u.password=?",[
                $request->input('id'),
                $request->input('password')
                

            ]);
            if($result != null){
                $request->session()->put('s_id', $result->id);
                $request->session()->put('s_nama', $result->nama);
                $request->session()->put('s_jenis_kelamin', $result->jenis_kelamin);
                $request->session()->put('s_agama', $result->agama);
                $request->session()->put('s_tempat_lahir', $result->tempat_lahir);
                $request->session()->put('s_tgl_lahir', $result->tgl_lahir);
                $request->session()->put('s_no_telp', $result->no_telp);
                $request->session()->put('s_alamat', $result->alamat);
                $request->session()->put('s_password', $result->password);
                $request->session()->put('s_foto', $result->foto);
                $request->session()->put('s_roole', $result->roole);
            

                return redirect('/');
            }else{
                return redirect('/login')->with('error','Email atau Password salah, harap masukkan ulang!');
            }
        }else{
            return redirect('/login');
        }
    }

    //Logout
    public function logout(){
        Session::flush();
        return redirect('/pages')->with('warning','Kamu berhasil logout');
    }

    //add user
    public function user(Request $request){
        $data['title'] = "Tambah User";
        return view('user',$data);
    }

    public function userAdd(Request $request ) {
        $data['role'] = DB::select("SELECT * FROM t_role");
        $data['nav_menu'] = $this->displayMenu($request);
        $data['session'] = array(
            'id'             => $request->session()->get('s_id'),
            'nama'           => $request->session()->get('s_nama'),
            'roole'          => $request->session()->get('s_roole')
        );
        return view('user_add', $data);
    }

    //add save user
    public function userAddSave(Request $request){
        $this->validate($request, [
            'id' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'password' => 'required|min:8',
            'foto' => 'required',
            'id_role' => 'required'
        ]);
        DB::table('t_user')->insert([
            'id' => $request->id,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'=> $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'password' => $request->password,
            'foto' => $request->foto,
            'role_id'=> $request->role_id
        ]);
       
        return redirect('/user')->with('success','Registrasi sukses');
    }

    public function userEdit(Request $request, $id) {
        $user = DB::table('t_user')->where('id',$id)->get();
        $role = DB::table('t_role')->get();
        $session  = array(
            'id'             => $request->session()->get('s_id'),
            'nama'           => $request->session()->get('s_nama'),
            'roole'          => $request->session()->get('s_roole')
        );

        $nav_menu = $this->displayMenu($request);
        return view('user_edit',['user' => $user, 'session' => $session, 'nav_menu' => $nav_menu, 'role' => $role]);

    }

    public function userEditSave(Request $request) {
        DB::table('t_user')->where('id',$request->id)->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'=> $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'password' => $request->password,
            'foto' => $request->foto,
            'role_id'=> $request->role_id
        ]);
        return redirect('/user');
    }
}
