@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Plot') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('plots.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="plot_type" class="col-md-4 col-form-label text-md-end">{{ __('Plot Type') }}</label>
                            <div class="col-md-6">
                                <select id="plot_type" name="plot_type" class="form-select" aria-label="Default select example" @error('plot_type')is-invalid @enderror" >
                                <option value="" selected>Select</option>
                                <option value="R">R</option>
                                <option value="C">C</option>
                                </select>
                                @error('plot_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="plot_number" class="col-md-4 col-form-label text-md-end">{{ __('Plot Number') }}</label>
                            <div class="col-md-6">
                                <input id="plot_number" name="plot_number" type="number" class="form-control @error('plot_number') is-invalid @enderror" value="{{ old('plot_number') }}" autocomplete="plot_number">
                                @error('plot_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="citizenship_number" class="col-md-4 col-form-label text-md-end">{{ __('Citizenship Number') }}</label>
                            <div class="col-md-6">
                                <input id="citizenship_number" name="citizenship_number" type="text" class="form-control @error('plot_number') is-invalid @enderror" value="{{ old('plot_number') }}" autocomplete="citizenship_number">
                                @error('citizenship_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save ') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
