@extends('layouts.app')

@section('content')
    @if($gamerScore == 0)
        <br>
        <h4>Start to build your computer, search a hardware and add to your computer</h4>
        <br>
        <h4>You can see the added computer parts here</h4>
    @else
        <br>
        <div class="btn-group">
        <a href="/session/remove" class="btn btn-danger">Remove all</a><a href="/computers/tested" class="btn btn-secondary">Test this PC</a>
        </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Part</th>
            <th>Model Name</th>
            <th>Details</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $part)
            <tr>
                <th>@if(!isset($part)) - @else{{$part[1]}} @endif</th>
                <th>@if(!isset($part)) not yet added @else{{$part[3]}} @endif</th>
                <th>@if(!isset($part)) - @else <a href="/hardwares/{{strtolower($part[1])}}/{{$part[0]}}" class="btn btn-primary">Details</a>@endif</th>
            </tr>
        @endforeach
        </tbody>
    </table>
        <hr>
        <h4>Your average gamer score with these components: ~{{round($gamerScore)}}</h4>
        <h4>Your average esktop score with these components: ~{{round($desktopScore)}}</h4>
        <h4>Your average workstation score with these components: ~{{round($workstationScore)}}</h4>
    @endif

@endsection
