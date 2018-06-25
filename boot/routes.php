<?php
Route::group(['middleware' => 'web'], function () {
    Route::get('login', function () {
        return view('login');
    })
         ->name('login');
    Route::post('login', function () {
        $login_field = config('auth-simple.login_field', 'email');
        $login       = Request::input($login_field);
        $remember    = ('on' == Request::input('remember'));
        $password    = Request::input('password');
        $error      = '';
        $exist = \App\User::where($login_field, $login)->count();
        if(!$exist){
            $error = 'Пользователь отсутствует на проекте';
        } else {
            if (!Auth::attempt(compact([$login_field, 'password']), $remember)) {
                $error = 'Введите корректные данные для входа';
            }
        }

        return view('login', compact('error', 'login'));
    })
         ->name('login');
    Route::get('logout', function () {
        Auth::logout();
        Session::put('cas_logout', true);

        if (Request::ajax()) {
            return [
                'result'  => 'success',
                'message' => 'Вы успешно вышли',
            ];
        } else {
            return Redirect::to('/logout-cas?123');
        }
    })
         ->name('logout');
    Route::get('logout-cas', function () {
        \Larakit\Auth\LkCas::init();
        \phpCAS::handleLogoutRequests(true, config('larakit.lk-auth-cas.allowed_clients'));
        \phpCAS::logout();
        Session::forget('cas_logout');

        return Redirect::to('/?logout_cas');
    });
});
