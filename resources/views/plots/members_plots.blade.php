@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card" id="data-container">

                <div class=" card-header d-flex justify-content-between align-items-center">
                    <div>
                        {{ __('Plots Per Member') }}
                    </div>
                    <div>

                    </div>
                </div>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">No of Plots</th>
      <th scope="col">Plot Number</th>


    </tr>
  </thead>
  <tbody>
    @foreach ($plots as $plot)
    <tr>
      <td scope="row">{{ $loop->index+1}}</td>
      <td>{{ $plot->CNT }}</td>
      <td>{{ $plot->MEMBER }}</td>

    </tr>
    @endforeach
  </tbody>
</table>
            </div>
        </div>
    </div>
</div>

@endsection

