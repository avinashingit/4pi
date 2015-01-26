<?php
require_once('../header_adv.php');
require_once('../topbar.php');
?>

<div class="row">

	<div class="col-md-6 col-md-offset-3">

		<form>

			<div class="row">

				<div class="col-md-3 text-center">

					<label for="alias">Alternate name&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="It is basically your display name."></i>]</label>

				</div>

				<div class="col-md-9 text-center">

					<input class="form-control" id="alias">

				</div>

			</div>

			<div class="row">

				<div class="col-md-3 text-center">

					<label for="alias">Alternate email&nbsp;&nbsp;[<i class="fa fa-question popOver" data-trigger="hover click" data-toggle="popover" data-content="Alternate email id. You can only email posts to one of the two emails id's you give to the bot."></i>]</label>

				</div>

				<div class="col-md-9 text-center">

					<input class="form-control" id="alternateEmail">

				</div>

			</div>

			<button class="btn btn-primary btn-md" onclick="settingsFormSubmit();">Submit</button>


		</form>


	</div>

</div>