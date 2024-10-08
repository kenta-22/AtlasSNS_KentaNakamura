<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request){
        if($request->isMethod('post')){

            // バリデーション
            $request->validate([
                'username' => ['required', 'min:2', 'max:12'],
                'mail' => ['required', 'min:5', 'max:40', 'unique:users,mail', 'email'],
                'password' => ['required', 'regex:/^[a-zA-Z0-9]+$/', 'min:8', 'max:20', 'confirmed'] //regex、、、正規表現(パターンは覚えきれなさそう)
                // confirmedルールを適用すると、自動で「password-confirmation」フォームとの一致を確認してくれる。そのため、「password-confirmation」にバリデーションは必要ない
            ], [
                'username.required' => 'ユーザー名を入力してください',
                'username.min' => 'ユーザー名は2〜12文字で作成してください',
                'username.max' => 'ユーザー名は2〜12文字で作成してください',
                'mail.required' => 'メールアドレスを入力してください',
                'mail.min' => 'メールアドレスは5〜40文字で登録してください',
                'mail.max' => 'メールアドレスは5〜40文字で登録してください',
                'mail.unique' => 'すでに登録されているメールアドレスです<br>別のメールアドレスを登録してください',
                'mail.email' => 'メールアドレスが不正です',
                'password.required' => 'パスワードを入力してください',
                'password.regex' => 'パスワードには半角英数字のみを使用してください',
                'password.min' => 'パスワードは8〜20文字で作成してください',
                'password.max' => 'パスワードは8〜20文字で作成してください',
                'password.confirmed' => 'パスワードが一致していません',
            ]);

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            session() -> put('username', $username);

            return redirect('added');
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
