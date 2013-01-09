<!--Jquery format currency-->
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/formatCurrency/jquery.formatCurrency-1.4.0.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/formatCurrency/i18n/jquery.formatCurrency.en-US.js"></script>
<div class="content">
    <div class="wrapper clearfix">
        <?php include('class_sidebar.php'); ?>
        <div class="profile-right">
            <h1>Add classroom</h1>
            <div class="edit-form">
                <form method="post" action="<?php echo base_url(); ?>user/classroom_do_add" id="frmClassroom" class="fa-edit-form">
                    <label for="">Class Name</label>
                    <input type="text" name="fac_classroom[name]" id="name" placeholder="Class Name is required" />

                    <label for="">From Date</label>
                    <input type="text" name="fac_classroom[from_date]" id="from_date" placeholder="From Date is required"/>

                    <label for="">To Date</label>
                    <input type="text" name="fac_classroom[to_date]" id="to_date" placeholder="To Date is required"/>
                    
                    <label for="">Fee</label>
                    <div style="float:left; width:400px;">
                        <input placeholder="Fee for 1 person" type="text" name="fac_classroom[fee]" class="currency" id="fee" style="float: left; width: 130px;"/>
                        <select name="fac_classroom[fee_currency]" placeholder="" class="span1" style="float:left; width:80px;" id="RegistrationEventFeeCurrency">
                            <option value="CAD" selected="selected">CAD</option>
                            <option value="USD">USD</option>
                            <option value="EURO">EURO</option>
                        </select>
                    </div>
                    
                    <label for="">Paypal Code</label>
                    <textarea name="fac_classroom[paypal_code]" id="paypal_code" style="height:100px; width: 635px;" placeholder="Flowartz can transfer to you by using Paypal  Express Check Out service. It's easy and simple to obtain this code from Paypal, more detail you can visit this guide link from Paypal https://www.paypal.com/ca/cgi-bin/webscr?cmd=xpt/Merchant/merchant/ExpressCheckoutButtonCode-outside"></textarea>
                    
                    <label for="">Description</label>
                    <textarea name="fac_classroom[description]" id="description" style="height:100px; width: 635px;" placeholder=""></textarea>
                    
                    <input type="submit" name="save" id="btnSave" value="Save" />
                    <input type="reset" name="reset" value="Cancel" />
                    
                </form>
            </div>

        </div>                
        <div class="profile-right" id="out" style="display: none; margin-top: 20px;padding-bottom: 25px;">

        </div>
        <div id="video_div">
        </div>
        <!-- end of profile-right div -->
    </div>
    <!-- end of content wrapper div -->
</div>
<!-- end of content div -->

<script>
$(function() {
        $( "#from_date" ).datepicker();
        $( "#to_date" ).datepicker();
        
        $('.currency').blur(function()
        {
            $('.currency').formatCurrency();
        });
});
</script>