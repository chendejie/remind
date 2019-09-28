<?php

use app\assets\index\IndexAsset;
IndexAsset::register($this);?>
<?php $this->beginBlock('css') ?>
    <style>.hd{display:none;}</style>
<?php $this->endBlock() ?>

<div class="col-md-8 col-md-offset-2">
    <h1 class="text-center"><?= implode(',', array_column($data, 'id')) ?>列表<span class="tm">60</span></h1>
    <div class="form-horizontal form-data-div">
    <?php foreach ($data as $val): ?>
        <div class="single-data" data-id="<?= $val['id'] ?>">
            <div class="form-group">
                <label for="inputTag<?= $val['id'] ?>" class="col-sm-1 control-label">标记</label>
                <div class="col-sm-4">
                    <textarea id="inputTag<?= $val['id'] ?>" data-name="tag" class="form-control  data-input" rows="2"><?= isset($val['tag'])?$val['tag']:'' ?></textarea>
                </div>

                <label for="inputContent<?= $val['id'] ?>" class="col-sm-1 control-label content-divs">内容</label>
                <div class="col-sm-4 content-div">
                    <textarea id="inputContent<?= $val['id'] ?>" data-name="content" class="form-control data-input <?= isset($val['content'])&&!empty($val['content'])?'hd':'' ?>" rows="2"><?= isset($val['content'])?$val['content']:'' ?></textarea>
                </div>
                <!-- <div class="col-sm-5"></div> -->
            </div>
            <div class="form-group">
                
            </div>
        </div>
    <?php endforeach; ?>
    <div class="form-group">
        <label for="inputConnect" class="col-sm-1 control-label">连接</label>
        <div class="col-sm-9">
            <textarea id="inputConnect" class="form-control <?= isset($data[0]['connect'])&&!empty($data[0]['connect'])?'hd':'' ?>" rows="6"><?= isset($data[0]['connect'])?$data[0]['connect']:'' ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-10">
            <button type="submit" class="btn btn-default sumit-btn btn-lg">保存</button>
            <button type="submit" class="btn btn-default prev-btn btn-lg" data-id="<?= $tid ?>">上一个</button>
            <button type="submit" class="btn btn-default next-btn btn-lg" data-id="<?= $tid ?>">下一个</button>
            <button type="submit" class="btn btn-default pause-content btn-lg" data-id="<?= $tid ?>">展示/隐藏内容</button>
            <button type="submit" class="btn btn-default pause btn-lg" data-id="<?= $tid ?>">暂停</button>
        </div>
    </div>
</div>
</div>


<?php $this->beginBlock('jsEnd') ?>
    <script>
        $('.pause-content').on('click',function(){
            $('.single-data').find('.content-div').each(function(){
                $(this).parents('.form-group').find('.content-divs').trigger('click');
            });
        })

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
        })

        $('.sumit-btn').on('click',function () {
            var dd = []
            $('.form-data-div').find('.single-data').each(function(){
                var t ={};
                t['id'] = $(this).data('id');
                $(this).find('.data-input').each(function(){
                    t[$(this).data('name')] = $(this).val()
                });
                t['connect'] = $('#inputConnect').val()
                dd.push(t)
            });

            var data = {};
            data['data'] = dd;
            data['_csrf'] = csrf;
            $.post('/api/input/index-mul',data,function (d) {
                if(d.status==200){
                    window.location.reload(true);
                }else{
                    alert(d.info);
                }
            },'json');
        });

        $('.next-btn').on('click',function () {
            var tid = $(this).data('id');
            window.location.href = '?id=<?= $id ?>&tid='+(parseInt(tid)+1)
        });

        $('.prev-btn').on('click',function () {
            var tid = parseInt($(this).data('id'));
            if(tid<1){
                tid = 1
            }
            window.location.href = '?id=<?= $id ?>&tid='+(tid-1)
        });


        (function(){
            var jumpUrl = function(){
                var tid = parseInt($('.next-btn').data('id'));
                if(tid==0){
                    return;
                }
                window.location.href = '?id=<?= $id ?>&tid='+(tid+1)
            }

            var countdown=60;
            var td = undefined;

            $('.pause').on('click',function(){
                console.log(td)
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