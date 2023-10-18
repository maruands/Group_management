@extends('layouts.app')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-2">
                    <div class="card-header">
                        Add new member to .....
                    </div>
                    <div class="card-body">
                        <form action="{{ route('addmember.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">{{__('Select member')}}</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="user_id" id="" class="form-control">
                                        @foreach($users as $data)
                                        <option value="{{$data->id}}" >{{$data->name}}</option>
                                        @endforeach 
                                    </select>
                                    <input type="hidden" name="setdeposit_id" value="{{$deposit_id}}">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn-sm btn-primary">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection