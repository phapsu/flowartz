<?php
/**
 * Artists page view
 */
$this->load->helper('inflector');
$this->load->helper('text');
$page = $this->uri->segment(2, 0);
?>
<div class="content">
    <div class="wrapper clearfix">
        
        <!-- end of artist filter div -->
        <ul class="artist-group">
            <?php if (false === empty($workshop)) : ?>
                <?php foreach ($workshop as $id => $row): 
						$slug = ($row->name) ? underscore($row->name) : underscore($row->teacher_name);
						$slug = ($slug) ?  $slug : 'profile';
                                                
                                                echo $slug.'<br/><br/>'; 
				?>

                   
                <?php endforeach; ?>
            <?php else : ?>
                <li class="no-results">No search results found</li>
            <?php endif; ?>
        </ul>
        <!-- end of artist-group ul -->
        <div class="pagination"><?php if(isset($links)) echo $links; ?></div>
        <!-- end of pagination div -->
    </div>
    <!-- end of content wrapper div -->
</div>

