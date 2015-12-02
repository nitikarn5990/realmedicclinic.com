
<?php
@session_start();
if ($_POST ["submit_bt"] == 'Send') {
    $chk = 0;
    $cpt = $_POST['capt'];
    if ($cpt != $_SESSION['CAPTCHA']) {
        ?>
        <script>
            $(document).ready(function () {
                alert('Error code');
            });
        </script>
        <?php
    } else {

        $chk = 1;
        $arrData = array();

        $arrData = $functions->replaceQuote($_POST);

        $contact_message->SetValues($arrData);

        if ($contact_message->GetPrimary() == '') {

            $contact_message->SetValue('created_at', DATE_TIME);

            $contact_message->SetValue('updated_at', DATE_TIME);
        } else {

            $contact_message->SetValue('updated_at', DATE_TIME);
        }

        $contact_message->SetValue('status', 'no read');

        // $contact_message->Save();

        if ($contact_message->Save()) {

            echo "<script> $(document).ready(function () { alert('Send Success');    });</script>";
        } else {
            echo "<script>$(document).ready(function () { alert('Error');   });</script>";
        }
    }
}
?>
<div class = "col-md-12 col-sm-12 col-xs-12  box-home-detail">
    <h1><?= $contact->getDataDescFirstID('contact_title') ?></h1>
    <p><?= $contact->getDataDescFirstID('contact_detail') ?></p>

    <form action="<?php echo ADDRESS ?>contact.html" method="post" class="form-send-msg">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="txt_name">Name:</label>

                <input type="text" name="txt_name" class="form-control" value="<?= $chk == 0 ? $_POST['txt_name'] : '' ?>" required=""/>

            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="txt_name">Email:</label>
                <input type="email" name="txt_email" class="input form-control" value="<?= $chk == 0 ? $_POST['txt_email'] : '' ?>" required=""/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="txt_name">Tel:</label>
                <input type="text" name="txt_tel" value="<?= $chk == 0 ? $_POST['txt_tel'] : '' ?>"

                       class="input form-control" required="required" />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="txt_name">Subject:</label>
                <input type="text" name="txt_subject" value="<?= $chk == 0 ? $_POST['txt_subject'] : '' ?>" 

                       class="input form-control " required="required" />
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="txt_name">Message:</label>
                <textarea name="txt_message" class="area form-control" rows="5"
                          required="required" ><?= $chk == 0 ? $_POST['txt_message'] : '' ?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="txt_name"> Enter Code:</label>
                <input type="text" name="capt" id="capt" required=""/> <img src="image_capt.php" id="mycapt"  align="absmiddle" />

                <img id="changeCpt" src="https://www.e-cnhsp.sp.gov.br/GFR/imagens/refresh.png" style="vertical-align: middle;cursor: pointer;">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <input id="submit_bt" name="submit_bt" type="submit" value="Send" style="width: 80px; height: 30px;">
                <input name="reset" type="reset" value="Reset" style="width: 80px; height: 30px;">
            </div>
        </div>

    </form>
</div>


<style>
    .form-send-msg p{
        margin-bottom: 10px;
    }
    #contant input{

        max-width: 300px;
    }
    #capt{
        max-width: 100px;
    }
   
</style>

<script type="text/javascript">



    $('#changeCpt').click(function (e) {
        var v = Math.random();
        $('#mycapt').attr('src', 'image_capt.php?v=' + v);
    });

</script>