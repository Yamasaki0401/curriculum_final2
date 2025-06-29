<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar' => ['string', 'max:2048'],
            'city' => ['required', 'string', 'max:100'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    // 新規登録フォーム表示
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    // 確認画面に進む処理
    public function confirmRegistration(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|max:2048',
            'city' => 'required | string | max:100',
        ]);

        // アバター画像をセッションに保存
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = 'storage/' . $path; // 既存の 'user_default.jpg' を上書き
        }


        // 入力データをセッションに保存
        Session::put('register_data', $validated);

        return view('auth.register-confirm');
    }

    // 登録処理（実際にデータベースに保存）
    public function storeRegistration(Request $request)
    {
        $data = Session::get('register_data');
        $data['password'] = Hash::make($data['password']);  // パスワードのハッシュ化

        // ユーザーをデータベースに保存
        User::create($data);

        // セッションをクリア
        $request->session()->forget('register_data');
        $request->session()->forget('avatar');

        return redirect()->route('top');  // TOP画面に遷移
    }
}
