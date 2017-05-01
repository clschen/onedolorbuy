$(function  () {
        // 我的云购全球
        $(".header1 ul li.MyzhLi").hover(function(){
            $("http://www.ygqq.com/static/zt/red/js/packet/.header1 ul li.MyzhLi .Myzh").show();
            $(".MyzhLi a i").removeClass("top");
            $(".MyzhLi a i").addClass("bottom");
        },function(){
            $("http://www.ygqq.com/static/zt/red/js/packet/.header1 ul li.MyzhLi .Myzh").hide();
            $(".MyzhLi a i").removeClass("bottom");
            $(".MyzhLi a i").addClass("top");
        })
      

        // 搜索
        $(".search_header2 input").focus(function(){
            $(this).css({color:"#333"});
            var vals=$(this).val();
            if(vals=="搜索您需要的商品"){
                $(this).val("");
            }
            /* 2015 6 9  start*/
            // $(".search_span_a").hide();
          /* 2015 6 9  end*/
           
        })
         /* 2015 6 9  start*/
        $(".search_span_a a").click(function(){
            var htmls=$(this).html();
            $(".search_header2 input").val("");
            $(".search_header2 input").css({color:"#333"});
            $(".search_header2 input").val(htmls);
        })
         /* 2015 6 9  end*/
        $(".search_header2 input").blur(function(){
            var vals=$(this).val();
            if(vals==""){
                $(this).val("搜索您需要的商品");
                $(".search_span_a").show();
                $(this).css({color:"#a9a9a9"});
            }
        })
      
    })