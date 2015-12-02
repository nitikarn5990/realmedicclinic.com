<ul>
    <li class="<?php
    if (PAGE_CONTROLLERS == 'slides') {
        echo 'active';
    }
    ?>">

        <a href="#">

            <!-- Icon Container -->

            <span class="da-nav-icon">

                <i class="fa fa-picture-o fa-2x"></i>

            </span>

            Slide

        </a>

        <ul>

            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>slides">เพิ่มภาพสไลด์</a></li>
            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>home_title&action=edit&id=1">หัวข้อ</a></li>

        </ul>

    </li>
      <li class="<?php
    if (PAGE_CONTROLLERS == 'promotion') {
        echo 'active';
    }
    ?>">

        <a href="#">

            <!-- Icon Container -->

            <span class="da-nav-icon">

                <i class="fa fa-bullhorn fa-2x"></i>

            </span>

            Promotion

        </a>

        <ul>

            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>promotion&action=edit&id=1">โปรโมชั่น</a></li>
      

        </ul>

    </li>

    <li class="<?php
    if (PAGE_CONTROLLERS == 'services') {
        echo 'active';
    }
    ?>">

        <a href="#">

            <!-- Icon Container -->

            <span class="da-nav-icon">

                <img src="<?= ADDRESS_ASSETS . 'booking.png' ?>">

            </span>

            Services       </a>

        <ul>
             <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>services_title&action=edit&id=1">หัวข้อ</a></li>
            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>services">บริการของเรา</a></li> 
        </ul>

    </li>

    
    <li class="<?php
    if (PAGE_CONTROLLERS == 'about') {
        echo 'active';
    }
    ?>">

        <a href="#">

            <!-- Icon Container -->

            <span class="da-nav-icon">

                <i class="fa fa-group fa-2x"></i>

            </span>
            เกี่ยวกับเรา
        </a>

        <ul>

            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>about&action=edit&id=1">จัดการเกี่ยวกับเรา</a></li>


        </ul>

    </li>
    <li class="<?php
    if (PAGE_CONTROLLERS == 'contact') {
        echo 'active';
    }
    ?>">

        <a href="#">

            <!-- Icon Container -->

            <span class="da-nav-icon">

                <i class="fa fa-envelope fa-2x"></i>

            </span>

            ติดต่อเรา        </a>

        <ul>

            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>contact&action=edit&id=1">จัดการติดต่อเรา</a></li>
            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>contact_message">ข้อความ</a></li>
            <li class="hidden"><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>send_email">ส่งเมล์</a></li>

        </ul>

    </li>



</ul>