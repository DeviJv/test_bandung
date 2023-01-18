@extends('layouts.app')

@section('content')
    
    <div class="container mx-auto ">
        @if ($message = Session::get('success') )
        
            <div class="alert alert-success">
                <p>{{ $message }} @if($id = Session::get('id'))oops ......<a href="{{ route('customer_restore',Session::get('id')) }}"> Restore</a>@endif </p>
               
            </div>
        @endif

        
        
        <a class="text-white" href="{{ route('customers.create') }}">
            <button class="btn btn-primary mb-2">Tambah Customer</button>
        </a>
        <table class="rounded rounded-3 table table-bordered table-hover shadow-lg bg-white">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $c)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ $c->alamat }}</td>
                        <td>
                            <form action="{{ route('customers.destroy',$c->id) }}" method="Post">
                                <a href="{{ route('customers.edit',$c->id) }}">
                                    <span class="btn btn-sm btn-info"><img src="{{url('/svg/edit.svg')}}" alt="Image"/></span>
                                </a>
                                <a href="{{ route('customers.destroy',$c->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger text-white"><img src="{{url('/svg/hapus.svg')}}" alt="Image"/></button>
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       {{ $customers->links() }}
    </div>
    
@endsection