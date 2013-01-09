<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="content">
	<div class="wrapper clearfix">
		<div class="book-talent">
                        <div id="contact-number"><span>1-888-368-0881</span></div>
			<form class="booktalent-form" id="booktalentForm" name="booktalentForm" method="post" action="<?php echo base_url(); ?>book_talent/">
                            <h3 class="center">Book Talent</h3>
                            <fieldset>
                                <legend><span>What type of entertainment would you like?</span></legend>
                                <div class="control">
                                    <label for="entertainment">Entertainment</label>
                                    <input type="text" name="book[entertainment]" id="entertainment" class="required"/>
                                </div>

                                <div class="control">
                                    <label for="budget">What is your budget for Entertainment?</label>
                                    <select type="budget" name="book[budget]" id="budget" class="required">
                                        <option value=""></option>
                                        <option value="$0-$250">$0-$250</option>
                                        <option value="$0-$250">$251-$750</option>
                                        <option value="$0-$250">$751-$1500</option>
                                        <option value="$0-$250">$1500-$3000</option>
                                        <option value="$0-$250">$3000</option>
                                    </select>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend><span>Tell us about your event.</span></legend>
                                <div class="control">
                                    <label>Event Type:</label>
                                    <?php
                                        $options = array(0 => "Anniversary Party", 1 => "Apres Ski Party", 2 => "Art Gallery Opening", 3 => "Awards Night Party", 4 => "Baby Shower", 5 => "Bachelor Party", 6 => "Bachelorette Party", 7 => "Banquet", 8 => "Bar Mitzvah", 9 => "Bat Mitzvah", 10 => "Birthday Party (Adults)", 11 => "Birthday Party (Children)", 12 => "Bridal Shower", 13 => "Casino Event", 14 => "Celebration", 15 => "Chinese New Year Party", 16 => "Christening", 17 => "Christmas Party", 18 => "Church Service", 19 => "Cinco De Mayo Party", 20 => "Club Event", 21 => "Cocktail Party", 22 => "Coffee Shop", 23 => "College Reunion", 24 => "Commitment Ceremony", 25 => "Community Event", 26 => "Concert", 27 => "Convention", 28 => "Corporate Function", 29 => "Country Club Event", 30 => "Cruise Ship Event", 31 => "Daytona 500 Party", 32 => "Dinner Dance", 33 => "Divorce Party", 34 => "Easter Celebration", 35 => "Election Day Party", 36 => "Engagement Party", 37 => "Event", 38 => "Family Reunion", 39 => "Father's Day Party", 40 => "Festival", 41 => "Fraternity Function", 42 => "Fundraiser", 43 => "Funeral", 44 => "Graduation Party", 45 => "Grand Opening", 46 => "Halloween Party", 47 => "Hanukkah Celebration", 48 => "Happy Hour", 49 => "High School Reunion", 50 => "Holiday Party", 51 => "Hotel Event", 52 => "Inauguration Party", 53 => "Jingle Party", 54 => "July 4th Party", 55 => "Kentucky Derby Party", 56 => "Labor Day Party", 57 => "Luau Party", 58 => "March Madness Party", 59 => "Mardi Gras Party", 60 => "Masters Golf Tournament Party", 61 => "Memorial Day Party", 62 => "Memorial Service", 63 => "Mother's Day Party", 64 => "Movie Soundtrack", 65 => "New Year's Eve Party", 66 => "Nursing Home Event", 67 => "Oktoberfest Party", 68 => "Oscar Party", 69 => "Picnic", 70 => "Private Party", 71 => "Prom", 72 => "Quinceañera", 73 => "Rehearsal Dinner", 74 => "Resort Event", 75 => "Restaurant Event", 76 => "Retirement Party", 77 => "Reunion", 78 => "Saint Patrick's Day Party", 79 => "School Assembly", 80 => "Sorority Function", 81 => "Studio Session", 82 => "Summer Olympics Party", 83 => "Super Bowl Party", 84 => "Sweet 16 Party", 85 => "Temple Service", 86 => "Thanksgiving Celebration", 87 => "Tour de France Party", 88 => "Trade Show", 89 => "TV Soundtrack", 90 => "Valentine's Day Party", 91 => "Veteran's Day Party", 92 => "Wedding", 93 => "Wedding Ceremony", 94 => "Wedding Cocktail Hour", 95 => "Wedding Reception", 96 => "Wine Tasting Party", 97 => "Winter Olympics Party", 98 => "World Cup Party");
                                    ?>
                                    <select name="book[event_type]" tabindex="10">
                                        <option value=""></option>
                                        <?php
                                        foreach ($options as $option):
                                            echo '<option value="'.$option.'">'.$option.'</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>

                                <div class="control">
                                    <label>Date Of Event:</label>
                                    <input type="text" name="book[date_of_event]" id="date_of_event" />
                                </div>

                                <div class="control">
                                    <?php
                                        $options = array(0 => "12:00 PM", 1 => "12:30 PM", 2 => "1:00 PM", 3 => "1:30 PM", 4 => "2:00 PM", 5 => "2:30 PM", 6 => "3:00 PM", 7 => "3:30 PM", 8 => "4:00 PM", 9 => "4:30 PM", 10 => "5:00 PM", 11 => "5:30 PM", 12 => "6:00 PM", 13 => "6:30 PM", 14 => "7:00 PM", 15 => "7:30 PM", 16 => "8:00 PM", 17 => "8:30 PM", 18 => "9:00 PM", 19 => "9:30 PM", 20 => "10:00 PM", 21 => "10:30 PM", 22 => "11:00 PM", 23 => "11:30 PM", 24 => "12:00 AM", 25 => "12:30 AM", 26 => "1:00 AM", 27 => "1:30 AM", 28 => "2:00 AM", 29 => "2:30 AM", 30 => "3:00 AM", 31 => "3:30 AM", 32 => "4:00 AM", 33 => "4:30 AM", 34 => "5:00 AM", 35 => "5:30 AM", 36 => "6:00 AM", 37 => "6:30 AM", 38 => "7:00 AM", 39 => "7:30 AM", 40 => "8:00 AM", 41 => "8:30 AM", 42 => "9:00 AM", 43 => "9:30 AM", 44 => "10:00 AM", 45 => "10:30 AM", 46 => "11:00 AM", 47 => "11:30 AM");
                                    ?>
                                    <label>Entertainment Start Time:</label>
                                    <select name="book[entertainment_start_time]" tabindex="10">
                                        <option value=""></option>
                                        <?php
                                        foreach ($options as $option):
                                            echo '<option value="'.$option.'">'.$option.'</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>

                                <div class="control">
                                    <?php
                                        $options = array(0 => "15 minutes", 1 => "30 minutes", 2 => "45 minutes", 3 => "1 hour", 4 => "1 1/2 hours", 5 => "2 hours", 6 => "2 1/2 hours", 7 => "3 hours", 8 => "3 1/2 hours", 9 => "4 hours", 10 => "4 1/2 hours", 11 => "5 hours", 12 => "5 1/2 hours", 13 => "6 hours", 14 => "6 1/2 hours", 15 => "7 hours", 16 => "7 1/2 hours", 17 => "8 hours", 18 => "8 1/2 hours", 19 => "9 hours", 20 => "9 1/2 hours", 21 => "10 hours", 22 => "10 1/2 hours", 23 => "11 hours", 24 => "11 1/2 hours", 25 => "12 hours", 26 => "12 1/2 hours");
                                   ?>
                                   <label>Length of entertainment:</label>
                                   <select name="book[length_of_entertainment]" tabindex="10">
                                       <option value=""></option>
                                       <?php
                                       foreach ($options as $option):
                                           echo '<option value="'.$option.'">'.$option.'</option>';
                                       endforeach;
                                       ?>
                                   </select>
                                </div>

                                <div class="control">
                                <label>Venue:</label>
                                <input type="text" name="book[venue]" id="venue" />
                                </div>

                                <div class="control">
                                <label>City & State:</label>
                                <input type="text" name="book[city_state]" id="city_state"  class="required"/>
                                </div>

                                <div class="control">
                                <?php
                                    $options = array(0 => "Fewer than 25", 1 => "25-49", 2 => "50-99", 3 => "100-199", 4 => "200-299", 5 => "300-499", 6 => "500 or more");
                                ?>
                                <label>Number of guests expected:</label>
                                <select name="book[num_of_guests_expected]" tabindex="10">
                                    <option value=""></option>
                                    <?php
                                    foreach ($options as $option):
                                        echo '<option value="'.$option.'">'.$option.'</option>';
                                    endforeach;
                                    ?>
                                </select>
                                </div>

                                <div class="control clear_both">
                                <label>Describe your event: <small>(be sure to include any special instructions)</small></label>
                                <textarea type="text" name="book[describe]" id="describe" cols="45" rows="10"/></textarea>
                                </div>

                            </fieldset>
                            <fieldset>
                                <legend><span>How can we reach you?</span></legend>

                                <div class="control">
                                <label>First Name:</label>
                                <input type="text" name="book[first_name]" id="first_name" />
                                </div>

                                <div class="control">
                                <label>Last Name:</label>
                                <input type="text" name="book[last_name]" id="last_name" />
                                </div>

                                <div class="control">
                                <label>Email Address:</label>
                                <input type="text" name="book[email_address]" id="email_address" />
                                </div>

                                <div class="control">
                                <label>Phone Number:</label>
                                <input type="text" name="book[phone_number]" id="phone_number" />
                                </div>


                                <div class="control">
                                <?php
                                    $options = array(0 => "Bride/Groom", 1 => "Friend/Relative of Bride/Groom", 2 => "Club/Restaurant Owner", 3 => "Professional Event Planner", 4 => "Talent Agent", 5 => "Wedding Coordinator", 6 => "Just Someone Throwing A Party", 7 => "Other");
                                ?>
                                <label>I am a:</label>
                                <select name="book[i_am_a]" tabindex="10">
                                    <option value=""></option>
                                    <?php
                                    foreach ($options as $option):
                                        echo '<option value="'.$option.'">'.$option.'</option>';
                                    endforeach;
                                    ?>
                                </select>
                                </div>

                                <div class="control clear_both">
                                    <label>&nbsp;</label>
                                    <input type="checkbox" value="1" name="book[newsletter]" id="newsletter" /> Yes, I want to receive FlowArtz' monthly newsletter.
                                </div>

                                <div class="control clear_both" style="margin-top: 40px;">
                                <a href="javascript:;;" class="button-link" id="bookTalentPost">Send</a>
                                </div>
                            </fieldset>

			</form>
		</div>
		<!-- end of signup div -->
	</div>
	<!-- end of content wrapper -->
</div>
<!-- end of content div -->
<script type="text/javascript">
var contact = {
    isValidEmailAddress : function(emailAddress){
        var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
        return pattern.test(emailAddress);
    },
    validate : function(){
        var error = 1;
        var hasError = false;

        $('#booktalentForm').find(':input:not(button)').each(function(){
            var $this 		= $(this);

            if($this.hasClass('required') && !$this.is(':disabled')){
                var valueLength = jQuery.trim($this.val()).length;

                if(valueLength == ''){
                    $this.css('background-color','#FFEDEF');
                    $this.focus();
                    hasError = true;
                }else{
                    $this.css('background-color','#FFFFFF');
                }
            }
        });

        if(contact.isValidEmailAddress($('#email_address').val()) == false){
            $('#email_address').css('background-color','#FFEDEF');
            $('#email_address').focus();
            hasError = true;
        }

        if(hasError){
            error = -1;
        }
        return error;
    }
}

$(function(){
    var btn = $('#bookTalentPost').click(function () {
        $this = $(this);
        noError = contact.validate();
        if(noError == 1){
            document.booktalentForm.submit();
        }
    });

    $( "#date_of_event" ).datepicker({ minDate: +1});
});
</script>