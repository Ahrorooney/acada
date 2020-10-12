<?php 

use app\assets\AppAsset;
use yii\helpers\Html;

$this->beginPage()
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl . '/css/reset.css' ?>" />
    <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl . '/css/login.css' ?>">
</head>
<body>
<?php $this->beginBody() ?>
    <?php echo $content ?>
    <?php $this->endBody() ?>
    
</body>
</html>
<?php $this->endPage() ?>