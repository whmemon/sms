@extends('layouts.public')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify your transfer') }}</div>

                <div class="card-body">
                    <form id="verifyForm" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="reference_number" class="col-md-4 col-form-label text-md-end">{{ __('Transfer Reference Number') }}</label>

                            <div class="col-md-6">
                                <input id="reference_number" type="number" class="form-control @error('reference_number') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('reference_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Verify') }}
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

<div id="result"></div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {

    $('#verifyForm').submit(function (e) {
        e.preventDefault();

        $('#reference_error').html('');

        $.ajax({
            url: "{{ url('/verify-reference') }}",
            type: "POST",
            data: {
                reference_number: $('#reference_number').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

                let data = response.data;

                Swal.fire({
                    icon: 'success',
                    title: 'Reference Verified',
                    html: `
                        <table style="width:100%; text-align:left">
                            <tr><th>Reference No:</th><td>${data.reference_number}</td></tr>
                            <tr><th>Plot No:</th><td>${data.plot_number}</td></tr>
                            <tr><th>Transferee Name:</th><td>${data.transferee_name} ${data.kin} ${data.transferee_father_name}</td></tr>
                            <tr><th>Transfer Date:</th><td>${data.transfer_date}</td></tr>
                        </table>
                    `,
                    confirmButtonText: 'OK'
                });
            },
            error: function (xhr) {

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.reference_no) {
                        $('#reference_error').html(errors.reference_no[0]);
                    }
                }
                else if (xhr.status === 404) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Reference',
                        text: xhr.responseJSON.message
                    });
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.'
                    });
                }
            }
        });
    });

});
</script>