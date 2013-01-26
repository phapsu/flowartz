<div class="menu-nav">
    <ul class="nav">
        <?php 
        $category_id = (isset($category_id) ? $category_id : null);
        foreach ($categories as $id => $name) {
            if($id==$category_id) $class = 'color: red';
            else $class = '';
            
            if ($id == 1) { ?>
                <li><a style="border-left:0 none; <?php echo $class ?>"  href="<?php echo base_url(); ?>workshop/cats/<?php echo $id; ?>"><?php echo $name; ?></a></li>
            <?php } else { ?>
                <li><a style="<?php echo $class ?>" href="<?php echo base_url(); ?>workshop/cats/<?php echo $id; ?>"><?php echo $name; ?></a></li>
            <?php }
        } ?>
    </ul>
</div>

<div class="workshop-header">
    <div class="workshop-header-l">
        <div>THIS TOOL IS DESIGNED TO CONNECT TEACHERS AND STUDENT AND EMPOWER THEM WITH A NUMBERS OF TOOLS TO SHARE EDUCATION OF THEIR ARTISTIC PASSION</div>
    </div>
    <div class="totalEn workshop-header-r">
        <div>
            <div class="workshop-header-r-c"> Select a category above or search for workshop</div>
        </div>
        <div>
            <form method="post" action="<?php echo base_url(); ?>workshop/search" id="frmSearch">
                <input type="hidden" name="fac_workshop[type_id]" value="0">
                <input type="text" name="fac_workshop[keyword]" placeholder="Search" autocomplete="true" class="workshop-search">
            </form>
        </div>
    </div>
</div>