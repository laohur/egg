<!-- show.blade.php
获得js变量product
展示单个产品
入口：
http://localhost/product/1

-->
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
    </script>

</head>
<body>

<center>
<h1>淘理财</h1>
<h3>产品详情</h3>
{{--<a href="/home" target="_blank" >用户中心</a><p></p>--}}
<a href="/" target="_blank" >首页</a>

<div id="list">
    <table id="list_table">
        <tr id="head_row">
            <td id="product_name">产品名称</td>
            <td id="rate">收益率</td>
            <td id="life">投资期限</td>
            <td id="risk">风险等级</td>
            <td id="bank">发售银行</td>
        </tr>
        {{--助记样例--}}
        <tr class="data_row">
            <a id="href" href="http://localhost/product/"+1 ><td class="product_name"></td></a>
            <td class="rate"></td>
            <td class="life"></td>
            <td clas="risk"></td>
            <td class="bank"></td>
        </tr>
    </table>

</div>

<script type="text/javascript">

    //index 根据products生成页面
    // alert(products[5]['bank']);
    list(product);

    function list(product){
            // var href='"http://localhost/product/'+product['product_id']+'"';
            // var a='<a href='+href+'>'+product['product_name']+'</a>';
            var product_name='<p><td class="product_name">'+product['product_name']+'</td>';

            var rate=parseFloat(product['min_rate']+product['max_rate'])/200;
            var rate='<p><td class="rate">'+rate.toFixed(2)+'%</td></p>';
            var life='<p><td class="life">'+product['life']+'天</td></p>';
            var risk='<p><td class="risk">'+risks[product['risk']]+'</td></p>';
            var bank='<p><td class="bank">'+product['bank']+'</td></p>';
            var tr='<tr class="data_row">'+product_name+rate+life+risk+bank+'</tr></p>';
            console.log(tr);

            $('#list_table').append(tr);
    }
</script>
</center>
</body>
</html>









