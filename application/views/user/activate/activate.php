<div class="content">
	<div class="wrapper clearfix">
		<div class="activate">
			<h3 class="center">Flow Artz Account Activation</h3>
			<form class="fa-form" method="post" action="<?php echo base_url(); ?>user/activate/<?php echo $token; ?>">
				<?php /*?>
<select type="text" name="fac_activate[question]" id="question">
					<?php foreach($questions as $question): ?>
						<option><?php echo $question; ?></option>
					<?php endforeach; ?>
				</select>
<?php */?>
				<label for="question">Write a Security Question</label>
				<input type="text" name="fac_activate[question]" id="question" />
				<label for="answer">Answer</label>
				<input type="text" name="fac_activate[answer]" id="answer" />
				<input type="submit" name="submit" id="submit" value="Activate" />
			</form>
		</div>
		<!-- end of activate div -->
	</div>
	<!-- end of content wrapper -->
</div>
<!-- end of content div -->