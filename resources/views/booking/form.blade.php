@extends('layouts.app')

@section('content')
<div class="container  bg-white shadow-lg p-3">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Tambah Tiket</h2>
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
           
        
        <?php if (Route::currentRouteName()==='tikets.create'){
            $url=route('tikets.store');
            $method="POST";
        }else{
            $url=route('tikets.update',$tiket->id); 
            $method="PUT";
        }?>
        <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Jenis:</strong>
                        <div class="form-group">
                        <strong>Alamat:</strong>
                        <select class="form-select" name="jenis" aria-label="Default select example">
                            <option selected>Pilih tiket</option>
                            <option value="Reguler" <?php if((isset($tiket)) && $tiket->jenis=='reguler'){echo "selected";}else{}?>>Reguler</option>
                            <option value="VIP" <?php if((isset($tiket)) && $tiket->jenis=='vip'){echo "selected";}else{}?>>VIP</option>
                        </select>
                        @error('jenis')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Sheet:</strong>
                        <input type="text" name="sheet" class="form-control" placeholder=" Sheet" value=<?php if (isset($tiket)){echo $tiket->sheet;}else{}?>>
                        @error('sheet')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Harga:</strong>
                        <input type="text" name="harga" class="form-control" placeholder=" Harga" value="<?php if (isset($tiket)){echo $tiket->harga;}else{}?>">
                        @error('harga')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
               
                <div class="col-12">
                <button type="submit" class="btn btn-success ml-3 mt-3 float-end">Simpan</button>
                    <a class="btn btn-danger float-start ml-3 mt-3" href="{{ route('tikets.index') }}"> Back</a>
                </div>
            </div>
        </form>
    </div>
@endsection