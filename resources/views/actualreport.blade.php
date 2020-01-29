@extends('layouts.reports')
@section('content')
    <p>Below is a break down of the various activities that
        occurred in the organization with regards to sending emails</p>
    <table class="table table-striped">
        <thead>
        <th>Due date</th>
        <th>Borrow date</th>
        <th>Order date</th>
        <th>Return date</th>
        <th>name </th>
        <th>email</th>
        </thead>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{$book ->due_date}}</td>
                <td>{{$book ->borrow_date}}</td>
                <td>{{$book ->order_date}}</td>
                <td>{{$book ->return_date}}</td>
                <td>{{$book ->name}}</td>
                <td>{{$book -> email}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
