<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed'); ?>
<link href="<?php echo base_url(); ?>template/css/styles.css" rel="stylesheet" />
<?php include('favorite.php'); ?>

<div class="content">
    <div class="wrapper clearfix">
        <h1>Workshop index</h1>
        
        <?php foreach($categories as $id =>$name){ ?>
        <a href="index/<?php echo $id; ?>"><?php echo $name; ?></a> | &nbsp;                
        <?php } ?>
    </div>
    <!-- end of content wrapper -->
</div>
<!-- end of content div -->