@extends('layouts.app')

@section('content')
    <h1>Hardwares</h1>
    <div class="card text-center">
        <div class="card-header">
            <h3>CPUs</h3>
        </div>
        <div class="card-body">
            <p class="card-text">See all the cpus from database.</p>
            <a href="/hardwares/cpus/1" class="btn btn-primary">List CPUs</a>
        </div>
    </div>
    <br>
    <div class="card text-center">
        <div class="card-header">
            <h3>GPUs</h3>
        </div>
        <div class="card-body">
            <p class="card-text">See all the gpus from database.</p>
            <a href="/hardwares/gpus/1" class="btn btn-primary">List GPUs</a>
        </div>
    </div>
    <br>
    <div class="card text-center">
        <div class="card-header">
            <h3>RAMs</h3>
        </div>
        <div class="card-body">
            <p class="card-text">See all the rams from database.</p>
            <a href="/hardwares/rams/1" class="btn btn-primary">List RAMs</a>
        </div>
    </div>
    <br>
    <div class="card text-center">
        <div class="card-header">
            <h3>SSDs</h3>
        </div>
        <div class="card-body">
            <p class="card-text">See all the SSDs from database.</p>
            <a href="#" class="btn btn-primary">List SSDs</a>
        </div>
    </div>
    <br>
    <div class="card text-center">
        <div class="card-header">
            <h3>HDDs</h3>
        </div>
        <div class="card-body">
            <p class="card-text">See all the HDDs from database.</p>
            <a href="/hardwares/hdds/1" class="btn btn-primary">List HDDs</a>
        </div>
    </div>
@endsection
