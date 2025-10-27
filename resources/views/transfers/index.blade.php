@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
    <div class="card-header">
        Search Form
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <form action="{{ route('plots.search') }}">
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <select id="plot_type" name="plot_type" class="form-select" aria-label="Default select example" @error('plot_type')is-invalid @enderror" >
                    <option value="" selected>Select Plot Type </option>
                    <option value="R" @if (request()->get('plot_type') == "R") {{ 'selected' }} @endif) >Residencial</option>
                    <option value="C" @if (request()->get('plot_type') == "C") {{ 'selected' }} @endif) >Commercial</option>

                    </select>
                </div>
                <div class="col-md-1">
                    <input id="plot_number" value="{{request()->get('plot_number')}}" name="plot_number" placeholder="Plot#" class="form-control value="{{ old('plot_number') }}" autocomplete="plot_number">
                </div>
                <div class="col-md-2">
                    <input id="citizenship_number" value="{{request()->get('citizenship_number')}}" name="citizenship_number" placeholder="citizenship#" class="form-control value="{{ old('citizenship_number') }}" autocomplete="plot_number">
                </div>


                <div class="col-md-1">
                <button type="submit" class="btn btn-primary">
                                    {{ __('Search ') }}
                </button>
                </div>
            </div>

            </form>
    </div>
    </div>

</br>
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card" id="data-container">

                <div class=" card-header d-flex justify-content-between align-items-center">
                    <div>
                        {{ __('Transfers') }}
                    </div>
                    <div>
                        <a href="{{ route('transfers.create') }}" class="btn btn-success">New Transfer</a>
                    </div>
                </div>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Plot Type/Number</th>
      <th scope="col">Transfered From</th>
      <th scope="col">Transfered To</th>
      <th scope="col">Entry On</th>


    </tr>
  </thead>
  <tbody>
    @foreach ($transfers as $transfer)
    <tr>
      <td scope="row">{{ $loop->index+1}}</td>
      <td>{{ $transfer->plot_type.'/'.$transfer->plot_number }}</td>
        <td>{{ $transfer->transferee_name }}</td>
        <td>{{ $transfer->transferor_name }}</td>
      <td>{{ $transfer->created_at }}</td>
<td><a href="{{ route('transfer.pdf',$transfer->id) }}" class="btn btn-danger btn-sm">Pdf</a></td>

    </tr>
    @endforeach
  </tbody>
</table>
            </div>
        </div>
    </div>
</div>

@endsection


