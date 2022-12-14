@extends('template')
@section('content')

@if(Auth::check() && Auth::user()->is_admin)
<a class="btn btn-primary btn-sm" href="{{ route('ingredients.create') }}">Nou</a>
@endif

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nom</th>
        @if(Auth::check() && Auth::user()->is_admin)
        <th scope="col" colspan="2">Operacions</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach($ingredients as $ingredient)
      <tr>
        <td>
          {{ $ingredient->id }}
        </td>
        <td>
          {{ $ingredient->nom }}
        </td>
        @if(Auth::check() && Auth::user()->is_admin)
        <td>
          <a class="btn btn-primary" href="{{ route('ingredients.edit', $ingredient->id) }}" role="button">Modificar</a>
        </td>
        <td>
          <a class="btn btn-danger" href="{{ route('ingredients.destroy', $ingredient->id)}}" role="button">Esborrar</a>
        </td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{ $ingredients -> links('pagination::bootstrap-4') }}

@endsection