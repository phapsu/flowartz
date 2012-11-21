<?php
$this->load->helper('form');
$selectCountry = (isset($user_data['country'])) ? $user_data['country'] : '';
echo form_dropdown('fac_profile[country]', $countries, $selectCountry, 'id="selectCountry"')."&nbsp;";


$selectState = (isset($user_data['state'])) ? $user_data['state'] : '';
$option = '<option value="">--</option>';
foreach($states as $state):
    $iso3 = $country_iso3[$state->country_id];
    $selected = ($state->alias == $selectState) ? 'selected="selected"' : '';
    $option .= '<option '.$selected.' value="'.$state->alias.'" class="'.$iso3.'">'.$state->name.'</option>';
endforeach;
?>
<select name="fac_profile[state]" id="selectState">
    <?php echo $option;?>
</select>
&nbsp;

<?php
$selectCity = (isset($user_data['city'])) ? $user_data['city'] : '';
$option = '<option value="">--</option>';
foreach($cities as $city): 
    $alias = $state_alias[$city->state_id];
    $selected = ($city->id == $selectCity) ? 'selected="selected"' : '';
    $option .= '<option '.$selected.' value="'.$city->id.'" class="'.$alias.'">'.$city->name.'</option>';
endforeach;
?>
<select name="fac_profile[city]" id="selectCity">
    <?php echo $option;?>
</select>