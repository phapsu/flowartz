<!--tabSlideOut-->
<script type="text/javascript" src="<?php echo base_url(); ?>template/js/tabslide/jquery.tabSlideOut.js"></script>
<script language="JavaScript" type="text/javascript">
    $(function(){
        $("#recently-post").show();
        $('.slide-out-div').tabSlideOut({
            tabHandle: '.handle',                              //class of the element that will be your tab
            pathToTabImage: '<?php echo base_url(); ?>template/images/favorite.png', //path to the image for the tab (optionaly can be set using css)
            imageHeight: '250px',                               //height of tab image
            imageWidth: '32px',                               //width of tab image
            tabLocation: 'right',                               //side of screen where tab lives, top, right, bottom, or left
            speed: 300,                                        //speed of animation
            action: 'click',                                   //options: 'click' or 'hover', action to trigger animation
            topPos: '142px',                                   //position from the top
            fixedPosition: true,                               //options: true makes it stick(fixed position) on scroll
            callBack: setButtonTop
        });

        $('.button_slide_top').bind('click', function(){
            $('.slide-out-div .handle').trigger('click');
        })

        function setButtonTop(){
            if ($('.slide-out-div').hasClass('open')) {
                $('.slide-out-div .handle').hide();
            }
            else{
                $('.slide-out-div .handle').show(300);
            }
        }
<?php /*
  if(@$_COOKIE['shopping_first_access']!="true"){
  setcookie("shopping_first_access", "true", time()+3600);  // expire in 1 hour
  ?>
  $('.button_slide_top').click();
  <?php
  }
 */ ?>
     });
</script>
<div id="recently-post">
<div class="slide-out-div">
    <div class="slide-out-div-top"><a href="javascript:void(0);" class="button_slide_top"><img src="<?php echo base_url(); ?>template/images/srecently_posted.png"></a></div>
    <a class="handle" href="javascript:void(0);" style="background-image: url(<?php echo base_url(); ?>template/images/favorite.png); background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; width: 32px; height: 250px; text-indent: -99999px; outline-style: none; outline-width: initial; outline-color: initial; position: absolute; top: 0px; left: -32px; display: none; background-position: initial initial; background-repeat: no-repeat no-repeat; ">RECENTLY POSTED</a>
    <div class="rpCont">
        <div class="rpCont1">
            <div class="rpCont2" id="recently_posts">
                hello world
            </div>
        </div>
    </div>
</div>
</div>