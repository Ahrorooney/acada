<?php 

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
$this->beginPage()
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
  <?php $this->beginBody() ?>
    <?php echo $content ?>

    <!-- <footer>&copy; 2014 by My Company</footer> -->
    <?php $this->endBody() ?>
    

  </body>
</html>
<?php $this->endPage() ?>