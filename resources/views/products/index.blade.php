@extends('Layouts.app')
@section('content')
    <main class="container">
        <section>
            <div class="titlebar">
                <h1>Products</h1>
{{--                <button>Add Product</button>--}}
            <a href="{{route('products.create')}}" class="btn-link">Add Product</a>
            </div>
            @if($message = Session::get('success'))
                <div>
                    <ul>
                        <li>{{$message}}</li>
                    </ul>
                </div>

            @endif
            <div class="table">
                <div class="table-filter">
                    <div>
                        <ul class="table-filter-list">
                            <li>
                                <p class="table-filter-link link-active">All</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <form method="GET" action="{{route('products.index')}}" accept-charset="UTF-8" role="search">
                <div class="table-search">
                    <div>
                        <button class="search-select">
                            Search Product
                        </button>
                        <span class="search-select-arrow">
                            <i class="fas fa-caret-down"></i>
                        </span>
                    </div>
                    <div class="relative">
                        <input class="search-input" type="text" name="search" placeholder="Search product..." value="{{ request('search') }}">
                    </div>
                </div>
                </form>
                <div class="table-product-head">
                    <p>Image</p>
                    <p>Name</p>
                    <p>Category</p>
                    <p>Inventory</p>
                    <p>Actions</p>
                </div>
                <div class="table-product-body">
                    @if(count($products) >0)
                        @foreach($products as $product)
                            <img src="{{asset('images/' . $product->image)}}"/>
                            <p> {{$product->name}}</p>
                            <p>{{$product->category}}</p>
                            <p>{{$product->quantity}}</p>
                            <div>
                                <a href="{{route('products.edit', $product->id)}}" class="btn-link btn btn-success">
                                    <i class="fas fa-pencil-alt" ></i>
                                </a>
                                <form method="POST" action="{{route('products.destroy', $product->id)}}">
                                    @method('delete')
                                    @csrf
                                <button class="btn btn-danger" onclick="deleteConfirm(event)" >
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                </form>
                            </div>
                        @endforeach
                    @else
                        <p>Product not found</p>
                    @endif

                </div>
                <div class="table-paginate">
                    {{$products->links('Layouts.pagination')}}
                </div>
            </div>
        </section>
    </main>
<script>
    window.deleteConfirm = function (e) {
        e.preventDefault();
        var form = e.target.form;
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    }
</script>

@endsection
