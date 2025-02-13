@extends('layouts.app')
@section('title', 'Trash Customers')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h3>Trash Customers</h3>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ route('customer.index') }}" class="btn"
                                style="background-color: #4643d3; color: white;"><i class="fas fa-chevron-left"></i> Back</a>
                        </div>
                        <div class="col-md-8">
                            <form action="{{ route('customer.trash') }}" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="{{ request('search') }}"
                                        name="search" placeholder="Search anything..." aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary" type="submit"
                                        id="button-addon2">Search</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-2">
                            <form action="{{ route('customer.trash') }}" method="GET" class="form-order">
                                {{-- Menyertakan parameter pencarian agar tidak hilang saat mengubah order --}}
                                @foreach (request()->except('order') as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach

                                <div class="input-group mb-3">
                                    <select class="form-select" name="order" onchange="this.form.submit()">
                                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Newest to
                                            Old</option>
                                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Old to
                                            Newest</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-bordered" style="border: 1px solid #dddddd">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">BAN</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->first_name }}</td>
                                    <td>{{ $item->last_name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->bank_account_number }}</td>
                                    <td>
                                        <a href="{{ route('customer.restore', $item->id) }}" style="color: #2c2c2c;"
                                            class="ms-1 me-1"><i class="fas fa-redo"></i></a>
                                        <a href="javascript:void(0)"
                                            onclick=" if(confirm('Are you sure to delete this customer ?')) document.querySelector('.form-{{ $item->id }}').submit();"
                                            style="color: #2c2c2c;" class="ms-1 me-1"><i class="fas fa-trash-alt"></i></a>
                                        <form class="form-{{ $item->id }}"
                                            action="{{ route('customer.forceDestroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td style="background-color: #e3e0e0" colspan="7" class="text-center">No data found
                                    </td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
