<!-- index.blade.php

展示产品列表
获得js变量products
入口
http://localhost
http://localhost/product

出口：
http://localhost/product/1

接口：
http://localhost/search/银行  返回搜索“银行”结果json

-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>淘理财产品列表</title>
    {{--<link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <style>
        td{
            text-align:center
        }
    </style>
    <script type="text/javascript"  src="{{ URL::asset('/js/mapping.js')  }}" >
        //此处加载/public/js/*.js静态文件
    </script>
    <script type="text/javascript"  src="{{ URL::asset('/js/jquery-3.3.1.min.js')  }}" ></script>

    <script type="text/javascript">
            products=@json($products);

            // for(var i=0; i<products.length;i++){
            //     var rate=parseFloat(products[i]['min_rate']+products[i]['max_rate'])/200;
            //     products[i].push(['rate',rate]);

            // }
            //php代码结束，此后是纯html、js、css
    </script>


</head>
<body>
<center>
<h1>淘理财</h1>
<h3>产品列表</h3>
{{--<a href="/home" target="_blank">用户中心</a>--}}
<p></p>
    <label>搜索：</label>
    <input id="keyword" type="text"/>
    <lable id="tip"></lable>
</p>


<div id="lists">
    <table id="list_table">
        <tr id="head_row">
            <td id="product_name">产品名称</td>
            <td id="rate">收益率</td>
            <td id="life">投资期限</td>
            <td id="risk">风险等级</td>
            <td id="bank">发售银行</td>
            <td id="area">发售区域</td>
        </tr>
        {{--助记样例--}}
        <tr class="data_row">
            <a id="href" href="/product/"+1  target="_blank"><td class="product_name"></td></a>
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
    // lists(products);
    // function lists(products){
    //     for(var i=0; i<products.length;i++){
    //         var product=products[i];
    //         var href='"/product/'+product['product_id']+'"';
    //         var product_link='<a href='+href+'target="_blank">'+product['product_name']+'</a>';
    //         var product_name='<td class="product_name">'+product_link+'</td>';
    //         var rate=parseFloat(products[i]['min_rate']+products[i]['max_rate'])/200;

    //         // product.push('rate',rate);                    
    //         // product['rate'=products[i]['rate'];

    //         var rate='<td class="rate">'+rate.toFixed(2)+'%</td>';
    //         var life='<td class="life">'+product['life']+'天</td>';
    //         var risk='<td class="risk">'+risks[product['risk']]+'</td>';
    //         var bank='<td class="bank">'+product['bank']+'</td>';
    //         var area='<td class="area">'+areas[product['area']]+'</td>';
    //         var tr='<tr class="data_row">'+product_name+rate+life+risk+bank+area+'</tr><br/>'+'\n';
    //         // console.log(tr);

    //         $('#list_table').append(tr);
    //     }
    // }

    function list(product){
        // var product=products[i];
       // console.log(product);
        var href='"/product/'+product['product_id']+'"';
        var product_link='<a href='+href+'target="_blank">'+product['product_name']+'</a>';
        var product_name='<td class="product_name">'+product_link+'</td>';
        var rate=parseFloat(product['min_rate']+product['max_rate'])/200;

        // product.push('rate',rate);                    
        // product['rate'=products[i]['rate'];

        var rate='<td class="rate">'+rate.toFixed(2)+'%</td>';
        var life='<td class="life">'+product['life']+'天</td>';
        var risk='<td class="risk">'+risks[product['risk']]+'</td>';
        var bank='<td class="bank">'+product['bank']+'</td>';
        var area='<td class="area">'+areas[product['area']]+'</td>';
        var tr='<tr class="data_row">'+product_name+rate+life+risk+bank+area+'</tr><br/>'+'\n';
        // console.log(tr);

        $('#list_table').append(tr);       
    }

    for(var i=0; i<products.length;i++){
        list(products[i]);
    }
</script>

<script>
    $(document).ready(function(){
        $('#comment').on('input propertychange', function() {
            var count = $(this).val().length;
            $('#tip').html("已输入 "+ count +" 个字。");
        });
    });
</script>

<script>
    "use strict";
    // search  get "http://localhost/search/银行" 返回的json动态排列结果
    //监听input中keyword变化
    search();
    function search(){
        $("#keyword").on('input propertychange',function(){

            var keyword=$(this).val();
            console.log(keyword);
            if(!keyword || keyword.length<1){
                console.log("empty keyword");
                return ;
            }
            getProducts(keyword);

        })
    }
    //重构列表
    function  change(products) {
       if(!products || products.length<1){
           console.log("empty products");
           return ;
       }
       $(".data_row").remove();
       //lists(products);
       for(var i=0; i<products.length; i++){
           list(products[i]);
           console.log(products[i]);
       }
   }

    // 获取搜索结构 http://localhost/search/银行
    function getProducts(keyword){
            //console.log('p1:'+products);
        $.ajax({
            type:'GET',
            url:'/search/'+keyword,
            data:'_token=<?php echo csrf_token() ?>',
            success:function(data){
                products=data;
                //console.log('/search/'+keyword);
                //console.log('ajax:'+products);
                change(products);
                // return products ;
                $("#tip").text("已输入"+keyword.length+"字，发现"+products.length+"款产品");

            }
        });
        return products ;
    }

    var riskRound=0
    $("#risk").click(function(){
        //console.log(products);
        riskRound=riskRound%risks.length;
        $(".data_row").remove();
        for(var i=0; i<products.length; i++){
            if(riskRound==products[i]['risk']){
                list(products[i]);
                console.log(products[i]['risk']);
            }
        }
        $("#tip").text("您筛选的风险等级为"+risks[riskRound]+"的产品如下");
        riskRound+=1;
    })

    var areaRound=0
    $("#area").click(function(){
        //console.log(products);
        areaRound=areaRound%risks.length;
        $(".data_row").remove();
        for(var i=0; i<products.length; i++){
            if(areaRound==products[i]['area']){
                list(products[i]);
                console.log(products[i]['area']);
            }
        }
        $("#tip").text("您筛选的区域为"+areas[areaRound]+"的产品如下");
        areaRound+=1;
    })

    function compare(condition){     
        if("rateDesc"==condition){
            return function(a,b){
                var rate1=a['min_rate']+a['max_rate'];
                var rate2=b['min_rate']+b['max_rate'];
                return rate2-rate1;
            }
        }
        if("lifeAsc"==condition){
            return function(a,b){
                var life1=a['life'];
                var life2=b['life'];
                return life1-life2;
            }
        }
    }

    $("#rate").click(function(){
        //console.log(products);
        products=products.sort(compare('rateDesc'));
        console.log(products);
        $(".data_row").remove();
        for(var i=0; i<products.length; i++){
            list(products[i]);
        }
        $("#tip").text("产品收益降序排列如下");
    })

    $("#life").click(function(){
        //console.log(products);
        products=products.sort(compare('lifeAsc'));
        $(".data_row").remove();
        for(var i=0; i<products.length; i++){
                list(products[i]);
        }
        $("#tip").text("产品周期升序排列如下");
    })        
    // $("td").css('text-align','center');

    // $("td").change(function(){
    //     $("td").css('text-align','center');

    // })
    //排序
    // var areaRound=0;
    // $("#area").click(function(){
    //     areaRound=(areaRound)%areas.length+1;
    //     console.log(areaRound);
    //     $("#area").text("区域="+areas[areaRound]);
    //     $(".data_row").remove();
    //     for(var i=0; i<products.length; i++){
    //         if(areaRound==products[i]['area']){
    //             lists(products[i]);
    //         }
    //     }
    // })

</script>
</center>
</body>
</html>

