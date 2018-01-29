<!--VC Start-->
<div class="vc-container vc-front-end">

    <?php
    if (!empty($all_rows)) {

        foreach ($all_rows as $all_row) {
            ?>
            <div class="row-container" data-id="{{$all_row['id_modcustomfieldrow']}}">
                <div class="vc-row-body">
                    <div class="row-content">
                        <div class="vc-columns">
                            <?php
                            $rw = 0;
                            if (!empty($all_row['groups'])) {
                                foreach ($all_row['groups'] as $key => $group) {
                                    if ($rw >= 100) {
                                        $rw = 0;
                                        echo '<div class="clearfix"></div>';
                                    }
                                    ?>
                                    <div style="width: calc(<?php echo $group['column_width']; ?>% - 10px);" data-row-id="{{$group['row_id']}}" data-group-id="{{$group['id_modcustomfieldgroup']}}" class="vc-column vc-column-{{$group['column_width']}}-{{$group['id_modcustomfieldgroup']}}">

                                        <?php
                                        if (!empty($group['elements'])) {
                                            foreach ($group['elements'] as $key => $element) {
                                                CrmLayoutHelper::drawCrmElement($element);
                                            }
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    $rw += $group['column_width'];
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
<!--VC End-->