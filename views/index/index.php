<?php

use app\assets\index\IndexAsset;
IndexAsset::register($this);?>
<?php $this->beginBlock('css') ?>
    <style>.hd{display:none;}</style>
<?php $this->endBlock() ?>
<h1 class="text-center"><?= $data['id']??'' ?>列表<span class="tm">60</span></h1>
<div class="form-horizontal">
    <input type="hidden" data-tid="<?= $tid ?>" id="ids" value="<?= isset($data['id'])?$data['id']:0 ?>">

    <div class="form-group">
        <label for="inputTag" class="col-sm-2 control-label">标记</label>
        <div class="col-sm-8">
            <textarea id="inputTag" class="form-control " rows="3"><?= isset($data['tag'])?$data['tag']:'' ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="inputContent" class="col-sm-2 control-label">内容</label>
        <div class="col-sm-8">
            <textarea id="inputContent" class="form-control <?= isset($data['content'])&&!empty($data['content'])?'hd':'' ?>" rows="3"><?= isset($data['content'])?$data['content']:'' ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="inputConnect" class="col-sm-2 control-label">连接</label>
        <div class="col-sm-8">
            <textarea id="inputConnect" class="form-control <?= isset($data['connect'])&&!empty($data['connect'])?'hd':'' ?>" rows="3"><?= isset($data['connect'])?$data['connect']:'' ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default sumit-btn btn-lg">保存</button>
            <button type="submit" class="btn btn-default prev-btn btn-lg" data-id="<?= $tid ?>">上一个</button>
            <button type="submit" class="btn btn-default next-btn btn-lg" data-id="<?= $tid ?>">下一个</button>
            <button type="submit" class="btn btn-default pause btn-lg" data-id="<?= $tid ?>">暂停</button>
        </div>
    </div>
</div>

<?php $this->beginBlock('jsEnd') ?>
    <script>
        $('label').on('click',function () {
            var obj = $('#'+$(this).prop('for'));
            obj.toggleClass('hd')
            // if(obj.hasClass('hd')){
            //     obj.removeClass('hd');
            // }else{
            //     obj.addClass('hd');
            // }
        });
        $('label').on('mouseenter',function(){
            var obj = $('#'+$(this).prop('for'));
            obj.toggleClass('hd')
        })
        $('label').on('mouseleave',function(){
            var obj = $('#'+$(this).prop('for'));
            obj.toggleClass('hd')
        });
		$(window).on('keydown',function(e){
			var kcode = e.keyCode;
			if(!e.altKey){
				return;
			}
			if(kcode==190){
				$('.pause').trigger('click');
			}else if(kcode==188){
				$('.prev-btn').trigger('click');
			}else if(kcode==191){
				$('.next-btn').trigger('click');
			}else if(kcode==76){
				$('label[for=inputContent]').trigger('click');
				$('label[for=inputConnect]').trigger('click');
			}
		});
        <?php if ($g==1): ?>
            $(window).on('keydown',function(e){
            var kcode = e.keyCode;
            console.log(kcode)
            if(kcode==40){
                $('.pause').trigger('click');
            }else if(kcode==37){
                $('.prev-btn').trigger('click');
            }else if(kcode==39){
                $('.next-btn').trigger('click');
            }else if(kcode==38){
                $('label[for=inputContent]').trigger('click');
                $('label[for=inputConnect]').trigger('click');
            }
        });
        <?php endif ?>


        $('.sumit-btn').on('click',function () {
            var data = {};
            data['tag'] = $('#inputTag').val();
            data['id'] = $('#ids').val();
            data['content'] = $('#inputContent').val();
            data['connect'] = $('#inputConnect').val();
            data['_csrf'] = csrf;
            $.post('/api/input/index',data,function (d) {
                if(d.status==200){
                    window.location.reload(true);
                }else{
                    alert(d.info);
                }
            },'json');
        });

        $('.next-btn').on('click',function () {
            var tid = $(this).data('id');
            window.location.href = '?id=<?= $id ?>&g=<?= $g ?>&tid='+(parseInt(tid)+1)
        });

        $('.prev-btn').on('click',function () {
            var tid = parseInt($(this).data('id'));
            if(tid<1){
                tid = 1
            }
            window.location.href = '?id=<?= $id ?>&g=<?= $g ?>&tid='+(tid-1)
        });


        (function(){
            var jumpUrl = function(){
                var tid = parseInt($('#ids').data('tid'));
                if(tid==0){
                    return;
                }
                window.location.href = '?id=<?= $id ?>&g=<?= $g ?>&tid='+(tid+1)
            }

            var countdown=60;
            var td = undefined;

            $('.pause').on('click',function(){
                //console.log(td)
                if(typeof td =='undefined'){
                    $(this).text('暂停');
                    settime($('.tm'))
                }else{
                    $(this).text('继续');
                    clearTimeout(td);
                    td = undefined;
                }
            })

            function settime(obj) {
                if (countdown == 0) {
                    clearTimeout(td);
                    obj.text(countdown);
                    countdown = 60;
                    return;
                } else {
                    if(countdown==45){
                        jumpUrl();
                        return;
                    }

                    obj.text(countdown);
                    countdown--;
                }
                if(typeof td !='undefined'){
                    clearTimeout(td);
                }
                td = setTimeout(function() {
                    settime(obj)
                },1000)
            }

            settime($('.tm'))
        })()
    </script>
<?php $this->endBlock() ?>