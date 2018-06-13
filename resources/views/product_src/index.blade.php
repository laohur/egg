<!-- index.blade.php
展示产品列表
获得js变量products
Route::get("/",'ProductController@index');  //展示index列表
Route::get("/products",'ProductController@index');  //展示index列表
Route::get("/search/{keyword}",'ProductController@search');  //返回查询json，用于ajax查询
-->
<!DOCTYPE html>
<html>
<head>
    <title>淘理财</title>
    <script>
        products=@json($products);
    </script>
</head>
<body>
<h1>products</h1>
<a href="/home">用户中心</a>

@foreach($products as $product)
    <table>
        <tr>
            <td ><a {{"href=./product/".$product->product_id}}> name: {{ $product->product_name }}</a></td>
            <td>bank: {{ $product->bank }}</td>
            <td>min amount: {{ $product->min_amount }}</td>
            <td>product id: {{ $product->product_id }}</td>
            <td><a href="{{action('ProductController@edit', $product->product_id)}}">编辑</a>
        </tr>
 @endforeach
</body>
</html>

<!-- index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div class="container">
    <br />
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Passport Office</th>
            <th colspan="2">Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($passports as $passport)
            @php
                $date=date('Y-m-d', $passport['date']);
            @endphp
            <tr>
                <td>{{$passport['id']}}</td>
                <td>{{$passport['name']}}</td>
                <td>{{$date}}</td>
                <td>{{$passport['email']}}</td>
                <td>{{$passport['number']}}</td>
                <td>{{$passport['office']}}</td>

                <td><a href="{{action('PassportController@edit', $passport['id'])}}" class="btn btn-warning">Edit</a></td>
                <td>
                    <form action="{{action('PassportController@destroy', $passport['id'])}}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>