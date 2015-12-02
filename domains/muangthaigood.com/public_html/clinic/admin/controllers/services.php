<?php
// If they are saving the Information	
if ($_POST['submit_bt'] == 'บันทึกข้อมูล' || $_POST['submit_bt'] == 'บันทึกข้อมูล และแก้ไขต่อ') {
    if ($_POST['submit_bt'] == 'บันทึกข้อมูล') {
        $redirect = true;
    } else {
        $redirect = false;
    }
    $arrData = array();
    $arrData = $functions->replaceQuote($_POST);

    if ($arrData['ref'] != "") {
        $arrData['services_ref'] = $functions->seoTitle($arrData['services_title']);
    } else {
        $arrData['services_ref'] = $functions->seoTitle($arrData['services_title']);
    }


    $services->SetValues($arrData);

    //print_r($arrData);


    if ($services->GetPrimary() == '') {
        $services->SetValue('created_at', DATE_TIME);
        $services->SetValue('updated_at', DATE_TIME);
    } else {
        $services->SetValue('updated_at', DATE_TIME);
    }

    if ($services->Save()) {
        SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ', 'success');
        //Redirect if needed

        if (isset($_FILES['file_array'])) {

            $Allfile = "";
            $Allfile_ref = "";
            for ($i = 0; $i < count($_FILES['file_array']['tmp_name']); $i++) {
                if ($_FILES["file_array"]["name"][$i] != "") {
                    unset($arrData['webs_money_image']);

                    $targetPath = DIR_ROOT_FILES . "/";

                    $newImage = DATE_TIME_FILE . "_" . $_FILES['file_array']['name'][$i];

                    $cdir = getcwd(); // Save the current directory

                    chdir($targetPath);

                    copy($_FILES['file_array']['tmp_name'][$i], $targetPath . $newImage);

                    chdir($cdir); // Restore the old working directory   

                    $services_file->SetValue('file_name', $newImage);

                    if ($_POST['file_name_ref'][$i] == '') {

                        //$Allfile_ref .= "|_|" . $newImage;
                        //$services_file->SetValue('file_name', substr($Allfile, 3));
                        $services_file->SetValue('file_name_ref', $newImage);
                    } else {
                        //$Allfile_ref .= "|_|" .   $functions->seoTitle($_POST['file_name_ref'][$i]);
                        $services_file->SetValue('file_name_ref', $functions->seoTitle($_POST['file_name_ref'][$i]));
                    }

                    $services_file->SetValue('services_id', $services->GetPrimary());
                    $services_file->SetValue('type', "image");
                    //$services_file->Save();
                    if ($services_file->Save()) {

                        //SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');
                        $services_file->ResetValues();
                    } else {
                        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง 1');
                    }
                }
            }
        }


        if ($_FILES["cover_img_array"]["name"][0] != "") {

            $targetPath = DIR_ROOT_COVER . "/";

            $newImage = DATE_TIME_FILE . "_" . $_FILES['cover_img_array']['name'][0];

            $cdir = getcwd(); // Save the current directory

            chdir($targetPath);

            copy($_FILES['cover_img_array']['tmp_name'][0], $targetPath . $newImage);

            chdir($cdir); // Restore the old working directory   

            $services->SetValue('cover_img', $newImage);

            if ($services->Save()) {

                //SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');
                //$services->ResetValues();
            } else {
                SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง 2');
            }
        }

        //อัพโหลด ไฟล์เอกสาร

        if ($_FILES["file_doc"]["name"] != "") {

            $targetPath = DIR_ROOT_DOCUMENT . "/";

            $newImage = DATE_TIME_FILE . "_" . $_FILES['file_doc']['name'];

            $cdir = getcwd(); // Save the current directory

            chdir($targetPath);

            copy($_FILES['file_doc']['tmp_name'], $targetPath . $newImage);

            chdir($cdir); // Restore the old working directory   
            $services_file->SetValue('file_name', $newImage);
            $services_file->SetValue('file_name_ref', $newImage);
            $services_file->SetValue('type', "file");

            $services_file->SetValue('services_id', $services->GetPrimary());
            //$services_file->Save();
            if ($services_file->Save()) {

                //SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');
                $services_file->ResetValues();
            } else {
                SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง 3');
            }
        }



        if ($redirect) {
            header('location:' . ADDRESS_ADMIN_CONTROL . 'services');
            die();
        } else {
            header('location:' . ADDRESS_ADMIN_CONTROL . 'services&action=edit&id=' . $services->GetPrimary());
            die();
        }
    } else {
        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง 4');
    }
}
//delete file
if ($_GET['services_file_id'] != '' && $_GET['action'] == 'edit') {

    $services_file->SetPrimary((int) $_GET['services_file_id']);

    if ($services_file->Delete()) {
        // Set alert and redirect
        if (unlink(DIR_ROOT_FILES . $services_file->GetValue('file_name'))) {
            //	fulldelete($location); 
            SetAlert('Delete Data Success', 'success');
        }
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
        //	echo $_GET['services_file_id'];
    }
}
//delete cover image
if ($_GET['cover_img_id'] != '' && $_GET['action'] == 'edit') {

    $arrImage = array(
        'cover_img' => '',
        'updated_at' => DATE_TIME
    );

    $arrImgID = array("id" => $_GET['cover_img_id']);

    if ($services->updateSQL($arrImage, $arrImgID)) {
        if (unlink(DIR_ROOT_COVER . $services->GetValue('cover_img'))) {
            
        }
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }

    header('location:' . ADDRESS_ADMIN_CONTROL . 'services&action=edit&id=' . $_GET['id']);
}

//delete document
if ($_GET['document_id'] != '' && $_GET['action'] == 'edit') {

    $services_file->SetPrimary((int) $_GET['document_id']);

    if ($services_file->Delete()) {
        // Set alert and redirect
        if (unlink(DIR_ROOT_DOCUMENT . $services_file->GetValue('file_name'))) {
            //	fulldelete($location); 
            SetAlert('Delete Data Success', 'success');
        }
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
        //	echo $_GET['services_file_id'];
    }
}

// If Deleting the Page
if ($_GET['id'] != '' && $_GET['action'] == 'del') {
    // Get all the form data
    $arrDel = array('id' => $_GET['id']);
    $services->SetValues($arrDel);

    // Remove the info from the DB
    if ($services->Delete()) {
        // Set alert and redirect
        SetAlert('Delete Data Success', 'success');
        header('location:' . ADDRESS_ADMIN_CONTROL . 'services');
        die();
    } else {
        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}

if ($_GET['id'] != '' && $_GET['action'] == 'edit') {
    // For Update
    $services->SetPrimary((int) $_GET['id']);
    // Try to get the information
    if (!$services->GetInfo()) {
        SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
        $services->ResetValues();
    }
}
?>
<?php if ($_GET['action'] == "add" || $_GET['action'] == "edit") { ?>
    <div class="row-fluid">
        <div class="span12">
            <?php
            // Report errors to the user
            Alert(GetAlert('error'));
            Alert(GetAlert('success'), 'success');
            ?>
            <div class="da-panel collapsible">
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-<?php echo ($services->GetPrimary() != '') ? 'application-edit' : 'add' ?>"></i> <?php echo ($services->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม' ?> บริการ </span> </div>
                <div class="da-panel-content da-form-container">
                    <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL ?>services<?php echo ($services->GetPrimary() != '') ? '&action=edit&id=' . $services->GetPrimary() : ''; ?>" method="post" class="da-form">
                        <?php if ($services->GetPrimary() != ''): ?>
                            <input type="hidden" name="id" value="<?php echo $services->GetPrimary() ?>" />
                            <input type="hidden" name="created_at" value="<?php echo $services->GetValue('created_at') ?>" />
                            <input type="hidden" name="cover_img" value="<?php echo $services->GetValue('cover_img') ?>" />
                            <input type="hidden" name="pickup_time" value="<?php echo $services->GetValue('pickup_time') ?>" />
                            <input type="hidden" name="time" value="<?php echo $services->GetValue('time') ?>" />
                        <?php endif; ?>
                        <div class="da-form-inline">
                            <div class="da-form-row">
                                <label class="da-form-label">ชื่อบริการ <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="services_title" id="services_title" value="<?php echo ($services->GetPrimary() != '') ? $services->GetValue('services_title') : ''; ?>" class="span12 required" />
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">ชื่อใช้อ้างอิง / URL</label>
                                <div class="da-form-item large">
                                    <input type="text" name="ref" id="ref" value="<?php echo ($services->GetPrimary() != '') ? $services->GetValue('services_ref') : ''; ?>" class="span12" />
                                    <label class="help-block">ว่างไว้ถ้าต้องการให้สร้างชื่ออ้างอิงอัตโนมัติ</label>
                                </div>
                            </div>

                            <div class="da-form-row">
                                <label class="da-form-label">เนื้อหาบริการ <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <textarea name="services" id="services" class="span12 tinymce required"><?php echo ($services->GetPrimary() != '') ? $services->GetValue('services') : ''; ?></textarea>
                                    <label for="services" generated="true" class="error" style="display:none;"></label>
                                </div>
                            </div>


                            <fieldset class="da-form-inline">
                                <legend><i class="fa fa-picture-o"></i> อัพโหลดภาพหน้าปก [JPG, PNG, GIF]</legend>
                                <div class="da-form-row">
                                    <label class="da-form-label">ภาพหน้าปก</label>
                                    <div class="da-form-item large">
                                        <?php
                                        $sql = "SELECT * FROM " . $services->getTbl() . " WHERE id = '" . $services->GetPrimary() . "' AND cover_img not in('')";
                                        $query = $db->Query($sql);
                                        if ($db->NumRows($query) > 0) {

                                            while ($row = $db->FetchArray($query)) {
                                                ?>
                                                <div class="span4">
                                                    <p> <a class="fancybox" href="<?php echo ADDRESS_COVER . $row['cover_img'] ?>"> <img class="img-polaroid" src="<?php echo ADDRESS_COVER . $row['cover_img'] ?>" style="max-width:150px;"/></a> <span class=""> <a class="da-button red small" href="<?php echo ADDRESS_ADMIN_CONTROL ?>services&action=edit&id=<?php echo $_GET['id'] ?>&cover_img_id=<?php echo $row['id'] ?>" style="color:#FFF; size:20px; text-decoration: none;" onclick="return confirm('Are you sure you want to delete?')" > ลบไฟล์ </a></span> </p>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="da-form-row">
                                    <label class="da-form-label">อัพโหลดภาพหน้าปก</label>
                                    <div class="da-form-item large">
                                        <input id="input-3" type="file" class="file" name="cover_img_array[]" data-show-upload="false" data-show-caption="true" multiple=true>
                                        <div id="errorBlock44" class="help-block"></div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="da-form-row">
                                <label class="da-form-label">จัดลำดับ <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="number" name="sort" id="sort" value="<?php echo ($services->GetPrimary() != '') ? $services->GetValue('sort') : '0'; ?>" class="span12" />
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">สถานะ <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <ul class="da-form-list">
                                        <?php
                                        $getStatus = $services->get_enum_values('status');
                                        $i = 1;
                                        foreach ($getStatus as $status) {
                                            ?>
                                            <li>
                                                <input type="radio" name="status" id="status" value="<?php echo $status ?>" <?php echo ($services->GetPrimary() != "") ? ($services->GetValue('status') == $status) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : "" ?> class="required"/>
                                                <label><?php echo $status ?></label>
                                            </li>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="btn-row">
                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success" />
                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />
                            <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>services" class="btn btn-danger">ยกเลิก</a> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="row-fluid">
        <div class="span12">
            <?php
            // Report errors to the user
            Alert(GetAlert('error'));
            Alert(GetAlert('success'), 'success');
            ?>
            <div class="da-panel collapsible">
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-grid"></i> บริการ ทั้งหมด </span> </div>
                <div class="da-panel-toolbar">
                    <div class="btn-toolbar">
                        <div class="btn-group"> <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL ?>services&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a> </div>
                    </div>
                </div>
                <div class="da-panel-content da-table-container">

                    <table id="da-ex-datatable-sort" class="da-table" sort="0" order="asc" width="1000">
                        <thead>
                            <tr>
                                <th>รหัส</th>
                                <th>ภาพหน้าปก</th>
                                <th>ชื่อบริการ</th>

                                <th>สถานะ</th>
                                <th>แก้ไขล่าสุด</th>
                                <th>ลำดับ</th>
                                <th>ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM " . $services->getTbl();
                            $query = $db->Query($sql);
                            while ($row = $db->FetchArray($query)) {
                                ?>
                                <tr>
                                    <td class="center"><?php echo $row['id']; ?></td>
                                    <td style="text-align:center; max-width:100px;">
                                        <a class="fancybox" href="<?php echo $row['cover_img'] == '' ? NO_IMAGE : ADDRESS_COVER . $row['cover_img'] ?>">
                                            <?php if ($row['cover_img'] == '') { ?>

                                                <img class="img_cover img-polaroid" src="<?= NO_IMAGE ?>">
        <?php } else { ?>
                                                <img class="img_cover img-polaroid" src="<?= ADDRESS_COVER . $row['cover_img'] ?>">
                                            <?php }
                                            ?>

                                        </a>
                                    </td>
                                    <td><div class="word-wrap"><?php echo $row['services_title']; ?></div></td>

                                    <td class="center"><div class="word-wrap"><i class="icol-<?php echo ($row['status'] == 'ใช้งาน') ? 'accept' : 'cross' ?>" title="<?php echo $row['status'] ?>"></i></div></td>
                                    <td class="center"><div class="word-wrap"><?php echo $functions->ShowDateThTime($row['updated_at']) ?></div></td> 
                                    <td class="center"><div class="word-wrap"><?php echo ($row['sort']) ?></div></td>
                                    <td class="center"><div class="word-wrap"> <a href="<?php echo ADDRESS_ADMIN_CONTROL ?>services&action=edit&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-small">แก้ไข / ดู</a> 
                                            <a href="#" onclick="if (confirm('คุณต้องการลบข้อมูลนี้หรือใม่?') == true) {
                                                        document.location.href = '<?php echo ADDRESS_ADMIN_CONTROL ?>services&action=del&id=<?php echo $row['id'] ?>'
                                                                }" class="btn btn-danger btn-small">ลบ</a> </div></td>
                                </tr>
                                           <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<script src="<?php echo ADDRESS_ADMIN ?>plugins/fileinput/js/fileinput.min.js" type="text/javascript"></script> 
<script src="<?php echo ADDRESS_ADMIN ?>plugins/fileinput/js/fileinput_locale_th.js" type="text/javascript"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script> 

<script type="text/javascript">
                                                    $('#short_services').maxlength({max: 300});
                                                    $("#input-2").fileinput({
                                                        language: "th",
                                                        allowedFileExtensions: ["jpg", "gif", "png"],
                                                        elErrorContainer: "#errorBlock43",
                                                    });
                                                    $("#input-3").fileinput({
                                                        language: "th",
                                                        allowedFileExtensions: ["jpg", "gif", "png"],
                                                        elErrorContainer: "#errorBlock44",
                                                    });
                                                    $("#input-4").fileinput({
                                                        language: "th",
                                                        elErrorContainer: "#errorBlock45",
                                                    });


                                                    $(document).ready(function () {


                                                        $(".fancybox").fancybox({
                                                            prevEffect: 'none',
                                                            nextEffect: 'none',
                                                            closeBtn: false,
                                                            helpers: {
                                                                title: {type: 'inside'},
                                                                buttons: {}
                                                            }
                                                        });



                                                    });


</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">


<script>
    $(function () {
        // $( "#datepicker" ).datepicker();
        $("#activity_date").datepicker({dateFormat: "yy-mm-dd"}).val()
    });

    jQuery(function ($) {
        var price = $('#price_format').autoNumeric('init');

        $("input[name='submit_bt']").click(function () {
            $('#price').val($('#price_format').autoNumeric('get'));
        });


    });

</script>
<style>
    /*Colored Label Attributes*/
    .label {
        background-color: #BFBFBF;
        border-bottom-left-radius: 3px;
        border-bottom-right-radius: 3px;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        color: #FFFFFF;
        font-size: 9.75px;
        font-weight: bold;
        padding-bottom: 2px;
        padding-left: 4px;
        padding-right: 4px;
        padding-top: 2px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .label:hover {
        opacity: 80;
    }

    .label.success {
        background-color: #46A546;
    }
    .label.success2 {
        background-color: #CCC;
    }
    .label.success3 {
        background-color: #61a4e4;

    }

    .label.warning {
        background-color: #FC9207;
    }

    .label.failure {
        background-color: #D32B26;
    }

    .label.alert {
        background-color: #33BFF7;
    }

    .label.good-job {
        background-color: #9C41C6;
    }
    table th{
        overflow : auto;
    }


</style>
