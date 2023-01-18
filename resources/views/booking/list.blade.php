@extends('layouts.app')

@section('content')
    
    <div class="container mx-auto ">
        
        @if ($message = Session::get('success') )
        
            <div class="alert alert-success">
                <p>{{ $message }}</p>
               
            </div>
        @endif
        @if ($message = Session::get('error') )
        
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
               
            </div>
        @endif
        
        {{-- <a class="text-white" href="{{ route('tikets.create') }}">
            <button class="btn btn-primary mb-2">Tambah tiket</button>
        </a> --}}
        <table class="rounded rounded-3 table table-bordered table-hover shadow-lg bg-white">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Inv</th>
                    <th>Nama</th>
                    <th>Tiket</th>
                    <th>Checkin</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($booking as $c)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $c->inv }}</td>
                        <td>{{ $c->customers->name }}</td>
                        <td>{{ $c->tikets->jenis }}</td>
                        <td>{{ $c->checkins->status }}</td>
                        <td>@currency($c->sub_total)</td>
                        <td>
                             <a href="{{ route('booking_check',$c->id) }}">
                                    <span class="btn btn-sm btn-success"><img src="{{url('/svg/check.svg')}}" alt="Image"/></span>
                            </a>
                        </td>
                        {{-- <td>
                            <form action="{{ route('tikets.destroy',$c->id) }}" method="Post">
                                <a href="{{ route('tikets.edit',$c->id) }}">
                                    <span class="btn btn-sm btn-info"><img src="{{url('/svg/edit.svg')}}" alt="Image"/></span>
                                </a>
                                <a href="{{ route('tikets.destroy',$c->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger text-white"><img src="{{url('/svg/hapus.svg')}}" alt="Image"/></button>
                                </a>
                            </form>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
       {{-- {{ $tikets->links() }} --}}
    </div>
    
@endsection