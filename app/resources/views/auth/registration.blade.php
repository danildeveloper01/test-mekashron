@extends('default.app')
@section('content')

    <div class="entry-content">
        <div class="registration">
            <h1>Registration</h1>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            <form action="{{ route('store') }}" method="post">
                @csrf
                <p><input type="text" name="name" value="{{ old('name') }}" placeholder="Name *" required></p>
                <p><input type="text" name="login" value="{{ old('login') }}" placeholder="Login *" required></p>
                <p><input type="email" name="email" value="{{ old('email') }}" placeholder="Email *" required></p>
                <p><input type="password" name="password" placeholder="Password (minimum 8 characters) *" required></p>
                <p class="submit"><input type="submit" name="commit" value="Register"></p>
            </form>
            <a href="{{ route('login') }}">Already have an account? Sign in</a>
        </div>

        <div class="clearfix"></div>
    </div>

@endsection
