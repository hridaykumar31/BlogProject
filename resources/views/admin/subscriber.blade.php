@extends('admin.layouts.app')

@section('title')
    subscriber
@endsection

@php
    $page = 'subscriber';
@endphp

@section('mainpart')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="card-title">All subscriber</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Token Used</th>
                        <th>subscription date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usersWithPayments as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->amount }}</td>
                        <td>{{ $row->token }}</td>
                        <td>{{ $row->created_at }}</td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
