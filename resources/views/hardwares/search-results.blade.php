@extends('layouts.app')

@section('content')
<h1>Search Results</h1>
    <p>{{$hardwares->count()}} results for '{{ request()->input('query') }}'</p>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Part</th>
                <th>Model Name</th>
                <th>Details</th>
                <th>Add to My Setup</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($hardwares as $hardware)
        <tr>
            <th>{{ $hardware->part }}</th>
            <th>{{ $hardware->model }}</th>
            <th><a href="/hardwares/{{strtolower($hardware->part)}}/{{$hardware->id}}" class="btn btn-primary">Details</a></th>
            <th><a href="/session/set/{{$hardware->id}}" class="btn btn-primary">Add</a></th>
        </tr>
        @endforeach
        </tbody>
    </table>

@endsection
