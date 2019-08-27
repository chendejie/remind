<?php

use app\assets\input\IndexAsset;
IndexAsset::register($this);?>


<h1 class="text-center">录入/修改</h1>
<div class="form-horizontal">
    <input type="hidden" id="ids" value="<?= isset($data['id'])?$data['id']:0 ?>">


    <div class="form-group">
        <label for="inputTag" class="col-sm-2 control-label">标记</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputTag" value="<?= isset($data['tag'])?$data['tag']:'' ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputContent" class="col-sm-2 control-label">内容</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputContent" value="<?= isset($data['content'])?$data['content']:'' ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="inputConnect" class="col-sm-2 control-label">连接</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputConnect" value="<?= isset($data['connect'])?$data['connect']:'' ?>">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default sumit-btn">提交</button>
        </div>
    </div>
</div>

<?php $this->beginBlock('jsEnd') ?>
<script>
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
    })
</script>
<?php $this->endBlock() ?>