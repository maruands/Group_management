@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card m-3">
                <div class="card-header">{{ __('Register New Member') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dairy.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="" autofocus>

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Item" class="col-md-4 col-form-label text-md-end">{{ __('Item') }}</label>

                            <div class="col-md-6">
                                <input id="Item" type="text" class="form-control @error('Item') is-invalid @enderror" name="Item" value="">

                                @error('Item')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="quantity" class="col-md-4 col-form-label text-md-end">{{ __('Quantity') }}</label>

                            <div class="col-md-6">
                                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="" >

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Buying price" class="col-md-4 col-form-label text-md-end">{{ __('Buying price') }}</label>

                            <div class="col-md-6">
                                <input id="Buying price" type="number" class="form-control @error('buying_price') is-invalid @enderror" name="buying_price" value="" >

                                @error('buying_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="selling price" class="col-md-4 col-form-label text-md-end">{{ __('Selling price') }}</label>

                            <div class="col-md-6">
                                <input id="selling price" type="number" class="form-control @error('selling_price') is-invalid @enderror" name="selling_price" value=""  >

                                @error('selling_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="expendicture" class="col-md-4 col-form-label text-md-end">{{ __('Expendicture') }}</label>

                            <div class="col-md-6">
                                <input id="expendicture" type="number" class="form-control @error('expendicture') is-invalid @enderror" name="expendicture" value="" >

                                @error('expendicture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Recieved Amount" class="col-md-4 col-form-label text-md-end">{{ __('Recieved Amount') }}</label>

                            <div class="col-md-6">
                                <input id="Recieved Amount" type="number" class="form-control @error('receive_amount') is-invalid @enderror" name="receive_amount" value="" >

                                @error('receive_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
