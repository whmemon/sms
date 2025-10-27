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
                <div class="col-md-3">
                <div class="form-check form-check-inline">

                <input @if (request()->get('posession_status') == 1) {{ 'checked' }} @endif class="form-check-input" checked type="radio" name="posession_status" id="inlineRadio1" value="1">
                <label class="form-check-label" for="inlineRadio1">All</label>
                </div>
                <div class="form-check form-check-inline">
                <input @if (request()->get('posession_status') == 2) {{ 'checked' }} @endif class="form-check-input" type="radio" name="posession_status" id="inlineRadio2" value="2">
                <label class="form-check-label" for="inlineRadio2">Unclaimed</label>
                </div>
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
                        <a href="{{ route('plots.create') }}" class="btn btn-success">New Plot</a>
                    </div>
                </div>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Plot Type</th>
      <th scope="col">Plot Number</th>
      <th scope="col">Folio Number</th>
      <th scope="col">Member Name</th>
      <th scope="col">Cell Phone</th>
      <th scope="col">Actions</th>

    </tr>
  </thead>
  <tbody>
    @foreach ($plots as $plot)
    <tr id="row-{{ $plot->id }}" @if($plot->status != null) class="table-danger" @else btn-secondary @endif>
      <td scope="row">{{ $loop->index+1}}</td>
      <td>{{ $plot->plot_type }}</td>
      <td>{{ $plot->plot_number }}</td>
      <td>{{ $plot->folio_number }}</td>
      <td>{{ $plot->member_name }}</td>
      <td>{{ $plot->cellphone }}</td>
            <td class="flex"><a href="#" class="btn btn-primary">View</a>
        <a href="{{ route('plots.edit',$plot->id) }}" class="btn btn-success">Edit</a>
        <a href="#" class="btn btn-danger">Delete</a>
        <button data-id="{{ $plot->id }}" type="button" class="btn btn-primary" name="markbtn" id="markbtn">
        Mark
        </button>
        </td>

    </tr>
    @endforeach
  </tbody>
</table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Mark Plot</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
         <select class="form-select" aria-label="Select Tag" name="plot_tag" id="plot_tag">
            <option value="" selected>Select</option>
            <option value="0">Clear</option>
            <option value="1">Duplicate File</option>
            <option value="2">Defaulter</option>
        </select>
        <input type="hidden" id="id" name="id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="markplot" name="markplot" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    $("body").on("click","#markbtn",function(){
        let id = $(this).attr("data-id");

        $.ajax({
                type:"GET",
                url:"/plots/"+id+"/mark",
                dataType:'json',
                success:function(response)
                {
                    console.log(response);
                    $('#id').val(response.plot.id);
                    $('#exampleModal').modal("show");

                },
                error:function(error)
                {
                    console.log(error);
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })


    });

    $("#markplot").click(
        function(){
            let formData = {
                plot_tag:$('#plot_tag').val(),
                id:$('#id').val()


            }
            $.ajax({
                type:"POST",
                url:"{{ route("plots.mark.post") }}",
                data:formData,
                dataType:'json',
                success:function(response)
                {

                    if(response.status === 0 || response.status === null)
                    {
                        $("#row-"+response.id).addClass("table-success");
                        $("#row-"+response.id).removeClass("table-danger");

                    }else{
                        $("#row-"+response.id).addClass("table-danger");
                        $("#row-"+response.id).removeClass("table-success");
                    }

                    $('#exampleModal').modal("hide");


                },
                error:function(error)
                {
                    console.log(error);
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

        }
    )
})
</script>
@endsection


