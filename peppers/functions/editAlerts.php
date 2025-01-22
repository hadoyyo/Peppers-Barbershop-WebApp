<?php
            if (isset($success)) { 
                unset($error); ?>
            <br>
            <div class="custom-alert-success" style="border: 2px solid rgb(108, 189, 69); border-radius: 10px; display: flex; align-items: center; padding 10px;" data-aos="fade-up">
            <div style="flex: 0 0 50px; display: flex; justify-content: center; align-items: center; font-size: 20px; font-weight: bold; color: rgb(108, 189, 69)"><i class="bi bi-check2" style="font-size: 60px"></i></div>
            <div style="flex: 1; color: rgb(108, 189, 69);" class="border-start-green">
                <b style="color: rgb(108, 189, 69);" class="ps-3 pe-1 pt-2"><?php echo $success; ?></b>
            </div>
            </div><br>
        <?php }
            ?>

            <?php
            if (isset($error)) {
                unset($success); ?>
            <br>
            <div class="custom-alert-error" style="border: 2px solid rgb(230, 29, 35); border-radius: 10px; display: flex; align-items: center; padding 10px;" data-aos="fade-up">
            <div style="flex: 0 0 50px; display: flex; justify-content: center; align-items: center; font-size: 20px; font-weight: bold; color: rgb(230, 29, 35);"><i class="bi bi-x" style="font-size: 60px"></i></div>
            <div style="flex: 1; color: rgb(230, 29, 35);" class="border-start">
                <b style="color: rgb(230, 29, 35);" class="ps-3 pe-1 pt-2"><?php echo $error; ?></b>
            </div>
            </div><br>
        <?php }
            if ( (isset($error))==FALSE && (isset($success))==FALSE) {
                echo "<div style='height: 152px'></div>";

            }
?>