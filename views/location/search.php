<?php
$this->load->helper('form');

$selectState = (isset($user_data['state'])) ? $user_data['state'] : '';
$state_option = '<option value="">--</option>';
foreach ($states as $state):
    $iso3 = $country_iso3[$state->country_id];
    $state_option .= '<option value="' . $state->alias . '" class="' . $iso3 . '">' . $state->name . '</option>';
endforeach;

$selectCity = (isset($user_data['city'])) ? $user_data['city'] : '';
$city_option = '<option value="">--</option>';
foreach ($cities as $city):
    $alias = $state_alias[$city->state_id];
    $city_option .= '<option value="' . $city->id . '" class="' . $alias . '">' . $city->name . '</option>';
endforeach;
?>
<div id="locationPopup" style="max-width: 600px;">
    <table>
        <thead>
            <tr>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo form_dropdown('search[country]', $countries, '', 'id="selectCountry"') . "&nbsp;"; ?></td>
                <td>
                    <select name="search[state]" id="selectState">
                        <?php echo $state_option; ?>
                    </select>
                </td>
                <td>
                    <select name="search[city]" id="selectCity">
                        <?php echo $city_option; ?>
                    </select>
                </td>
                <td><a id="getLocation" class="btn btn-red" href="javascript:;;">Select</a></td>
            </tr>            
        </tbody>
    </table>
</div>

<script type="text/javascript" charset="utf-8">
    $(function() {    
        /* For jquery.chained.js */
        $("#selectState").chained("#selectCountry");
        $("#selectCity").chained("#selectState"); 
            
        $('#getLocation').bind('click', function(){
            //$country = $("#selectCountry option:selected").text();
            //$state = $("#selectState option:selected").text();
            $city = $("#selectCity option:selected").text();
            $cityID = $("#selectCity").val();
            
            $city = (parseInt($cityID) > 0) ? $city : 'Find By Location'
            $('#locationSelector').html($city);
            //$('#location-name').find('.tooltip').html($city+","+$state+","+$country);
            $('#location-name').find('.tooltip').html($city);
            $('#search-location').val($cityID);
            jQuery.fancybox.close();
        });
    });
</script> 
