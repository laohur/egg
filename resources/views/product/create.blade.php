<!-- create.blade.php
入口：
Route::get("/product/create",'ProductController@create');  //新产品填写表单页  http://localhost/product/create

出口：Route::post("/product",'ProductController@store');  //提交新产品   post  http://localhost/product

接口：
form action : post  http://localhost/product
input[] name:[
status
min_amount
shelf
risk
rank
life
product_start
product_end
min_rate
max_rate
area
bank
product_name
introduction
]

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
        var username=<?=$username  ?>;
        //php代码结束，此后是纯html、js、css
    </script>


</head>
<body>

<center>
<h1>淘理财</h1>
<h3>添加产品</h3>
<p><a href="/" target="_blank" >前台</a></p>
<p><a id="home" href="/home" target="_blank" >用户中心</a></p>
<p><a id="admin" href="/admin" target="_blank" >管理列表</a></p>



<script>
    $("#home").text('你好，'+username);
</script>

<form method="POST" action="{{url('/product')}}">
    {{ csrf_field()  }}

    <table>
        <tr >
            <td><label>产品名称：</label></td>
            <td><input type="text"   name="product_name" pattern=".{4,}" required title="最少四个字符" /></td>
        </tr>

        <tr>
            <td><label>发售银行：</label></td>
            <td><input type="text" name="bank" pattern=".{4,}" required title="最少四个字符" /></td>
        </tr>

        <tr>
            <td><label>产品状态：</label></td>
            <td><input type="number" name="status" min="1" max="5"  /></td>
        </tr>

        <tr>
            <td><label>起投额：</label></td>
            <td><input type="number" name="min_amount"  min="1000"  /></td>
        </tr>

        <tr>
            <td><label>在架否：</label></td>
            <td>
                <input type="radio" name="shelf" value="1" />在架
                <input type="radio" name="shelf" value="0" />不在架
            </td>
        </tr>

        <tr>
            <td><label>风险等级：</label></td>
            <td><input type="number" name="risk" min="0" max="6"/></td>
        </tr>

        <tr>
            <td><label>推荐指数：</label></td>
            <td><input type="number" name="rank" /></td>
        </tr>
        <tr>
            <td><label>产品周期（天）：</label></td>
            <td><input type="number" name="life" min="1" /></td>
        </tr>
        <tr>
            <td><label>产品开始日：</label></td>
            <td><input type="date" name="product_start" /></td>
        </tr>
        <tr>
            <td><label>产品终止日：</label></td>
            <td><input type="date" name="product_end" /></td>
        </tr>
        <tr>
            <td><label>预期最小收益率（万分之一）：</label></td>
            <td><input type="number" name="min_rate" min="1"   /></td>
        </tr>
        <tr>
            <td><label>预期最大收益率（万分之一）：</label></td>
            <td><input type="number" name="max_rate" min="1"   /></td>
        </tr>
        <tr>
            <td><label>所属地区：</label></td>
            <td><input type="number" name="area" min="0" max="3"/></td>
        </tr>
        <tr>
            <td><label>产品介绍：</label></td>
            <td><textarea name="introduction">可以拖动调大小</textarea></td>
        </tr>

    </table>
    <p>    <button type="submit"> 提交产品资料 </button>    </p>
</form>

<script>
    // $("label").css('text-align','right');
    // $("table td:nth-child(3n)  ").css('align','center');
</script>

</center>
</body>
</html>
