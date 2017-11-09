<?php 
use yii\helpers\Html;
?>
<section class="main-section match-sect single-match">
    <div class="match-sect-wrapper">
        
        
        <div class="match sidebar-content match-sect-item">
            <div class="match-sect-item-wrapper tbl">
                <a href="" class="dc match-info">
                    <div class="team-1-wrap fl">
                        <span class="team-img team-img-featurue"><?php echo Html::img((!is_null($model->team1)) ? $model->team1->img : '/img/site/tbd.png'); ?></span>
                        <span class="team-name team-name-featurue"><?= (!is_null($model->team1)) ? $model->team1->name : 'TBD' ?></span>
                    </div>
                    <div class="vs fl">
                        <span><img src="/img/site/vs1.png" alt=""></span>
                        <span class="match-time"><?= Yii::$app->formatter->asDate($model->start_time) ?></span>

                    </div>
                    <div class="team-2-wrap fl">
                        <span class="team-img team-img-featurue"><?php echo Html::img((!is_null($model->team2)) ? $model->team2->img : '/img/site/tbd.png'); ?></span>
                        <span class="team-name team-name-featurue"><?= (!is_null($model->team2)) ? $model->team2->name : 'TBD' ?></span>
                    </div>
                </a>
                <div class="tournament-img dc vam" style="background-image: url(<?= $model->tournament->img ?>)"></div>
            </div>

        </div>
        
        
        <div class="match-coff">

            <div class="match-coff-item">
                <div class="row">
                    <div class="col-sm-3">
                        <a class="booker-avatar" target="_blank" href="">
                            <span class="tournament-icon">
                                <img src="img/logo_gg.png">
                            </span>
                        </a>
                    </div>
                    <div class="col-sm-5">
                        <div class="match-coff-detail">
                            <span class="coff-team1">VirtusPro</span>
                            <span class="coff-detail-numbers">
                                <span class="first-coeff text-success">1.55</span> 
                                - 
                                <span class="second-coeff text-danger">2.55</span>
                            </span>
                            <span class="coff-team1">LGD</span>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <a target="_blank" href="" class="btn btn-watch">Сделать ставку</a>
                    </div>
                </div>
            </div>
            <div class="match-coff-item">
                <div class="row">
                    <div class="col-sm-3">
                        <a class="booker-avatar" target="_blank" href="">
                            <span class="tournament-icon">
                                <img src="img/logo_gg.png">
                            </span>
                        </a>
                    </div>
                    <div class="col-sm-5">
                        <div class="match-coff-detail">
                            <span class="coff-team1">VirtusPro</span>
                            <span class="coff-detail-numbers">
                                <span class="first-coeff text-success">1.55</span>
                                -
                                <span class="second-coeff text-danger">2.55</span>
                            </span>
                            <span class="coff-team1">LGD</span>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <a target="_blank" href="" class="btn btn-watch">Сделать ставку</a>
                    </div>
                </div>
            </div>
            <div class="match-coff-item">
                <div class="row">
                    <div class="col-sm-3">
                        <a class="booker-avatar" target="_blank" href="">
                            <span class="tournament-icon">
                                <img src="img/logo_gg.png">
                            </span>
                        </a>
                    </div>
                    <div class="col-sm-5">
                        <div class="match-coff-detail">
                            <span class="coff-team1">VirtusPro</span>
                            <span class="coff-detail-numbers">
                                <span class="first-coeff text-success">1.55</span>
                                -
                                <span class="second-coeff text-danger">2.55</span>
                            </span>
                            <span class="coff-team1">LGD</span>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <a target="_blank" href="" class="btn btn-watch">Сделать ставку</a>
                    </div>
                </div>
            </div>
            <div class="match-coff-item">
                <div class="row">
                    <div class="col-sm-3">
                        <a class="booker-avatar" target="_blank" href="">
                            <span class="tournament-icon">
                                <img src="img/logo_gg.png">
                            </span>
                        </a>
                    </div>
                    <div class="col-sm-5">
                        <div class="match-coff-detail">
                            <span class="coff-team1">VirtusPro</span>
                            <span class="coff-detail-numbers">
                                <span class="first-coeff text-success">1.55</span>
                                -
                                <span class="second-coeff text-danger">2.55</span>
                            </span>
                            <span class="coff-team1">LGD</span>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <a target="_blank" href="" class="btn btn-watch">Сделать ставку</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="single-match-prognoz">

        <div class="match-prognoz-header tbl">
            <div class="bookmeker-box dc">
                <img src="img/pari_match.png" alt="">
            </div>
            <div class="koff-box dc">
                <span class="koff-box-prognoz"><i>Прогноз:</i> Победа Secreet</span>
                <span class="koff-box-data"><i>Кф.</i> 1.85</span>
            </div>
            <div class="expert-box dc">
                <span class="expert-box-name">Прогнозист: <a href=""> Boris55</a></span>
                <span class="expert-box-data">
                    Прогнозов:
                    <i class="text-success"> 1320</i>
                    /
                    <i class="text-danger">285</i>
                </span>
                <span class="expert-box-procent">Процент успеха: 35%</span>
            </div>
        </div>
        <div class="match-prognoz-content">
            <span class="read-more">
                <i class="fa fa-arrow-down" aria-hidden="true"></i>
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
                Читать описапние прогноза
                <i class="fa fa-arrow-down" aria-hidden="true"></i>
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
            </span>
            <p class="text-white">Evil Geniuses СЛИШКОМ сильны. Ликвиды вчера ничего достойного так и не показали, хотя я вроде должен был быть рад их замечательной победе которая принесла мне 8 с лишним тысяч. Но откровенно говоря, там не было той игры которая нужна для победы над ребятками из EG. Поэтому я слегка побольше поставил, все таки топить не хочу на такой коэфицент<br>
                Сумаил.. главная проблема любого их противника. Этот таджик работает за всю команду просто. Мне крайне не нравится как играет zai последнее время, но впринципе он прибегает в мид и попадает станами. Больше не нужно особо. Артизи все так же добивает крипчиков, ничего нового. Добивает хорошо, ошибок не много, просто дефолт играет. Делает то что нужно, но не более. Но он намного лучше MATUMBAMAN. <br>
                Хотелось бы отметить то что Liquid начали меняться ролями. Миракл начал играть на керри когда Матумбе отдают Лон Друида в мид. И знаете, мне кажется что Миракл не ту роль выбрал. Он шикарный керри, очень агрессивный и не проседает по фарму, при этом он просто передвигается по всей карте с 7-8 минуты. Не знаю сохранится ли такая тенденция, но Ликвидам такой активный и сильный керри будет полезней мидар которого отпиздит Сумаил. Я не знаю кто должен против Сумаила стоять что бы тот его не отпиздил. В каждой игре, в каждом матче, весь турнир - он просто ссыт на лицо вражескому мидеру. Будь то MidOne, Noone, w33. Просто переигрывает, но тут есть своя загвоздочка. Они всегда, абсолютно всегда ждут момента когда враг откроет свою 4ку и мидера, и после этого залетает контра. Тот же матч против Secret, он бы не обоссал MidOne если бы ему не взяли OD после Ember Spirit'a, Lin'u против Razor'a. Как бы это полные контр пики, и такая тенденция сохраняется постоянно. 
                Как можете заметить, я еще взял победу со счетом 3-1. Просто.. Артизи всегда выигравает турниры НЕ от Valve со счетом 3-1. Постоянно. Откройте его Ликвипедию и посмотрите. </p>                                                 
        </div>
    </div>
    <div class="single-match-prognoz">

        <div class="match-prognoz-header tbl">
            <div class="bookmeker-box dc">
                <img src="img/pari_match.png" alt="">
            </div>
            <div class="koff-box dc">
                <span class="koff-box-prognoz"><i>Прогноз:</i> Победа Secreet</span>
                <span class="koff-box-data"><i>Кф.</i> 1.85</span>
            </div>
            <div class="expert-box dc">
                <span class="expert-box-name">Прогнозист: <a href=""> Boris55</a></span>
                <span class="expert-box-data">
                    Прогнозов:
                    <i class="text-success"> 1320</i>
                    /
                    <i class="text-danger">285</i>
                </span>
                <span class="expert-box-procent">Процент успеха: 35%</span>
            </div>
        </div>
        <div class="match-prognoz-content">
            <span class="read-more">
                <i class="fa fa-arrow-down" aria-hidden="true"></i>
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
                Читать описапние прогноза
                <i class="fa fa-arrow-down" aria-hidden="true"></i>
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
            </span>
            <p class="text-white">Evil Geniuses СЛИШКОМ сильны. Ликвиды вчера ничего достойного так и не показали, хотя я вроде должен был быть рад их замечательной победе которая принесла мне 8 с лишним тысяч. Но откровенно говоря, там не было той игры которая нужна для победы над ребятками из EG. Поэтому я слегка побольше поставил, все таки топить не хочу на такой коэфицент<br>
                Сумаил.. главная проблема любого их противника. Этот таджик работает за всю команду просто. Мне крайне не нравится как играет zai последнее время, но впринципе он прибегает в мид и попадает станами. Больше не нужно особо. Артизи все так же добивает крипчиков, ничего нового. Добивает хорошо, ошибок не много, просто дефолт играет. Делает то что нужно, но не более. Но он намного лучше MATUMBAMAN. <br>
                Хотелось бы отметить то что Liquid начали меняться ролями. Миракл начал играть на керри когда Матумбе отдают Лон Друида в мид. И знаете, мне кажется что Миракл не ту роль выбрал. Он шикарный керри, очень агрессивный и не проседает по фарму, при этом он просто передвигается по всей карте с 7-8 минуты. Не знаю сохранится ли такая тенденция, но Ликвидам такой активный и сильный керри будет полезней мидар которого отпиздит Сумаил. Я не знаю кто должен против Сумаила стоять что бы тот его не отпиздил. В каждой игре, в каждом матче, весь турнир - он просто ссыт на лицо вражескому мидеру. Будь то MidOne, Noone, w33. Просто переигрывает, но тут есть своя загвоздочка. Они всегда, абсолютно всегда ждут момента когда враг откроет свою 4ку и мидера, и после этого залетает контра. Тот же матч против Secret, он бы не обоссал MidOne если бы ему не взяли OD после Ember Spirit'a, Lin'u против Razor'a. Как бы это полные контр пики, и такая тенденция сохраняется постоянно. 
                Как можете заметить, я еще взял победу со счетом 3-1. Просто.. Артизи всегда выигравает турниры НЕ от Valve со счетом 3-1. Постоянно. Откройте его Ликвипедию и посмотрите. </p>                                                 
        </div>
    </div>
    <div class="single-match-prognoz">

        <div class="match-prognoz-header tbl">
            <div class="bookmeker-box dc">
                <img src="img/pari_match.png" alt="">
            </div>
            <div class="koff-box dc">
                <span class="koff-box-prognoz"><i>Прогноз:</i> Победа Secreet</span>
                <span class="koff-box-data"><i>Кф.</i> 1.85</span>
            </div>
            <div class="expert-box dc">
                <span class="expert-box-name">Прогнозист: <a href=""> Boris55</a></span>
                <span class="expert-box-data">
                    Прогнозов:
                    <i class="text-success"> 1320</i>
                    /
                    <i class="text-danger">285</i>
                </span>
                <span class="expert-box-procent">Процент успеха: 35%</span>
            </div>
        </div>
        <div class="match-prognoz-content">
            <span class="read-more">
                <i class="fa fa-arrow-down" aria-hidden="true"></i>
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
                Читать описапние прогноза
                <i class="fa fa-arrow-down" aria-hidden="true"></i>
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
            </span>
            <p class="text-white">Evil Geniuses СЛИШКОМ сильны. Ликвиды вчера ничего достойного так и не показали, хотя я вроде должен был быть рад их замечательной победе которая принесла мне 8 с лишним тысяч. Но откровенно говоря, там не было той игры которая нужна для победы над ребятками из EG. Поэтому я слегка побольше поставил, все таки топить не хочу на такой коэфицент<br>
                Сумаил.. главная проблема любого их противника. Этот таджик работает за всю команду просто. Мне крайне не нравится как играет zai последнее время, но впринципе он прибегает в мид и попадает станами. Больше не нужно особо. Артизи все так же добивает крипчиков, ничего нового. Добивает хорошо, ошибок не много, просто дефолт играет. Делает то что нужно, но не более. Но он намного лучше MATUMBAMAN. <br>
                Хотелось бы отметить то что Liquid начали меняться ролями. Миракл начал играть на керри когда Матумбе отдают Лон Друида в мид. И знаете, мне кажется что Миракл не ту роль выбрал. Он шикарный керри, очень агрессивный и не проседает по фарму, при этом он просто передвигается по всей карте с 7-8 минуты. Не знаю сохранится ли такая тенденция, но Ликвидам такой активный и сильный керри будет полезней мидар которого отпиздит Сумаил. Я не знаю кто должен против Сумаила стоять что бы тот его не отпиздил. В каждой игре, в каждом матче, весь турнир - он просто ссыт на лицо вражескому мидеру. Будь то MidOne, Noone, w33. Просто переигрывает, но тут есть своя загвоздочка. Они всегда, абсолютно всегда ждут момента когда враг откроет свою 4ку и мидера, и после этого залетает контра. Тот же матч против Secret, он бы не обоссал MidOne если бы ему не взяли OD после Ember Spirit'a, Lin'u против Razor'a. Как бы это полные контр пики, и такая тенденция сохраняется постоянно. 
                Как можете заметить, я еще взял победу со счетом 3-1. Просто.. Артизи всегда выигравает турниры НЕ от Valve со счетом 3-1. Постоянно. Откройте его Ликвипедию и посмотрите. </p>                                                 
        </div>
    </div>

</section>


