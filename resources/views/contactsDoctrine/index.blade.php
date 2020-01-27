@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-sm-12">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
  <h1>Contacts - Doctrine</h1>
  <div>
    <a style="margin: 19px;" href="{{ route('contacts-doctrine.create')}}" class="btn btn-primary">New contact</a>
  </div>  
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Email</td>
          <td>Job Title</td>
          <td>City</td>
          <td>Country</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
        <tr>
            <td>{{ $contact->getId() }}</td>
            <td>{{ $contact->getFirstName() }} {{ $contact->getLastName() }}</td>
            <td>{{ $contact->getEmail() }}</td>
            <td>{{ $contact->getJobTitle() }}</td>
            <td>{{ $contact->getCity() }}</td>
            <td>{{ $contact->getCountry() }}</td>
            <td>
                <a href="{{ route('contacts-doctrine.edit',$contact->getId())}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('contacts-doctrine.destroy', $contact->getId())}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>
@endsection