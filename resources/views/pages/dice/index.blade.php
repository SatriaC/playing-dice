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
        <div class="row">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <form action="{{ route('dice.store') }}" method="post">
                        @csrf
                        <div class="col-12">
                            <div class="row">
                                <div class="mb-3 row">
                                    <label for="player" class="col-sm-3 col-form-label">Player</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="player" id="player">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="dice" class="col-sm-3 col-form-label">Dice</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="dice" id="dice">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
