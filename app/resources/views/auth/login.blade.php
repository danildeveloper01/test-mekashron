@extends('default.app')
@section('content')

    <div class="entry-content">
        <div class="registration">
            <h1>Login</h1>
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            <form action="{{ route('login.store') }}" method="post">
                @csrf
                <p><input type="text" name="login" placeholder="Login" required></p>
                <p><input type="password" name="password" placeholder="Password" required></p>
                <p class="submit"><input type="submit" name="commit" value="Sign in"></p>
            </form>
            <a href="{{ route('registration') }}">Don't have an account yet? Sign up</a>
        </div>

        <div class="clearfix"></div>
    </div>

@endsection
