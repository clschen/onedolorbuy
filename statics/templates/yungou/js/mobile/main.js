function startTime(obj) {
  var $el = obj;
  var date_now = (new Date).valueOf();
  var on_scroll = false;
  var scroll_end_handler = _.debounce(function(){ on_scroll = false}, 50);
  $(window).on('scroll', function(){on_scroll = true; scroll_end_handler();});
  countdown.resetLabels();
  countdown.setLabels(' |秒|分||||||||', ' |秒|分||||||||', '', '');
  var units =  countdown.MILLISECONDS | countdown.SECONDS | countdown.MINUTES;
  var timer = countdown(function(ts){

    if (on_scroll)
      return;
    if (ts.value <= 0){
      clearInterval(timer);
      $el.text($el.data('text'));

      setTimeout(function(){
        var func = eval( '(' + $el.data('callback') + ')' );
        if (func)
          func.apply($el);
      }, parseInt($el.data('delay')) || 0 );

      return;
    }

    $el.text(ts.toString());
  }, date_now + parseInt($el.data('sec')) * 1000 , units);
}

function startSwiper() {
  if( $('.swiper-container').length ) {
    var swiper = new Swiper('.swiper-container', {
      pagination: '.swiper-pagination',
      paginationClickable: true,
      speed: 1000,
      autoplay: 3500,
    });
  }
}
(function(){
  /*if( $('.swiper-container').length ) {
    var swiper = new Swiper('.swiper-container', {
      pagination: '.swiper-pagination',
      paginationClickable: true,
      speed: 1000,
      autoplay: 3500,
    });
  }*/

  if( $('.db-main-index').length )
    {
      //        require(['index'], function(){});
    }

    //单选按钮
    if( $('.radio-box').length )
      {
        $('.radio-box').click(function(){
          $('.radio-box').removeClass('active');
          $(this).addClass('active');
        });
      }

      //价格只能输入数字
      if( $('.number').length )
        {
          $('.number').keyup(function(){
            var value = $(this).val();
            value = value.replace(/[^\d]/g,'');
            if( value <= 0 ) {
              value = '';
            }
            $('.number').val(value);
            $(this).val(value);
          });
        }

        //选择价格
        if( $('.prices').length ){

          $('.prices a').click(function(){
            $('.prices a').removeClass('active');
            $(this).addClass('active');

            $('#price_user_input').val('');
            $('#price').val($(this).attr('value'));
          });


          $('#price_user_input').on('input', _.debounce(function(){
            $('.prices a').removeClass('active');
            $('#price').val($(this).val());
          }, 100));

          $('.prices a.active').click();

        }


        //返回顶部
        if( $('#totop').length )
          {
            $('#totop').click(function () {
              $('#fw_main').animate({scrollTop: 0}, 500);
              return false;
            });
          }

          //模态窗口
          if( $('.modal').length ) {
            $('.modal .close').click(function(){
              $('.modal').hide();
            });
            $('.open-modal').click(function(){
              $('.modal').show();
            });
          }

          //注册
          if( $('.db-main-register').length ) {
            ;(function(){

              var sendSms = function sendSms(callback){

                var phone = $('input[name="phone"]').val();
                if ( phone < 10000000000 || phone > 20000000000){
                  alert('号码不符合规则');
                  return;
                }

                $.get('/user/send_register_sms', {phone: $('input[name="phone"]').val()}, function(data){
                  callback(JSON.parse(data));
                });
              };

              var register = function register(callback){
                var password  = $('input[name="password"]').val();
                if (password.length < 6 || password.length > 20){
                  alert('请设置6~20位登录密码');
                  return;
                }

                var post_data = {
                  phone : $('input[name="phone"]').val(),
                  password : $('input[name="password"]').val(),
                  sms_captcha : $('input[name="smscode"]').val(),
                };


                $.post('/user/register', post_data, function(data){
                  callback(JSON.parse(data));
                });
              };

              var countDown = function countDown(callback){

                var time = 300;
                $('#get_smscode').off('click');
                $('#count_down').text('(' + time + ')').show();

                var timer = setInterval(function(){
                  if (time <= 0){
                    clearInterval(timer);
                    $('#count_down').hide();
                    $('#get_smscode').on('click', function(){

                      sendSms(function(data){
                        if( data.code === 0 ){
                          countDown();
                          return;
                        }
                        else if(data.code === 5){
                          alert('太频繁了');
                        }
                        else{

                        }
                      });

                    });
                  }

                  time = time - 1;
                  $('#count_down').text('(' + time + ')');
                },1000);
              };

              $('#step1').click(function(){

                sendSms(function(data){
                  if( data.code === 0 || data.code === 5){
                    $('.step1').hide();
                    $('.step2').show();
                    $('#nav_title').text('填写验证码');
                    countDown();
                    return;
                  }
                  else{
                    alert('手机号填写错误');
                  }
                });

              });

              $('#step2').click(function(){

                var smscode = $('input[name="smscode"]').val();

                if ( !/\d{6}/.test(smscode) ){
                  alert('验证码6位');
                  return;
                }

                $('.step2').hide();
                $('.step3').show();
                $('#nav_title').text('设置登录密码');
              });

              $('#step3').click(function(){
                register(function(data){

                  if(data.code === 0){
                    alert('注册成功');
                    location.href = '/user/?from=register';
                    return;
                  }
                  else if(data.code === 3){
                    alert('验证码填写错误');
                    $('.step3').hide();
                    $('.step2').show();
                    $('#nav_title').text('填写验证码');
                  }
                  else {
                    alert(data.msg);
                    $('.step3').hide();
                    $('.step2').show();
                    $('#nav_title').text('填写验证码');
                  }
                });
              });

            })();
          }

          if( $('.db-main-forgetpass').length) {
            //require(['forgetpass']);
            (function(){

              $('#get_smscode').on('click', function(){
                $.get('/user/send_resetpwd_sms', { phone: $('input[name=phone]').val() }, function(data){
                  data = JSON.parse(data);

                  if(data.code === 0){
                    alert('短信已发出，请稍候');
                  }
                  else if(data.code === 5){
                    alert('短信发送太频繁，请稍候再试');
                  }
                  else {
                    alert('手机号码错误');
                  }


                });
              });

            })();
          }

          if( $('.db-main-cart,.db-main-order').length ) {
            //require(['order']);
            (function(){
              $('.subtract').click(function(){
                var $input = $(this).parents('.rq').find('input[name=number]');
                var price_tag = parseInt($input.data('price_tag'));
                var number = parseInt($input.val());
                if( number<=price_tag ) {
                  alert('亲，数量至少为' + price_tag + '哦~');
                } else {
                  $input.val(number-price_tag);
                }
                $('input[name=number]').trigger('change');
              });

              $('.plus').click(function(){
                var $input = $(this).parents('.rq').find('input[name=number]');
                var price_tag = parseInt($input.data('price_tag'));
                var number = parseInt($input.val());

                if( number>=1000 ) {
                  alert('已达到单笔交易最大金额！');
                } else {
                  $input.val(number+price_tag);
                }
                $('input[name=number]').trigger('change');
              });

              $('input[name=number]').change(function(){
                var $this = $(this);
                var number = parseInt($this.val());

                if(number<0 || isNaN(number)) {
                  $this.val(1);
                }
                else if(number> __data__.count_else){
                  $this.val(__data__.count_else);
                }

                if (number > __user__.balance){

                  if ( $("[value=buy_by_weixinpay] .radio-box.active").length == 0 ){
                    Simpop({
                      content: '抢币不足，请用微信支付',
                      time: 1000
                    }).show();
                    $('[value=buy_by_weixinpay]').click().trigger('touchend');
                  }

                }

                $this.val($this.val().replace(/[^\d]/g, ''));
                $('.form_count').val($(this).val());

                //$('#probability').text( ($(this).val() / __data__.price * 100).toString().substr(0,4) + '%' );
              });

              var choosePayment = function(e){

                var $this = $(this);
                if ($this.find('a')[0] === e.target){
                  $('form').removeClass('active');
                  $('#' + $this.attr('value')).addClass('active');
                }
                else{
                  $this.find('a').trigger('click').trigger('touchend');
                }

              };

              if ('ontouchend' in document)
                $('.ul.pay li').on('touchend',choosePayment);
              else
                $('.ul.pay li').on('click',choosePayment);


              $('#buy_submit').on('click', function(){
                if (confirm('确认购买？')){
                  $('form.active').submit();
                }
              });

              $('input[name=number]').trigger('change');
              $('.active').click().trigger('touchend');

            })();
          }

          // 倒计时
          if( $('.countdown').length ){

            //require(['countdown'], function(countdown){
            var $els = $('.countdown');
            var date_now = (new Date).valueOf();

            var on_scroll = false;
            var scroll_end_handler = _.debounce(function(){ on_scroll = false}, 50);
            $(window).on('scroll', function(){on_scroll = true; scroll_end_handler();});

            countdown.resetLabels();
            countdown.setLabels(' |秒|分||||||||', ' |秒|分||||||||', '', '');
            var units =  countdown.MILLISECONDS | countdown.SECONDS | countdown.MINUTES;

            $els.each(function(){

              var $el = $(this);
              var timer = countdown(function(ts){

                if (on_scroll)
                  return;

                if (ts.value <= 0){
                  clearInterval(timer);
                  $el.text($el.data('text'));

                  setTimeout(function(){
                    var func = eval( '(' + $el.data('callback') + ')' );
                    if (func)
                      func.apply($el);
                  }, parseInt($el.data('delay')) || 0 );

                  return;
                }

                $el.text(ts.toString());
              }, date_now + parseInt($el.data('sec')) * 1000 , units);

            });

            //});
          }

          //require(['pulldown']);
          (function(){

            var lock = false;
            var $document = $(document);
            var $window = $(window);

            var is_on_bottom = function(offset){
              return $document.scrollTop() + $window.height() + (offset||50) >= $document.height() && !lock ;
            };
            
            $('.pulldown_list').each(function() {
              var $this = $(this);
              var loading_div = $('<div style="text-align:center; color:#868686; background-color:#f0f0f0; font-size:1.1rem; padding:0.5rem 0 0.5rem 0;" id="pulldown_loading">上拉加载更多</div>');
              $this.parent().append(loading_div);
            });

            $window.on('scroll', _.debounce(function(){

              if ( is_on_bottom(1000) ) {
                lock = true;

                $('.pulldown_list.active').each(function(){

                  var $this = $(this);
                  var url = $this.data('url') || '?list_only=1';
                  var callback = $this.data('callback');
                  //var filter = $this.data('filter');
                  var page_no = parseInt($this.data('page_no')) || 2;
                  var timeout = parseInt($this.data('timeout')) || 10000;

                  var loading_div = $('<div style="margin: 0.2rem auto">正在加载...</div>');
                  var loading_error_div = $('<div style="text-align:center;">加载失败，点击刷新</div>');
                  loading_error_div.on('click',function(){
                    loading_error_div.remove();
                    $window.trigger('scroll');
                  });


                  $this.parent().find('#pulldown_loading').html(loading_div);
                  var success_callback = function(data){

                    loading_div.remove();

                    $el = $(data);

                    if (!$el.length){
                      $this.removeClass('active');
                      $this.parent().find('#pulldown_loading').html('<div style="text-align:center;">已没有更多</div>');
                      return;
                    } else {
                      $this.parent().find('#pulldown_loading').html('上拉加载更多');
                    }

                    $this.append($el);
                    eval(callback);
                    $this.data('page_no', page_no + 1);
                    $window.trigger('scroll');
                  };

                  var error_callback = function(){
                    $window.trigger('scroll');
                  };

                  var unlock = function(){
                    loading_div.remove();
                    lock = false;
                  };

                  var xhr = $.get(url, {page_no: page_no})
                  .done(success_callback)
                  .fail(error_callback)
                  .always(unlock);

                  setTimeout(function(){
                    xhr.abort();
                  }, timeout);

                });


              }

            }, 100));

            $('.pulldown_list').addClass('active');
            $window.trigger('scroll');

          })();



          $('body').on('click', '.click_for_nums', function(){

            var prize_id = $(this).data('prize_id');
            var lottery_luck_num = $(this).data('luck_num');
            var modal_head = '第' + $(this).data('prize_peroid') + '期&nbsp;&nbsp;' + $(this).data('prize_title');
            // 添加弹出框标题头
            $('#window_luck_num .modal-header').html(modal_head);

            var url = '/user/luck_nums/' + prize_id.toString();

            if ( !!$(this).data('user_id') ){
              url = url + "?user_id=" + $(this).data('user_id');
            }

            $.get(url , function(data){

              /*var content = '<div style="max-height: 300px; overflow: auto">' 
              + JSON.parse(data).join('<br />')
              + '</div>';*/

              /*Simpop({
                content: content,
              }).show();*/
              var decode_data = JSON.parse(data);
              var data_length = decode_data.length;
              $('#window_luck_num').css('margin-top', $(window).height() / 2 - 180);

              // 判断总行数
              row_length = data_length/3;
              tmp_str = row_length.toString();
              if (tmp_str.indexOf('.') != -1 && row_length != 0) {
                row_length = parseInt(tmp_str.substring(0, tmp_str.indexOf('.'))) + 1;
              }
              // 添加内容
              var content = '<div style="margin-bottom:5px;">参与' + data_length + '次，云购号码：</div>'
              content += '<div style="max-height:150px; overflow:auto;">';
              for (var i=0; i<row_length; i++) {
                for (var j=0; j<3; j++) {
                  var tmp_data = decode_data[i*3+j];
                  if (typeof(tmp_data) == 'undefined') {
                    content += '</div>';
                    break;
                  }
                  if (j == 0) {
                    content += '<div>';
                  }
                  if (typeof(lottery_luck_num) != 'undefined' && lottery_luck_num == tmp_data) {
                    content += '<label style="text-align:center; display:inline-block; width:33.3%; color:red">' + tmp_data + '</label>';
                  } else {
                    content += '<label style="text-align:center; display:inline-block; width:33.3%">' + tmp_data + '</label>';
                  }
                  if (j == 2) {
                    content += '</div>';
                  }
                }
              }
              content += '</div>'
              $('#window_luck_num .modal-body').html(content);
              $('#window_luck_num').modal({
                show: true,
                backdrop: 'static',
              });
              /*$(document).bind(touchEvents.touchmove, function(event) {
                alert('abc');
                event.preventDefault();
                event.stopPropagation();
              });*/
            });
            /*$('#window_luck_num .btn').click(function() {
              $(document).bind(touchEvents.touchmove, function(event) {
                alert('end');
                event.preventDefault();
              });
            });*/
          });

          var event = (function(){
              return 'click';
            if ('ontouchend' in document)
              return 'touchend';
            else
              return 'click';
          })();

          $('body').on(event, '[data-href]', function(){
            var url = $(this).data('href');

            setTimeout(function(){
              location.href = url;
            }, 100)
          });

          $('body').on(__touchorclick__, '[data-role=praise]',function(){
            var $this = $(this);
            var display_id = $this.data('display_id');

            if (!!Cookies.get('ped'+display_id)) {
              setTimeout(function(){
                Simpop({
                  content: '您已赞过',
                  timeout: 1000
                }).show();
              }, 300);
              return;
            }

            $.get('/share/praise/' + display_id);
            var $el = $this.find('[data-role=praise_number]');
            $el.html((parseInt($el.html()) + 1).toString());
            Cookies.set('ped'+display_id, '1',{expires: 24 * 365});
          });

})();

