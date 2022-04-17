@extends('layouts.admin')

@section('title', 'Data Employee')
@section('content')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Success</h4>
                <div class="alert-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (!empty($winners))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Congratulations !!</h4>
            <div class="alert-body">
                 @foreach ($winners as $winner)
                Player {{ $winner }},
            @endforeach is the winner !!!
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif ($countdown == 0)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Congratulations !!</h4>
            <div class="alert-body">
                Player {{ $winner2->id }} is the winner !!!
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif (empty($winners) && $countdown == 0 && $winner2->points == 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">OOWWW !!</h4>
            <div class="alert-body">
                No winner !!!
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form action="{{ route('dice.reset') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger"
                onclick="return confirm('Do you want to do this action ?')">
                Reset
            </button>
        </form>
        <div class="row">
            @for ($i = 0; $i < $rolls; $i++)
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                @foreach ($players as $keyP => $item)
                                    <p>Player {{ $item->id }} ({{ $item->points }}) :
                                        @if (isset($dice[$keyP][$i]))
                                            |@foreach ($dice[$keyP][$i] as $value)
                                                {{ $value->dice }}
                                                |
                                            @endforeach
                                        @else
                                        @endif
                                    </p>
                                @endforeach
                                <div class="flex-row d-flex">
                                    <form action="{{ route('dice.count', $i + 1) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-secondary"
                                            onclick="return confirm('Do you want to do this action ?')">
                                            Count Score
                                        </button>
                                    </form> &nbsp
                                    @if ($countdown != 0)
                                        @if (empty($winners))
                                            <form action="{{ route('dice.roll') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-info"
                                                    onclick="return confirm('Do you want to do this action ?')">
                                                    Next Roll
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-6"></div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>


@endsection
