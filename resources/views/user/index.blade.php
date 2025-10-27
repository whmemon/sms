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
                        {{ __('Plots') }}
                    </div>
                    <div>
                        <a href="{{ route('users.create') }}" class="btn btn-success">New User</a>
                    </div>
                </div>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Created At</th>

      <th scope="col">Actions</th>

    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
      <td scope="row">{{ $loop->index+1}}</td>
      <td>{{ $user->id }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->created_at }}</td>

            <td class="flex"><a href="#" class="btn btn-primary">View</a>
        <a href="{{ route('users.edit',$user->id) }}" class="btn btn-success">Edit</a>
        <a href="#" class="btn btn-danger">Delete</a>
        </td>

    </tr>
    @endforeach
  </tbody>
</table>
            </div>
        </div>
    </div>
</div>

@endsection

