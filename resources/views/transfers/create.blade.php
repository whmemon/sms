@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('New Transfer') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('transfers.store') }}">
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
                            <label for="citizenship_number" class="col-md-4 col-form-label text-md-end">{{ __('Transferor CNIC #') }}</label>
                            <div class="col-md-6">
                                <input id="citizenship_number" name="citizenship_number" type="text" class="form-control @error('plot_number') is-invalid @enderror" value="{{ old('plot_number') }}" autocomplete="citizenship_number">
                                @error('citizenship_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="transfer_type" class="col-md-4 col-form-label text-md-end">{{ __('Transfer Type') }}</label>
                            <div class="col-md-6">
                                <select id="transfer_type" name="transfer_type" class="form-select" aria-label="Default select example" @error('transfer_type')is-invalid @enderror" >
                                <option value="" selected>Select</option>
                                <option value="R">Sale</option>
                                <option value="C">Inheritance/Succession</option>
                                <option value="G">Gift/Donation</option>
                                </select>
                                @error('plot_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="tex-center">
                        <hr>
  <div id="education_fields">
                        <div id="original-field-container">
                        <div class="row mb-3">
                            <label for="transferee_cnic[0]" class="col-md-4 col-form-label text-md-end">{{ __('Transferee CNIC #') }}</label>
                            <div class="col-md-6">
                                <input id="transferee_cnic" name="transferee_cnic[0]" type="text" class="form-control @error('plot_number') is-invalid @enderror" value="{{ old('plot_number') }}" autocomplete="citizenship_number">
                                @error('transferee_cnic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="transferee_name" class="col-md-4 col-form-label text-md-end">{{ __('Transferee Name') }}</label>
                            <div class="col-md-2">
                                <input id="transferee_name" name="transferee_name[0]" type="text" class="form-control @error('transferee_name[0]') is-invalid @enderror" value="{{ old('plot_number') }}" autocomplete="plot_number">
                                @error('transferee_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-2">
                                <select id="kin" name="kin[0]" class="form-control @error('kin') is-invalid @enderror">
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

                            <div class="col-md-2">
                                <input id="kin_name" name="kin_name[0]" type="text" class="form-control @error('kin_name') is-invalid @enderror" value="{{ old('plot_number') }}" autocomplete="plot_number">
                                @error('kin_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">    <button type="button" class="remove-field">Remove</button> </div>

                        </div>

                        </div>
                        <div id="cloned-fields-area"></div>
                        <div class="col-md-12 offset-md-10">
                                    <button class="btn btn-success" type="button"  id="add-field"> Add <span class="fa fa-plus" aria-hidden="true"></span> </button>
                            </div>

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
<script>
 $(document).ready(function() {

        let fieldCounter = 1; // To ensure unique names/IDs for cloned fields

        $('#add-field').on('click', function() {

            const $originalContainer = $('#original-field-container');
            const $clonedContainer = $originalContainer.clone();
            // Update attributes (IDs and names) to ensure uniqueness and proper data submission
            $clonedContainer.attr('id', 'cloned-field-container-' + fieldCounter);
            $clonedContainer.find('#kin_name').attr('name', 'kin_name[' + fieldCounter + ']');
            $clonedContainer.find('#kin').attr('name', 'kin[' + fieldCounter + ']');
            $clonedContainer.find('#transferee_name').attr('name', 'transferee_name[' + fieldCounter + ']');
            $clonedContainer.find('#transferee_cnic').attr('name', 'transferee_cnic[' + fieldCounter + ']');
            // Clear input values in the cloned fields (optional)
            $clonedContainer.find('input').val('');
            // Append the cloned container to the desired area
            $('#cloned-fields-area').append($clonedContainer);

            fieldCounter++;
        });

        // Event listener for removing cloned fields (delegated event for dynamically added elements)
        $(document).on('click', '.remove-field', function() {
            $(this).closest('div[id^="cloned-field-container-"]').remove();
        });
    });
</script>
@endsection
