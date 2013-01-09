<link href="<?php echo base_url(); ?>template/css/styles.css" rel="stylesheet" />

<div class="content">
    <div class="wrapper clearfix">
        <?php include('class_sidebar.php'); ?>
        <div class="profile-right">
            <h1>List classroom</h1>
            <table cellspacing="0" cellpadding="0" border="0" class="listTable highlight">
                <tbody><tr class="tableRowHeader">
                        <th width="5%">ID</th>
                        <th width="35%">Class Name</th>                                
                        <th width="15%">From Date</th>
                        <th width="15%">To Date</th>                        
                        <th width="15%">Registrant</th>                        
                        <th width="5%" >&nbsp; </th>
                        <th width="5%" >&nbsp; </th>
                        <th width="5%" >&nbsp; </th>
                    </tr>
                    <?php
                    foreach ($classes as $id => $row) {
                        ?>
                        <tr align="center">
                            <td><?php echo $row->cid; ?></td>
                            <td><?php echo $row->name; ?></td>                                        
                            <td><?php echo date("m/d/Y", strtotime($row->from_date)); ?></td>
                            <td><?php echo date("m/d/Y", strtotime($row->to_date)); ?></td>
                            <td><a href="#">30</a></td>
                            <td><a href="#"><img border="0" src="<?php echo base_url(); ?>template/images/icons/edit.png" title="Edit Classroom" /></a></td>
                            <td><a href="#" onclick="return confirm('Are you sure you want to delete this classroom?');"><img border="0" src="<?php echo base_url(); ?>template/images/icons/delete.png" title="Delete Classroom" /></a></td>
                            <td>
                                <?php  $today = date("Y-m-d");
                                if(strtotime($today) >= strtotime($row->to_date)) { ?>                                
                                    <a href="#"><img border="0" src="<?php echo base_url(); ?>template/images/icons/email.png" title="Send Finish Email" /></a>
                                <?php } ?>                                
                            </td>
                        </tr>
                    <?php } ?> 
            </table>
        </div>                

        <!-- end of profile-right div -->
    </div>
    <!-- end of content wrapper div -->
</div>
<!-- end of content div -->
