@extends('layouts.app')

@section('content')
    <h1>GPUs</h1>
    <br>
    @if(count($gpus) > 0)
        <div class="card-group">
            @for($i = 0; $i < 3; $i++)
                @if(isset($gpus[$i]))
                    <div class="card text-right" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$gpus[$i]->getModel()}}</h5>
                            <a href="/hardwares/gpu/{{$gpus[$i]->getId()}}" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                @endif
            @endfor
        </div>
        <div class="card-group">
            @for($i = 3; $i < 6; $i++)
                @if(isset($gpus[$i]))
                    <div class="card text-right" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$gpus[$i]->getModel()}}</h5>
                            <a href="/hardwares/gpu/{{$gpus[$i]->getId()}}" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                @endif
            @endfor
        </div>
        <div class="card-group">
            @for($i = 6; $i < 9; $i++)
                @if(isset($gpus[$i]))
                    <div class="card text-right" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$gpus[$i]->getModel()}}</h5>
                            <a href="/hardwares/gpu/{{$gpus[$i]->getId()}}" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                @endif
            @endfor
        </div>
        <br>
    @else
        <p>No component found</p>
    @endif
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mr-2" role="group" aria-label="First group">
            <a href="/hardwares/gpus/{{{$button-2}}}"  class="btn btn-secondary">{{{$button-2}}}</a>
            <a href="/hardwares/gpus/{{{$button-1}}}" class="btn btn-secondary">{{{$button-1}}}</a>
            <a href="/hardwares/gpus/{{{$button-0}}}" class="btn btn-secondary">{{{$button}}}</a>
            <a href="/hardwares/gpus/{{{$button+1}}}"  class="btn btn-secondary">{{{$button+1}}}</a>
            <a href="/hardwares/gpus/{{{$button+2}}}"  class="btn btn-secondary">{{{$button+2}}}</a>
        </div>
    </div>
@endsection
