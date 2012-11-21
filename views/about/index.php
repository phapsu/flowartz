<link rel="stylesheet" href="<?php echo base_url(); ?>template/css/isotope.css" type="text/css" media="all" />

<div id="message" style="padding: 2px 0;">
	<div class="wrapper clearfix">
		<!--<h1 class="">Who We Are</h1>-->
	</div>
	<!-- end of message wrapper -->
</div>
<!-- end of message div -->
<div class="content">
    <div id="accordion" class="wrapper clearfix">
        <div class="about_me">
            <div class="accordionButton">
                <span>About Us</span>
            </div>
            <div class="accordionContent accordion">
                <p>Flow Artz Distribution and Development is a radical new concept in cooperative resourcing to help empower artists of all diciplines and provide resources, education, professional mentoring and affordable marketing tools to help realize the dream of generating a sustainable income from your passions.</p>
                <p>&nbsp;</p>
                <p>Flow Artz was orginally conceptualized in 2007 by Brandon Tyson and since then many new individuals have joined the cause by contributing their skill sets to help define what the organization has become today and what it will be in the future. Due to its’ all inclusive nature, the team will always be growing to ensure the most comprehensive representation of every arts community and the ability of the organization to provide the best resources and opportunities for each of these communities.</p>
            </div>
        </div>
        <div class="portfolio_section">
            <div class="accordionButton">
                <span>More Information</span>
            </div>
            <div class="accordionContent accordion">
                <h3>Here are some of the resources you can expect from Flow Artz:</h3>
                <div id="resources">                  

                    <div class="element">
                        <p class="number">1</p>
                        <h2 class="name">Online Artist Profiles</h2>
                        <p class="description">These will be the equivalent to a digital resume that you can share with potential clients and friends that will layout your skills based on weather you are a student, performer or teacher in those skills.</p>
                    </div>

                    <div class="element">
                        <p class="number">2</p>
                        <h2 class="name">Talent Agency</h2>
                        <p class="description">This service will help connect clients to artists of all levels of skill to hire. With all artists in one place it will make it easier for event planners and clients to find and organize all the talent they desire in one location that fits with their budget.</p>
                    </div>

                    <div class="element">
                        <p class="number">3</p>
                        <h2 class="name">Career Tools</h2>
                        <p class="description">With a directory of digital artists available it will become cheaper and easier for artists to get important tools such as business cards, websites and demo videos developed.</p>
                    </div>

                    <div class="element">
                        <p class="number">4</p>
                        <h2 class="name">Workshop Services</h2>
                        <p class="description">Teachers will be able to organize, promote, manage students and collect payments through this service.</p>
                    </div>

                    <div class="element">
                        <p class="number">5</p>
                        <h2 class="name">The Academy</h2>
                        <p class="description">Teachers who like to teach via video will be able to develop, organize and distribute all their courses through this easy to use tool. It will be as easy as recording the video or media file and uploading it along with other relevant details and putting a desired price on the classes.</p>
                    </div>

                    <div class="element">
                        <p class="number">6</p>
                            <h2 class="name">Wiki-Art &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h2>
                            <p class="description">It will act as an encyclopedia of art that will be keeped up to date by the artists within every artistic field along with a comprehensive list of all the techniques and styles that can be learned within this art.</p>
                    </div>

                    <div class="element">
                        <p class="number">7</p>
                        <h2 class="name">Individual Artist Stores</h2>
                        <p class="description">Each artist will be permitted to have their own store to sell their art, products and services to the global community. They will also have the option to represent and distribute products for companies that they support.</p>

                    </div>

                    <div class="element">
                        <p class="number">8</p>
                        <h2 class="name">Barter / Exchange Services</h2>
                        <p class="description">Not everything has to be about money. This service will make it easier for artists to exchange products, services and skills without the use of money to build a more vibrant economy with increased exchange of art.</p>

                    </div>

                    <div class="element">
                        <p class="number">9</p>
                        <h2 class="name">Video Game Integration</h2>
                        <p class="description">Video games are fun! They are also a great way to track how you develop your skills and when you level up certain abilities. Its a great way to see how you compare with your peers and understand where your skills are in the grand scheme of learning a specific art.</p>

                    </div>

                    <div class="element">
                        <p class="number">10</p>
                        <h2 class="name">Rideshare / Couchsurfing</h2>
                        <p class="description">Artists are sociable people,  why wouldn’t we travel together and stay with like minded individuals when we are visiting other cities. This will make it much easier to take your passion on the road and share with other cities and countries around the world.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>template/js/jquery.easing.1.3.js"></script>
<script src="<?php echo base_url(); ?>template/js/jquery.isotope.min.js"></script>
<script src="<?php echo base_url(); ?>template/js/fake-element.js"></script>
<script type="text/javascript">

//$("#accordion .accordion:not(:first)").hide();
//
//$("#accordion .accordionButton").click(function(){
//
//    $accordion = $(this).next();
//
//    if ($accordion.is(':hidden') === true) {
//        $("#accordion .accordion").slideUp({ duration: 1000, easing: 'easeOutQuad'});
//        $accordion.slideDown({ duration: 1000, easing: 'easeInQuad'}, function(){
//    });
//        
//    } else {
//        $accordion.slideUp({ duration: 1000, easing: 'easeOutQuad'});
//    }
//});

$(function(){
    var $container = $('#resources');

    $container.isotope({
        itemSelector : '.element'
    });

    // change size of clicked element
    $container.delegate( '.element', 'click', function(){
        $(this).toggleClass('large');
        $container.isotope('reLayout');
    });
});
</script>