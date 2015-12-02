
<?php
if ($_GET['id'] != '') {

    $arrID = explode('-', $_GET['id']);

    if ($arrID[0] != '') {
        ?>
        <div class = "col-md-12 col-sm-12 col-xs-12  box-home-detail">
            <h1><?= $services->getDataDesc('services_title', 'id = ' . $arrID[0]) ?></h1>
            <p><?= $services->getDataDesc('services', 'id = ' . $arrID[0]) ?></p>
        </div>
        <style>

            .box-home-detail > p {
                color: #000 !important;
                font-size: 13px;
            }
        </style>

        <?php
    }
} else {
    ?>
    <div class="col-md-4 col-md-push-8 col-sm-4  col-xs-12  box-contact">
        <div class="righttxtcontantserviec">
            <h2 style="font-size: 17px;margin:0 0;">หมวดหมู่บริการของเรียล เมดิค คลีนิค</h2>
            <ul>
                <?php
                $sql = "SELECT * FROM " . $services->getTbl() . " WHERE status = 'ใช้งาน' ORDER BY sort ASC";
                $query = $db->Query($sql);
                while ($row = $db->FetchArray($query)) {
                    ?>
                    <li><a href="<?= ADDRESS . 'services/' . $row['id'] . '-' . $row['services_ref'] ?>.html"><?= $row['services_title'] ?></a></li>


                <?php } ?>

            </ul>
        </div>
    </div>
    <div class="col-md-8 col-md-pull-4 col-sm-8 col-xs-12  box-home-detail">
        <h1><?= $services_title->getDataDescFirstID('services_title') ?></h1>
        <p><?= $services_title->getDataDescFirstID('services_detail') ?></p>

        <?php
        $sql2 = "SELECT * FROM " . $services->getTbl() . " WHERE status = 'ใช้งาน' ORDER BY sort ASC";
        $query2 = $db->Query($sql2);
        while ($row2 = $db->FetchArray($query2)) {
            if ($row2['cover_img'] != '') {
                $pathIMG = ADDRESS_COVER . $row2['cover_img'];
            } else {
                // $pathIMG =  ADDRESS . 'images/noimg.png';
                $pathIMG = ADDRESS_COVER . $row2['cover_img'];
            }
            ?>

            <div class="col-md-6 box-services-title">
                <a href="<?= ADDRESS . 'services/' . $row2['id'] . '-' . $row2['services_ref'] ?>.html"><img src="<?= $pathIMG ?>" width="100%">
                    <p class="text-center" style="margin-top: 10px;"><?= $row2['services_title'] ?></p></a>
            </div>

        <?php } ?>


    </div>


    <style>
        .box-services{
            background: url(<?= ADDRESS ?>images/bglefttxtcontant.png) left top repeat;
        }
        .box-services > .box-home-detail{
            background: none;
        }
        .box-services > .box-contact{
            padding-right: 0;
        }
        .box-services-title{
 
        }
    </style>
<?php } ?>
 