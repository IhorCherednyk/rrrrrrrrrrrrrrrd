<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Menu;

AppAsset::register($this);
?>
<footer id="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4 class="nk-widget-title"><span class="text-main-1">Наши</span> Контакты</h4>
                <form action="php/contact.php" class="nk-form nk-form-ajax" novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="email" class="form-control input-contact" name="email" placeholder="Email *" aria-required="true">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control input-contact" name="name" placeholder="Имя *" aria-required="true">
                        </div>
                    </div>
                    <textarea class="form-control text-area-contact" name="message" rows="5" placeholder="Сообщение *" aria-required="true"></textarea>
                    <button class="btn btn-rounded btn-color-white mt20 ">
                        <span>Отправить</span>
                        <span class="icon"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></span>
                    </button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="nk-widget">
                    <h4 class="nk-widget-title"><span class="text-main-1">Последние </span>новости</h4>
                    <div class="nk-widget-content">
                        <div class="row vertical-gap sm-gap">

                            <div class="col-lg-6">
                                <div class="footer-news">
                                    <a href="#" class="news-link">
                                        <span class="nk-post-image">
                                            <img src="/img/site/post-1-sm.jpg" alt="">
                                        </span>

                                        <div class="footer-news-wrapper">
                                            <p>Smell magic in the air. Or maybe barbecue</p>
                                            <span class="fa fa-calendar"></span>
                                            <span class="calendar-date">
                                                Sep 18, 2016
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="footer-news">
                                    <a href="#" class="news-link">
                                        <span class="nk-post-image">
                                            <img src="/img/site/post-1-sm.jpg" alt="">
                                        </span>

                                        <div class="footer-news-wrapper">
                                            <p>Smell magic in the air. Or maybe barbecue</p>
                                            <span class="fa fa-calendar"></span>
                                            <span class="calendar-date">
                                                Sep 18, 2016
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="footer-news">
                                    <a href="#" class="news-link">
                                        <span class="nk-post-image">
                                            <img src="/img/site/post-1-sm.jpg" alt="">
                                        </span>

                                        <div class="footer-news-wrapper">
                                            <p>Smell magic in the air. Or maybe barbecue</p>
                                            <span class="fa fa-calendar"></span>
                                            <span class="calendar-date">
                                                Sep 18, 2016
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="footer-news">
                                    <a href="#" class="news-link">
                                        <span class="nk-post-image">
                                            <img src="/img/site/post-1-sm.jpg" alt="">
                                        </span>

                                        <div class="footer-news-wrapper">
                                            <p>Smell magic in the air. Or maybe barbecue</p>
                                            <span class="fa fa-calendar"></span>
                                            <span class="calendar-date">
                                                Sep 18, 2016
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="copyright">
            Copyright © 2017 | Code <a href="https://themeforest.net/user/_nk?ref=_nK" target="_blank">nK</a>, design <a href="https://themeforest.net/user/syatweb?ref=_nK" target="_blank">SYATWEB</a>
            <p>18+ Dota-prognoz не организует игры на деньги. Контент носит информационный характер. © 2012-2017 Dota-prognoz.ru</p>
        </div>
    </div>

</footer>
<?php $this->registerJs("
        
    $(document).ready(function() {
    
        $('#refresh').on('click', function(e){
            e.preventDefault();
            submitAssign();
        });
        function submitAssign() {
            $.ajax({
                type: 'POST',
                url: '/user/user/refresh-coins',
                success: function (response) {
                    $('#coins').text(response);
                },
                error: function (response) {
                    console.log('error');
                }
            });
        }
    });

            

", \yii\web\View::POS_END);
?>

    
