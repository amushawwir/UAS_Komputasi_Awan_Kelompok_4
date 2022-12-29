<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        $user = user::paginate(2);//Mengambil semua isi tabel
        $posts = user::orderBy('id','desc')->paginate(6);
        return view('admin.index',compact('user'));
        with('i',(request()->input('page',1)-1)*5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'username'=>'required',
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'role'=>'required',
        ]);
        $user = new user;
        $user->username = $request->get('username');
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->role = $request->get('role');
        $user->save();

        return redirect()->route('admin.index')
            ->with('success','User Berhasil Ditambahkan');
    }
    public function show($id)
    {
        //menampilkan detail data dengan menemukan/berdaskan id 
        $user = DB::table('user')->where('id', $id)->first();
        return view('admin.detail',['user' => $user]);
    }
    public function edit(User $id)
    {
        //menampilkan detail data dengan menemukan berdasarkan id untuk diedit
        $user = DB::table('user')->where('id',$id)->first();
        return view('admin.edit',['user' => $user]);
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $user = user::where('Nama', 'like', "%" . $keyword . "%")->paginate(2);
        return view('admin.index', compact('user'))
            ->with('i', (request()->input('page', 1) - 1) * 2);
           
    }
    
    public function destroy(User $user)
    {
        $user->delete();

        return view('admin.index');
    }
}
