@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ url('list/cba') }}" autocomplete="off">
            @csrf
            <input hidden value="{{ Auth::user()->id }}" name="id">
            <div class="input-group mb-3">
                <input type="text" id="search" required name="name" class="form-control" placeholder="Chocolate" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <input class="btn btn-primary" value="Add to shopping list" type="submit">
                </div>
            </div>
        </form>
        {{-- For autocomplete --}}
        <script type="text/javascript">
            var route = "{{ url('autocomplete-search') }}";
            $('#search').typeahead({
                source: function(query, process) {
                    return $.get(route, {
                        query: query
                    }, function(data) {
                        return process(data);
                    });
                }
            });
        </script>
        {{-- End for autocomplete code --}}
        <div class="list-group">
            <form method="get" action="../list">
                <div class="list-group-item list-group-item-action d-flex bg-secundary">
                    <a class="text-black" href="#/"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="100%" fill="currentColor"
                            class="bi bi-funnel-fill text-primary" viewBox="0 0 16 16" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample">
                            <path
                                d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z" />
                        </svg></a>
                </div>
                <div class="collapse" id="collapseExample">
                    <div class="bg-secundary card-footer">
                        <div class="input-group">
                            <select name="sort" class="custom-select">
                                <option selected>Choose...</option>
                                <option value="name">Product</option>
                                <option value="updated_at">Newest</option>
                                <option value="user">User</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Sort</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="list-group">
            @foreach ($products->sortBy(request('sort')) as $product)
                @if ($product->on_list == true)
                    <div class="d-flex mt-3 justify-content-between">
                        <div class="list-group-item list-group-item-action d-flex justify-content-between bg-secundary">
                            <a class="text-primary" href="#/"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="100%" fill="currentColor"
                                    class="bi bi-caret-down" viewBox="0 0 16 16" data-toggle="collapse" data-target="#collapseExample{{ $product->id }}"
                                    aria-expanded="false" aria-controls="collapseExample{{ $product->id }}">
                                    <path
                                        d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                                </svg>
                            </a>
                            <h3 style="margin: 0px">{{ $product->name }}</h3>
                            <div>
                                <form method="POST" action="{{ url('list/edit') }}">
                                    {{ method_field('PUT') }}
                                    <input value="Remove" type="submit" class="btn btn-danger">
                                    <input hidden value="{{ $product->id }}" name="id">
                                    @csrf
                                </form>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="collapse" id="collapseExample{{ $product->id }}">
                        <div class="card-footer bg-secundary">
                            <p>Requested by: {{ $product->user->name }} - {{ $product->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>

                @endif
            @endforeach

        @endsection
