<!-- show.blade.php
获得js变量product
展示单个产品
入口：
http://localhost/product/1

-->
<?php
    $areas=array("浙江省","四川省","甘肃省","湖北省");
    $statuses=array("存续中","封闭期","过期","募集期","开放期","在售");
    $shelfes=array("是","否"); 
    $risks=array("高","中高","中","中低","低","较低","极低");
    $rate=round(($product->min_rate+$product->max_rate)/200,2);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>淘理财产品详情</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    {{--<link rel="stylesheet" href="//cdn.amazeui.org/amazeui/2.7.2/css/amazeui.min.css">--}}
    {{--<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
    {{--<link rel="stylesheet" href="//cdn.bootcss.com/zui/1.8.1/css/zui.min.css">--}}
    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">--}}
    <script type="text/javascript"  src="{{ URL::asset('/js/mapping.js')  }}" >
        //此处加载/public/js/*.js静态文件
    </script>
    <script type="text/javascript"  src="{{ URL::asset('/js/jquery-3.3.1.min.js')  }}" ></script>

    <script>
        var product=@json($product);
        var rate=@json($rate);
    </script>

</head>
<body>

<center>
<h1>淘理财</h1>
<h3>产品详情</h3>
{{--<a href="/home" target="_blank" >用户中心</a><p></p>--}}
<p><a href="/" target="_blank" >首页</a></p>


<p><a href="/" target="_blank" >☛现在购买⇨</a></p>
<p></p>
<div id="list">
<form>
<p></p>
    <input type="range" id="input"  min=1000 max=10000 step=1000 value=10000  /><br>
    <label>投资金额：</label>      <label id="amount"></label>  <br>
    <label>预期收益：</label>       <label id="yield"> </label>
</p>    
</from>



<table>
        <tr>
            <td><label> </label>    </td>
            <td><label> </label></td>
        </tr> 

        <tr>
            <td><label>产品名称：</label></td>
            <td>{{$product->product_name}}</td>
        </tr>

        <tr>
            <td><label>发售银行：</label></td>
            <td>{{$product->bank}}</td>
        </tr>

        <tr>
            <td><label>产品状态：</label></td>
            <td>{{ $statuses[$product->status] }}</td>
        </tr>

        <tr>
            <td><label>起投额：</label></td>
            <td>{{$product->min_amount}}</td>
        </tr>

        <!-- <tr>
            <td><label>在架否：</label></td>
            <td>{{ $shelfes[$product->shelf] }}</td>
        </tr> -->

        <tr>
            <td><label>风险等级：</label></td>
            <td>{{ $risks[$product->risk] }}</td>
        </tr>

        <tr>
            <td><label>推荐指数：</label></td>
            <td>{{$product->rank}}</td>
        </tr>
        <tr>
            <td><label>产品周期（天）：</label></td>
            <td>{{$product->life}}</td>
        </tr>
        <tr>
            <td><label>产品开始日：</label></td>
            <td>{{$product->product_start}}</td>
        </tr>
        <tr>
            <td><label>产品终止日：</label></td>
            <td>{{$product->product_end}}</td>
        </tr>
        <tr>
            <td><label>预期收益率：</label></td>
            <td>{{  $rate.'%'   }}</td>
        </tr>
        <tr>
            <td><label>所属地区：</label></td>
            <td>{{ $areas[$product->area] }}</td>
        </tr>
        <tr>
            <td><label>产品介绍：</label></td>
            <td>{{$product->introduction}}</td>
        </tr>

    </table>

</div>

<script type="text/javascript">
    $("td").css('text-align','center');
    $("#input").change(function(){
        amount=this.value;
        $("#amount").text(amount+'元');
        // yield=(amount*rate/100).toFixed(2);
        yield=(amount*rate/100);
        $("#yield").text(yield+"元");
    })
</script>


</center>
</body>
</html>









