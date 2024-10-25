<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data = [
            'title' => 'Websiste Baru Amar',
            'home' => 'Home',
            'menu' => 'Master',
            'submenu' => 'Menu User',
            'titleSubmenu' => 'Data User',
            'titleSubmenuEdit' => 'Edit Data User',
            'users' => User::all(),

        ];

        return view('master.user', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        // dd('Error disini masuk gak...');
        $request->validate( [
            'nama' => 'required|max:128',
            'pekerjaan' => 'required|max:50',
            'alamat' => 'required|max:255',
            'email' => 'required|unique:users,email,'.$request->email,
            'password' =>'required|min:6|max:15'
        ],
        [
            // Berfungsi untuk custome persan error/validasi
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 128 karakter!',
            'pekerjaan.required' => 'Pekerjaan wajib diisi',
            'pekerjaan.max' => 'Pekerjaan maksimal 50 karakter',
            'alamat.required' => 'Alamat wajib diisi!',
            'alamat.max' => 'Alamat maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' =>'Password masih kosong, tolong diisi',
            'password.min' =>'Password minimal 6 karakter!',
            'password.max' =>'Password maksimal 15 karakter',
        ]
        );     
        
          User::create(
            [
                'nama' => $request->nama,
                'pekerjaan' => $request->pekerjaan,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'password' => $request->password,
               
                ]);
                return response()->json(['success' =>'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, $id)
    {
        $getUser['data'] = User::find($id);
        return response()->json($getUser);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'e_nama' => 'required|max:128',
                'e_pekerjaan' => 'required|max:50',
                'e_alamat' => 'required|max:255',
                'e_email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->ignore($request->id),
                ],
            ],
            [
                // Berfungsi untuk custome pesan error
                'e_nama.required' => 'Nama wajib diisi',
                'e_nama.max' => 'Nama maksimal 128 karakter',
                'e_pekerjaan.required' => 'Pekerjaan wajib diisi',
                'e_pekerjaan.max' => 'Pekerjaan maksimal 50 karakter',
                'e_alamat.required' => 'Alamat wajib diisi',
                'e_alamat.max' => 'Alamat maksimal  255 karakter',
                'e_email.required' => 'Email wajib diisi',
                'e_email' => 'Nama wajib diisi',
            ]
            );

            $getPass = User::where('id', $request->id)->first();
            User::where('id', $request->id)->update([
                'nama' => $request->e_nama,
                'alamat' => $request->e_alamat,
                'pekerjaan' => $request->e_pekerjaan,
                'email' => $request->e_email,
                'password' => $request->e_password != '' ? Hash::make($request->e_password) : $getPass->password,
            ]);
            
            return response()->json(['success' => 'Post created successfully.']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, $id)
    {
        //Cari user berdasarkan $id
        $checkUser = User::find($id);
        //Jika data user ada / ditemukan
        if($checkUser) {
            //Hapus user
            User::destroy($id);
            return response()->json(['success' => true]);
        }
    }


    public function profile(Request $request)
    {
        $data = [
            'title' => 'Website Pertamaku',
            'home' =>'Home',
            'menu' => 'Pengaturan',
            'titleSubmenu' => 'Data Profile',
            'submenu' => 'Profile',
            'Users' => User::find(Auth::user()->id),
        ];

        return view('setting.profile', $data);
    }

    public function register()
    {
        $data = [
            'title' =>'Website pertamaku',
            'home' => 'Home',
            'menu' => 'Register',
            'submenu' => 'Register',
            'titleSubmenu' => 'Register',
        ];

        return view('register', $data);

    }

    public function register_user(request $request)
    {
        $request->validate(
            [
                'nama' => 'required|max:128',
                'email' => 'required|unique:users,email,' . $request->email,
                'password' => 'required|min:6',
            ],
            [
                //Berfungsi untuk custome pesan error
                'nama.required' => 'Nama wajib diisi',
                'nama.max' => 'Nama maksimal 128 karakter!',
                'email.required' => 'Email wajib diisi',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 6 karakter',

            ]
            );

            User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['success' => 'Post created successfully.']);
    }

    public function login(request $request)
    {
        $data = [
            'submenu' => 'login',
            'title' => 'Login Aplikasi',
        ];

        return view('login', $data);
    }

    public function login_user(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ],
    [
        'email.required' => 'Email wajidb diisi',
        'email.unique' => 'Email sudah terdaftar',
        'email.email' => 'Format Email salah',
        'password.required' => 'Password wajib diisi',
    ]);

    if (Auth::Attempt($validate)) {
        return response()->json(['success' => ['message' => 'Berhasil Login']], 200);
    }else {
        return response()->json(['errors' => ['message' => 'Email atau password salah.']], 404);
    }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/');
    }

}
