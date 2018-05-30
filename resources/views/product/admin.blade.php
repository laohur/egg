<!-- index.blade.php
展示产品列表
获得js变量products
Route::get("/",'ProductController@index');  //展示products列表
Route::get("/products",'ProductController@index');  //展示products列表
Route::get("/search/{keyword}",'ProductController@search');  //返回查询json，用于ajax查询
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>淘理财</title>
    {{--<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <script type="text/javascript"  src="{{ URL::asset('/js/mapping.js')  }}" >
        //此处加载/public/js/*.js静态文件
    </script>
    <script type="text/javascript"  src="{{ URL::asset('/js/jquery-3.3.1.min.js')  }}" ></script>

    <script type="text/javascript">
        products=@json($products);
        var username=<?=$username  ?>;
        //php代码结束，此后是纯html、js、css
    </script>


</head>
<body>
<center>
<h1>淘理财</h1>
<h3>管理列表</h3>
<p><a href="/" >前台</a></p>
<p><a id="home" href="/home" target="_blank" >用户中心</a></p>
<p><a id="admin" href="/admin" target="_blank" >管理列表</a></p>

<script>
    $("#home").text('你好，'+username);
</script>

<p>
    <a id="create" href="http://localhost/product/create" target="_blank" >添加产品</a>
</p>


<div id="lists">
    <table id="list_table">
        <tr id="head_row">
            <td id="product_name">产品名称</td>
            <td id="product_id">产品id</td>
            <td id="status">状态</td>
            <td id="shelf">在售</td>

            <td id="edit">修改</td>
            {{--<td id="del">删除</td>--}}
        </tr>

    </table>

</div>

<script type="text/javascript">

    //index 根据products生成页面
    // alert(products[5]['bank']);
    lists(products);

    function lists(products){
        for(var i=0; i<products.length;i++){
            var product=products[i];
            var href='"http://localhost/product/'+product['product_id']+'"';
            var product_link='<a href='+href+' target="_blank" >'+product['product_name']+'</a>';
            var product_name='<td class="product_name">'+product_link+'</td>';
            var product_id='<td class="product_id">'+product['product_id']+'</td>';
            var status='<td class="status">'+statuses[product['status']]+'</td>';
            var shelf='<td class="shelf">'+shelfes[product['shelf']]+'</td>';
            //产品修改页面  http://localhost/product/1/edit
            var edit='<td class="edit"><a href="http://localhost/product/'+product['product_id']+'/edit" target="_blank" >'+'编辑'+'</td>';
            //删除产品  del http://localhost/product/1
            //var del='<td class="edit"><a href="http://localhost/product/'+product['product_id']+'/">'+'删除'+'</td>';
            //var tr='<tr class="data_row">'+product_name+product_id+status+shelf+edit+del+'</tr>';
            var tr='<tr class="data_row">'+product_name+product_id+status+shelf+edit+'</tr>';
            // console.log(tr);

            $('#list_table').append(tr);
        }
    }
    
    $("td").css('text-align','center');

</script>
</center>
</body>
</html>

