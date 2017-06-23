<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WebTouchMeeting #100 アンケート</title>
    <?= Asset::css([
        'bootstrap.css',
        'font-awesome.css',
        'style.css'
    ]); ?>

    <?= Asset::js([
        '//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js',
        'bootstrap.js',
    ]); ?>
    <script>
        $(function(){
            $('.topbar').dropdown();
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
<?php if (Session::get_flash('success')): ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>
                    <?= implode('</p><p>', (array) Session::get_flash('success')); ?>
                    </p>
                </div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>
                    <?= implode('</p><p>', (array) Session::get_flash('error')); ?>
                    </p>
                </div>
<?php endif; ?>
            </div>
            <div class="col-md-12">
<?= $content; ?>
            </div>
        </div>
        <hr/>
        <footer>
            <p class="pull-right"><?= __('common.copyright'); ?></p>
        </footer>
    </div>
</body>
</html>
