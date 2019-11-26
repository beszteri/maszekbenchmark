@extends('layouts.app')

@section('content')
    <h1>RAMs</h1>
    <br>
    @if(count($rams) > 0)
        <div class="card-group">
            @for($i = 0; $i < 3; $i++)
                @if(isset($rams[$i]))
                    <div class="card text-right" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$rams[$i]->getModel()}}</h5>
                            <a href="/hardwares/ram/{{$rams[$i]->getId()}}" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                @endif
            @endfor
        </div>
        <div class="card-group">
            @for($i = 3; $i < 6; $i++)
                @if(isset($rams[$i]))
                    <div class="card text-right" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$rams[$i]->getModel()}}</h5>
                            <a href="/hardwares/ram/{{$rams[$i]->getId()}}" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                @endif
            @endfor
        </div>
        <div class="card-group">
            @for($i = 6; $i < 9; $i++)
                @if(isset($rams[$i]))
                    <div class="card text-right" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$rams[$i]->getModel()}}</h5>
                            <a href="/hardwares/ram/{{$rams[$i]->getId()}}" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                @endif
            @endfor
        </div>
        <br>
    @else
        <p>No posts found</p>
    @endif
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-2" role="group" aria-label="First group">
            <a href="/hardwares/rams/{{{$button-2}}}"  class="btn btn-secondary">{{{$button-2}}}</a>
            <a href="/hardwares/rams/{{{$button-1}}}" class="btn btn-secondary">{{{$button-1}}}</a>
            <a href="/hardwares/rams/{{{$button-0}}}" class="btn btn-secondary">{{{$button}}}</a>
            <a href="/hardwares/rams/{{{$button+1}}}"  class="btn btn-secondary">{{{$button+1}}}</a>
            <a href="/hardwares/rams/{{{$button+2}}}"  class="btn btn-secondary">{{{$button+2}}}</a>
        </div>
    </div>
@endsection
