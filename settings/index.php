<?php 
	require_once("../header_adv.php");

	require_once '../topBar.php';

?>

<style>

#settingsMenu
{
	border-right:1px solid black;
}

.settingsMenuButton:hover
{
	background-color:#fcfcfc;
	cursor:pointer;
}



</style>


<div class="container">

	<div class="row">

		<div id="settingsMenu" class="col-md-3 text-right">

			<p class="settingsMenuButton" id="alternateName">Alternate name</p>

			<p class="settingsMenuButton" id="alternateEmail">Alternate Email</p>

			<p class="settingsMenuButton" id="profilePicture">Profile picture</p>

			<p class="settingsMenuButton" id="changePassword">Change password</p>

		</div>

		<div class="col-md-9">

			<div class="row" id="alternateName">

				<div class="col-md-12">

					<form>

						Alternate Name: <input class="form-control input-sm" type="text" id="alternateNameInput" placeholder="Your display name" required>

						<button class="btn btn-sm btn-default" onclick="sendAlternateName();">Submit</button>

					</form>

				</div>

			</div>

			<div class="row" id="alternateEmail">

				<div class="col-md-12">

					<form>

						Alternate Email: <input class="form-control input-sm" type="email" id="alternateEmailInput" placeholder="Your alternate email" required>

						<button class="btn btn-sm btn-default" onclick="sendAlternateEmail();">Submit</button>

					</form>

				</div>

			</div>

			<div class="row" id="profilePicture">

				<div class="col-md-12">

					<form>

						Profile picture: <input class="form-control input-sm" type="file" id="profilePictureInput">

						<button class="btn btn-sm btn-default" onclick="sendProfilePicture();">Submit</button>

					</form>

				</div>

			</div>

			<div class="row" id="alternateEmail">

				<div class="col-md-12">

					<form>

						Alternate Name: <input class="form-control input-sm" id="alternateNameInput" placeholder="Your display name">

						<button class="btn btn-sm btn-default" onclick="sendAlternateName();">Submit</button>

					</form>

				</div>

			</div>



		</div>

	</div>

</div>