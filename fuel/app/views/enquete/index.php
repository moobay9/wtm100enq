
<h2>アンケート</h2>

<p class="lead">
    あなたが選ぶベストのライトニングトークを教えてください
</p>

<? if (isset($error)): ?>
    <div class="alert alert-danger">
        <h3 class="title"><i class="fa fa-exclamation-circle"></i>&nbsp;恐れ入りますが、以下の内容を再度ご確認ください。</h3>
        <ul>
            <li><?= implode('</li><li>', e((array) $error)); ?></li>
        </ul>
    </div>
<? endif; ?>

<?= Form::open(['action' => '', 'method' => 'post', 'class'=>'form-horizontal']); ?>

<div class="row">
    <div class="col-sm-10">
        <ul class="list-group">
        <? foreach ($enquetes as $key => $enq): ?>
        <? $lt_name = $enq['organization'].(($enq['organization'])?' ':'').$enq['name'].'さん'; ?>
            <li class="list-group-item <?= (Input::method() === 'POST' and $key == Input::post('best')) ? 'active': ''; ?>">
                <label>
                    <h4 class="list-group-item-heading"><?= $enq['title']; ?> <small>Group <?= $enq['group']; ?></small></h4>
                    <p class="list-group-item-text">
                        <?= Form::radio('best', (string)$key, Input::post('best', isset($enquete) ? $enquete->best : ''), ['class' => 'hide', 'id' => 'form_best'.$key]).'&nbsp;'.$lt_name; ?>
                    </p>
                </label>
            </li>
        <? endforeach; ?>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <span class="label label-danger">必須</span>
        <?= Form::label(__('common.name'), 'name', ['class'=>'control-label']); ?>
        <?= Form::input('name', Input::post('name', isset($enquete) ? $enquete->name : ''), ['class' => 'col-md-4 form-control', 'placeholder'=> '20文字以内　ニックネーム可']); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <?= Form::label(__('common.remarks'), 'remarks', ['class'=>'control-label']); ?>
        <?= Form::textarea('remarks', Input::post('remarks', isset($enquete) ? $enquete->remarks : ''), ['class' => 'col-md-4 form-control', 'rows' => 10, 'placeholder'=> '2000文字以内']); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?= Form::submit('submit', '送信', ['class' => 'btn btn-lg btn-block btn-primary']); ?>
        </div>
    </div>
</div>
<?= Form::close(); ?>

<script>
$(function(){
    $('.list-group-item').on('click', function(){
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
    });
});
</script>
