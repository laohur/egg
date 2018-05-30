<!-- edit.blade.php
入口：
Route::get("/product/{product_id}/edit",'ProductController@edit');  //产品修改页面  http://localhost/product/1/edit

出口：
Route::patch("/product/{product_id}",'ProductController@update');  //提交修改产品  patch http://localhost/product/1

接口：
form action :  patch http://localhost/product/{product_id}
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
        var product=@json($product);
        var username=<?=$username  ?>;
        //php代码结束，此后是纯html、js、css
    </script>


</head>
<body>

<center>
<h1>淘理财</h1>
<h3>修改产品</h3>
<p><a href="/" target="_blank" >前台</a></p>
<p><a id="home" href="/home" target="_blank" >用户中心</a></p>
<p><a id="admin" href="/admin" target="_blank" >管理列表</a></p>



<script>
    $("#home").text('你好，'+username);
</script>

<form method="POST" action="{{url('/product/'.$product->product_id )}}">
    {{ csrf_field()  }}
    {{ method_field('PATCH')  }}
    <table>
        <tr>
            <td><label>属性：</label></td>
            <td><label>新值：</label></td>
            <td><label>旧值：</label></td>
        </tr>

        <!-- <tr>
            <td><label>产品名称：</label></td>
            <td><input type="text"   name="product_name" pattern=".{4,}" required title="最少四个字符" /></td>
            <td>{{$product->product_name}}</td>
        </tr> -->

        <tr>
            <td><label>发售银行：</label></td>
            <td><input type="text" name="bank" pattern=".{4,}" required title="最少四个字符" /></td>
            <td>{{$product->bank}}</td>
        </tr>

        <tr>
            <td><label>产品状态：</label></td>
            <td><input type="number" name="status" min="1" max="5"  /></td>
            <td>{{$product->status}}</td>
        </tr>

        <tr>
            <td><label>起投额：</label></td>
            <td><input type="number" name="min_amount"  min="1000"  /></td>
            <td>{{$product->min_amount}}</td>
        </tr>

        <tr>
            <td><label>在架否：</label></td>
            <td>
                <input type="radio" name="shelf" value="1" />在架
                <input type="radio" name="shelf" value="0" />不在架
            </td>
            <td>{{$product->shelf}}</td>

        </tr>

        <tr>
            <td><label>风险等级：</label></td>
            <td><input type="number" name="risk" min="0" max="6"/></td>
            <td>{{$product->risk}}</td>
        </tr>

        <tr>
            <td><label>推荐指数：</label></td>
            <td><input type="number" name="rank" /></td>
            <td>{{$product->rank}}</td>
        </tr>
        <tr>
            <td><label>产品周期（天）：</label></td>
            <td><input type="number" name="life" min="1" /></td>
            <td>{{$product->life}}</td>
        </tr>
        <tr>
            <td><label>产品开始日：</label></td>
            <td><input type="date" name="product_start" /></td>
            <td>{{$product->product_start}}</td>
        </tr>
        <tr>
            <td><label>产品终止日：</label></td>
            <td><input type="date" name="product_end" /></td>
            <td>{{$product->product_end}}</td>
        </tr>
        <tr>
            <td><label>预期最小收益率（万分之一）：</label></td>
            <td><input type="number" name="min_rate" min="1"   /></td>
            <td>{{$product->min_rate}}</td>
        </tr>
        <tr>
            <td><label>预期最大收益率（万分之一）：</label></td>
            <td><input type="number" name="max_rate" min="1"   /></td>
            <td>{{$product->max_rate}}</td>
        </tr>
        <tr>
            <td><label>所属地区：</label></td>
            <td><input type="number" name="area" min="0" max="3"/></td>
            <td>{{$product->area}}</td>
        </tr>
        <tr>
            <td><label>产品介绍：</label></td>
            <td><textarea name="introduction">可以拖动调大小</textarea></td>
            <td>{{$product->introduction}}</td>
        </tr>

    </table>
    <p>    <button type="submit" id="submit"> 更新产品资料 </button>    </p>
</form>

<script>
    $("form").click(function(){
        if(    $("input[name='product_start']").val() > $("input[name='product_end']").val()){
                alert("日期错误！");
                $("#submit").hide();
            }else{
                $("#submit").show();
            }
    })
</script>

</center>
</body>
</html>
