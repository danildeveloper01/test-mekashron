@extends('default.app')
@section('content')
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="logout">Log out of the account</button>
    </form>
<div class="app">
    <div class="app_block" data-item="0"></div>
    <div class="app_block" data-item="1"></div>
    <div class="app_block" data-item="2"></div>
    <div class="app_block" data-item="3"></div>
    <div class="app_block" data-item="4"></div>
    <div class="app_block" data-item="5"></div>
    <div class="app_block" data-item="6"></div>
    <div class="app_block" data-item="7"></div>
    <div class="app_block" data-item="8"></div>
</div>
<div id="resultModal" class="modal">
    <div id="resultModalContent" class="modal-content">
        <span id="resultText"></span>
        <form action="{{ route('game.result') }}" method="post">
            @csrf
            <input type="hidden" name="player_id" value="{{ Auth::user()->id }}">
            <input type="hidden" id="resultInput" name="result">
            <button id="playAgainButton">Once again</button>
        </form>
    </div>
</div>
<div class="result">
    <h4>Results</h4>
    @foreach($results as $result)
        <p>{{ $result->result }}, {{ $result->created_at->format('d.m.Y | H:i:s') }}</p>
    @endforeach
</div>
@endsection
