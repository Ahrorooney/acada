<?php
use yii\widgets\ActiveForm;
?>
<div class="grid">
    <div class="left-img">
        <img src="<?= Yii::$app->request->baseUrl . '/img/left-img.png' ?>" alt="" srcset="">
    </div>
    <div class="form-ctn">
        <div class="login-title-block">
            <h1 class="login-title">Regisration</h1>
            <p class="login-slogan">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cupiditate quaerat, eos natus distinctio laudantium,</p>
        </div>
        <?php
        $form = ActiveForm::begin() ?>
            <label class="checked" for="name">
                Firstname
                <input placeholder="Vuasya" type="text" name="UserPersonalInfo[first_name]" id="name">
                <span> 
                    <img src="<?= Yii::$app->request->baseUrl . '/img/Check.svg' ?>" type="image/xml+svg"></img>
                </span>
            </label>
            <label class="wrong" for="lastname">
                Lastname
                <input placeholder="lastname" type="text" name="UserPersonalInfo[last_name]" id="lastname">
                <span> 
                    <img src="<?= Yii::$app->request->baseUrl . '/img/Close.svg' ?>" type="image/xml+svg"></img>
                </span>
            </label>
            <label class="checked" for="email">
                Email
                <input placeholder="example@mail.com" type="email" name="UserPersonalInfo[email]" id="e-mail">
                <span> 
                    <img src="<?= Yii::$app->request->baseUrl . '/img/Check.svg' ?>" type="image/xml+svg"></img>
                </span>
            </label>
            <label class="checked" for="phone">
                Phone
                <input placeholder="phone" type="tel" name="UserPersonalInfo[phone]" id="phone">
                <span> 
                    <img src="<?= Yii::$app->request->baseUrl . '/img/Check.svg' ?>" type="image/xml+svg"></img>
                </span>
            </label>
            <label class="checked" for="pass">
                Password
                <input placeholder="Password" type="password" name="User[password]" id="pass">
                <span> 
                    <img src="<?= Yii::$app->request->baseUrl . '/img/Close.svg' ?>" type="image/xml+svg"></img>
                </span>
            </label>
            <label class="checked" for="c-pass">
                Confirm password
                <input placeholder="Password" type="password" name="User[confirm_password]" id="c-pass">
                <span> 
                    <img src="<?= Yii::$app->request->baseUrl . '/img/Check.svg' ?>" type="image/xml+svg"></img>
                </span>
            </label>
            <div class="checkbox-custom">
                <input type="checkbox" value="None" id="licence" name="check" checked />
                <label for="licence"></label>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi illo explicabo eligendi quasi dolore adipisci minima alias</p>
            </div>
            <div class="checkbox-custom">
                <input type="checkbox" value="None" id="agreement" name="check" checked />
                <label for="agreement"></label>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi illo explicabo eligendi quasi dolore adipisci minima alias</p>
            </div> 
            <button type="submit" class="sign">
                Sign in
            </button>        
        <?php ActiveForm::end() ?>
    </div>
</div>