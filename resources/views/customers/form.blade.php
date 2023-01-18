@extends('layouts.app')

@section('content')
<div class="container  bg-white shadow-lg p-3">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Tambah Customers</h2>
                    <hr>
                </div>
                
            </div>
        </div>
       @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      
        <?php if (Route::currentRouteName()=='customers.create'){
            $url=route('customers.store');
            $method="POST";
        }else{
            $url=route('customers.update',$customer->id); 
            $method="PUT";
        }?>
        <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="<?php if(isset($customer)){echo $customer->name;}else{}?>">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        <input type="email" name="email" class="form-control" placeholder=" Email" value="<?php if(isset($customer)){echo $customer->email;}else{}?>">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Alamat:</strong>
                        <input type="text" name="alamat" class="form-control" placeholder=" Alamat" value="<?php if(isset($customer)){echo $customer->alamat;}else{}?>">
                        @error('alamat')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Alamat:</strong>
                        <select class="form-select" name="gender" aria-label="Default select example">
                            <option selected>Pilih Jenis Kelamin</option>
                            <option value="L" <?php if(isset($customer) && $customer->gender=='L'){echo "selected";}else{}?>>Laki-Laki</option>
                            <option value="P" <?php if(isset($customer) && $customer->gender=='P'){echo "selected";}else{}?>>Perempuan</option>
                        </select>
                        @error('gender')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                <button type="submit" class="btn btn-success ml-3 mt-3 float-end">Simpan</button>
                    <a class="btn btn-danger float-start ml-3 mt-3" href="{{ route('customers.index') }}"> Back</a>
                </div>
            </div>
        </form>
    </div>
@endsection