@extends('layouts.app')

@section('content')
    @if($gamerScore == 0)
        <br>
        <hr>
        <h2>After you built your computer, you can see your test results here!</h2>
        <hr>
        @else
    <h1>Your test result:</h1>
    <br>
    <div class="card-group">
        <div class="card text-right" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Gamer Score</h5>
                <p>{{$gamerScore}}</p>
            </div>
        </div>
    </div>
    <div class="card-group">
        <div class="card text-right" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Desktop Score</h5>
                <p>{{$desktopScore}}</p>
            </div>
        </div>

    </div>
    <div class="card-group">
        <div class="card text-right" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Workstation Score</h5>
                <p>{{$workstationScore}}</p>
            </div>
        </div>
    </div>
    <br>
       @endif

@endsection
