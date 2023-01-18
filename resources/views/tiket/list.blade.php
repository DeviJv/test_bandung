@extends('layouts.app')

@section('content')
    
    <div class="container mx-auto ">
        @if ($message = Session::get('success') )
        
            <div class="alert alert-success">
                <p>{{ $message }} @if($id = Session::get('id'))oops ......<a href="{{ route('tiket_restore',Session::get('id')) }}"> Restore</a>@endif</p>
               
            </div>
        @endif
        
        <a class="text-white" href="{{ route('tikets.create') }}">
            <button class="btn btn-primary mb-2">Tambah tiket</button>
        </a>
        <table class="rounded rounded-3 table table-bordered table-hover shadow-lg bg-white">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jenis</th>
                    <th>Sheet</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tikets as $c)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $c->jenis }}</td>
                        <td>{{ $c->sheet }}</td>
                        <td>@currency($c->harga)</td>
                        <td>
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       {{ $tikets->links() }}
    </div>
    
@endsection