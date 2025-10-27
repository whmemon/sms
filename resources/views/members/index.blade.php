@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
    <div class="card-header">
        Search Form
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
        <p>A well-known quote, contained in a blockquote element.</p>
        <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
        </blockquote>
    </div>
    </div>

    </br>
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class=" card-header d-flex justify-content-between align-items-center">
                    <div>
                        Members
                    </div>
                    <div>
                        <a href="{{ route('members.create') }}" class="btn btn-success">New Member</a>
                    </div>
                </div>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Member Name</th>
      <th scope="col">Kin</th>
      <th scope="col">Father / Husband Name</th>
      <th scope="col">CNIC</th>
      <th scope="col">Contact Number</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($members as $member)
    <tr>
      <td scope="row">{{ $loop->index+1}}</td>
      <td>{{ $member->name }}</td>
      <td>{{ $member->kin }}</td>
      <td>{{ $member->father_name }}</td>
      <td>{{ $member->citizenship_number }}</td>
      <td>{{ $member->cellphone }}</td>
      <td class="flex"><a href="#" class="btn-sm btn btn-primary">View</a>
        <a href="{{ route('members.edit',$member->id) }}" class="btn btn-success btn-sm">Edit</a>
        <a href="{{ route('members.destroy',$member->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
