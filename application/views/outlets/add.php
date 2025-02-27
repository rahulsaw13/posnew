<?php echo form_open('outlets/save', array('id'=>'outlet_form', 'class'=>'form-horizontal')); ?>
<div class="new-form-design-background">
    <div class="form-header">Add New Outlet</div>
    <div class="new-form-design-container">
        <div class="design-header">
            <span class="glyphicon glyphicon-cog"></span>
            <span class="design-header-text">Outlet Information</span>
        </div>
        <hr class="mb-0 mt-10">
        <fieldset class="row m-0 p-0" id="outlet_info">
            <div class="row mx-10">
                <div class="col-xs-4 padding-20">
                    <div class="form-group form-group-sm">
                        <?php echo form_label('Branch Name', 'branch_name', array('class'=>'control-label')); ?>
                        <span class="required-red">*</span>
                        <div class="input-group w-full custom-form-group">
                            <span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag">
                                <span class="glyphicon glyphicon-home"></span>
                            </span>
                            <?php echo form_input(array(
                                'name'=>'branch_name',
                                'id'=>'branch_name',
                                'class'=>'form-control input-sm custom-input custom-input-width-with-error',
                                'placeholder'=>'Enter Branch Name')
                            ); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4 padding-20">
                    <div class="form-group form-group-sm">
                        <?php echo form_label('Email', 'email', array('class'=>'control-label')); ?>
                        <span class="required-red">*</span>
                        <div class="input-group w-full custom-form-group">
                            <span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag">
                                <span class="glyphicon glyphicon-envelope"></span>
                            </span>
                            <?php echo form_input(array(
                                'type'=>'email',
                                'name'=>'email',
                                'id'=>'email',
                                'class'=>'form-control input-sm custom-input custom-input-width-with-error',
                                'placeholder'=>'Enter Email')
                            ); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4 padding-20">
                    <div class="form-group form-group-sm">
                        <?php echo form_label('Password', 'password', array('class'=>'control-label')); ?>
                        <span class="required-red">*</span>
                        <div class="input-group w-full custom-form-group">
                            <span class="input-group-addon input-sm theme-bg-color mix-input-icon-width mix-input-icon-left-tag">
                                <span class="glyphicon glyphicon-lock"></span>
                            </span>
                            <?php echo form_password(array(
                                'name'=>'password',
                                'id'=>'password',
                                'class'=>'form-control input-sm custom-input custom-input-width-with-error',
                                'placeholder'=>'Enter Password')
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row mx-10 pb-10">
            <div class="form-group-container">
                <div class="margin-top-50 justify-right">
                    <button class='form-buttons theme-transition-effect' type="button" title="Cancel" onclick="window.location.href='<?php echo site_url("outlets"); ?>';">
                        Cancel
                    </button>
                </div>
                <div class="margin-top-50">
                    <button class='form-buttons theme-transition-effect' type="submit" title="Submit">
                        Save Outlet
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
