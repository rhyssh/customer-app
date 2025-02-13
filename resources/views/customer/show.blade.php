@extends('layouts.app')
@section('title', 'Customers Detail')

@section('content')
    <div class="row py-5 px-4">
        <div class="col-md-5 mx-auto"> <!-- Profile widget -->
            <a href="{{ route('customer.index') }}" class="btn mb-3" style="background-color: #4643d3; color: white;"><i
                    class="fas fa-chevron-left"></i> Back</a>
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover">
                    <div class="media align-items-end profile-head d-flex pt-3 gap-3">
                        <div class="profile mr-3">
                            <img src="{{ asset($data->image) }}" alt="..." width="130"
                                class="rounded mb-2 img-thumbnail">
                        </div>
                        <div class="media-body mb-5 text-white">
                            <h4 class="mt-0 mb-0">{{ $data->first_name . ' ' . $data->last_name }}</h4>
                            <p class="small mb-4">{{ $data->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-3">
                    <div class="p-4 rounded shadow-sm bg-light">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 250px;">First Name</td>
                                    <td>{{ $data->first_name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 250px;">Last Name</td>
                                    <td>{{ $data->last_name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 250px;">Email</td>
                                    <td>{{ $data->email }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 250px;">Phone</td>
                                    <td>{{ $data->phone }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 250px;">Account Number</td>
                                    <td>{{ $data->bank_account_number }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 250px;">About</td>
                                    <td>{{ $data->about }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
