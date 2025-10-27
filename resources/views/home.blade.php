@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

                    <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <div class="flex col-md-6">
                        <a href="{{ route('plots.index') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-house-door fs-1">Plots</i>
                        </a>
                    </div>
                    </br>
                    <div class="flex col-md-6">
                        <a href="{{ route('members.index') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-person fs-1">Members</i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
