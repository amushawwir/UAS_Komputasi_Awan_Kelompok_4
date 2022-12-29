<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = user::paginate(2);//Mengambil semua isi tabel
        // $posts = user::orderBy('id','desc')->paginate(6);
        // return view('admin.index',compact('user'));
        // with('i',(request()->input('page',1)-1)*5);
        if (request('search')) {
            $akun = DB::table('user')->where('id', '!=',  auth()->id())->get();
            $paginate = User::where(
                'username', 'like', '%' . request('search') . '%')
                ->orwhere('name', 'like', '%' . request('search') . '%')->paginate(5);
            return view('admin.index', ['akun' => $akun, 'paginate' => $paginate]);
        } else {
             // Mengambil semua isi tabel kecuali admin
            $akun = DB::table('user')->where('id', '!=',  auth()->id())->get();
            $paginate = User::orderBy('name', 'asc')->paginate(5);
            return view('admin.index', ['akun' => $akun, 'paginate' => $paginate]);
        }
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'=> ['required', 'string'],
            'name'=> ['required', 'string'],
            'email'=> ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:3'],
        ]);

        $akun = new User;
        $akun->username = $request->post('username');
        $akun->name = $request->post('name');
        $akun->email = $request->post('email');
        $akun->password = $request->post(bcrypt('password'));
        $akun->save();

        return redirect()->route('admin.index')
            ->with('success','Akun User Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $akun = DB::table('user')->where('id', $id)->first();
        return view('admin.detail', ['akun' => $akun]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $akun = DB::table('user')->where('id',$id)->first();
        return view('admin.edit',['akun' => $akun]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
        ]);

        $akun = User::where('id', $id)->first();
        $akun->username = $request->get('username');
        $akun->name = $request->get('name');
        $akun->email = $request->get('email');
        $akun->save();
        

        return redirect()->route('admin.index')
            ->with('success', 'Akun User Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $akun = User::where('id', $id)->first();
        
        if($akun != null){
            $akun->delete();
            return redirect()->route('admin.index')
                ->with('success', 'Akun User Berhasil Dihapus');
        }
        return redirect()->route('admin.index')
            ->with('success', 'Akun User Gagal Dihapus');
    }

    // public function search(Request $request)
    // {
    //     $keyword = $request->search;
    //     $akun = User::where('name', 'like', "%" . $keyword . "%")->paginate(2);
    //     return view('admin.index', compact('akun'))
    //         ->with('i', (request()->input('page', 1) - 1) * 2);
    // }
// }
}
