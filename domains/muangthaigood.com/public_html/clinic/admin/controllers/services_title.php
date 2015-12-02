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




    $services_title->SetValues($arrData);



    if ($services_title->GetPrimary() == '') {


        $services_title->SetValue('created_at', DATE_TIME);


        $services_title->SetValue('updated_at', DATE_TIME);
    } else {


        $services_title->SetValue('updated_at', DATE_TIME);
    }



    //	$services_title->Save();


    if ($services_title->Save()) {


        SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ', 'success');


        //Redirect if needed

        if ($redirect) {


            header('location:' . ADDRESS_ADMIN_CONTROL . 'services_title');


            die();
        } else {


            header('location:' . ADDRESS_ADMIN_CONTROL . 'services_title&action=edit&id=' . $services_title->GetPrimary());


            die();
        }
    } else {


        SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}


if ($_GET['gallery_file_id'] != '' && $_GET['action'] == 'edit') {


    $services_title_files->SetPrimary((int) $_GET['gallery_file_id']);


    if ($services_title_files->Delete()) {


        // Set alert and redirect


        if (unlink(DIR_ROOT_GALLERY . $services_title_files->GetValue('file_name'))) {


            //	fulldelete($location); 


            SetAlert('Delete Data Success', 'success');
        }
    } else {


        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


        //	echo $_GET['gallery_file_id'];
    }
}





// If Deleting the Page


if ($_GET['id'] != '' && $_GET['action'] == 'del') {


    // Get all the form data


    $arrDel = array('id' => $_GET['id']);


    $services_title->SetValues($arrDel);





    // Remove the info from the DB


    if ($services_title->Delete()) {


        // Set alert and redirect


        SetAlert('Delete Data Success', 'success');


        header('location:' . ADDRESS_ADMIN_CONTROL . 'gallery');


        die();
    } else {


        SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');
    }
}





if ($_GET['id'] != '' && $_GET['action'] == 'edit') {


    // For Update


    $services_title->SetPrimary((int) $_GET['id']);


    // Try to get the information


    if (!$services_title->GetInfo()) {


        SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');


        $services_title->ResetValues();
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
                <div class="da-panel-header"> <span class="da-panel-title"> <i class="icol-<?php echo ($services_title->GetPrimary() != '') ? 'application-edit' : 'add' ?>"></i> <?php echo ($services_title->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม' ?> หัวข้อบริการ </span> </div>
                <div class="da-panel-content da-form-container">
                    <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL ?>services_title<?php echo ($services_title->GetPrimary() != '') ? '&id=' . $services_title->GetPrimary() : ''; ?>" method="post" class="da-form">
                        <?php if ($services_title->GetPrimary() != ''): ?>
                            <input type="hidden" name="id" value="<?php echo $services_title->GetPrimary() ?>" />
                            <input type="hidden" name="created_at" value="<?php echo $services_title->GetValue('created_at') ?>" />
                        <?php endif; ?>
                        <div class="da-form-inline">
                            <div class="da-form-row">
                                <label class="da-form-label">หัวข้อ <span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <input type="text" name="services_title" id="services_title" value="<?php echo ($services_title->GetPrimary() != '') ? $services_title->GetValue('services_title') : ''; ?>" class="span12 required" />
                                </div>
                            </div>
                            <div class="da-form-row">
                                <label class="da-form-label">รายละเอียด<span class="required">*</span></label>
                                <div class="da-form-item large">
                                    <textarea name="services_detail" id="services_detail" class="span12 tinymce required"><?php echo ($services_title->GetPrimary() != '') ? $services_title->GetValue('services_detail') : ''; ?></textarea>
                                    <label for="services_detail" generated="true" class="error" style="display:none;"></label>
                                </div>
                            </div>
                        </div>
                        <div class="btn-row">

                            <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
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








</style>
