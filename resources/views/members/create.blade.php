@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Member') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('members.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                <select id="gender" name="gender"  class="form-control @error('gender') is-invalid @enderror"  class="form-select">
                                <option selected value="">Select</option>
                                <option value="M" {{ old('gender')=='M'?' SELECTED ':'' }}>Male</option>
                                <option value="F" {{ old('gender')=='F'?' SELECTED ':'' }}>Female</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kin" class="col-md-4 col-form-label text-md-end">{{ __('Kin') }}</label>
                            <div class="col-md-6">
                                <select id="kin" name="kin" class="form-control @error('kin') is-invalid @enderror">
                                <option selected value="">Select</option>
                                <option value="SO" {{ old('kin')=='SO'?' SELECTED ':'' }}>Son of </option>
                                <option value="WO" {{ old('kin')=='WO'?' SELECTED ':'' }}>Wife of </option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="father_name" class="col-md-4 col-form-label text-md-end">{{ __('Father Name') }}</label>
                            <div class="col-md-6">
                                <input id="father_name" name="father_name" type="text" class="form-control @error('father_name') is-invalid @enderror"  value="{{ old('father_name') }}" autocomplete="father_name">
                                @error('father_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="husband_name" class="col-md-4 col-form-label text-md-end">{{ __('Husband Name') }}</label>
                            <div class="col-md-6">
                                <input id="husband_name" name="husband_name" type="text" class="form-control @error('husband_name') is-invalid @enderror" value="{{ old('husband_name') }}" autocomplete="husband_name">
                                @error('husband_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="citizenship_number" class="col-md-4 col-form-label text-md-end">{{ __('CNIC') }}</label>
                            <div class="col-md-6">
                                <input id="citizenship_number" name="citizenship_number" type="text" class="form-control @error('citizenship_number') is-invalid @enderror" value="{{ old('citizenship_number') }}" autocomplete="citizenship_number">
                                @error('citizenship_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cellphone" class="col-md-4 col-form-label text-md-end">{{ __('Cell Phone') }}</label>
                            <div class="col-md-6">
                                <input id="cellphone" name="cellphone" type="text" class="form-control @error('cellphone') is-invalid @enderror" value="{{ old('cellphone') }}"  autocomplete="cellphone">
                                @error('cellphone')
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
