<?php foreach ($model as $field): ?>
    <div class="col-xs-12 col-md-4">
        <div class="panel panel-default" style="padding: 2px;">
            <div class="row">
                <div class="col-xs-4 col-md-4">
                    <?php if (file_exists(Yii::getAlias("@app/upload/capas/{$field->id_volume}.jpg"))): ?>
                        <div class="image-hover"><?=\yii\helpers\Html::img("@web/upload/capas/{$field->id_volume}.jpg", ['class' => 'image-padrao'])?></div>
                    <?php else: ?>
                        <div class="image-hover"><?=\yii\helpers\Html::img("@web/images/sem-imagem.jpg", ['class' => 'image-padrao'])?></div>
                    <?php endif; ?>
                </div>    
                <div class="col-xs-8 col-md-8">
                    <span><?=$field->titulo->nome_titulo?></span><br>
                    <span class="text-muted"><small><em><?=$field->titulo->nome_subtitulo?></em></small></span><br>
                    <hr>
                    <i class="fa fa-hashtag" aria-hidden="true"></i>&nbsp;<span><?=$field->numero?></span><br>
                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp;<span><?=sprintf('%02d/%04d', $field->data_mes, $field->data_ano)?></span>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
