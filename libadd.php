<?php
  if(!isset($_SESSION)) session_start();
  require_once "dao.php";
  $dao = new Dao();
?>

<?php $thisPage = 'Add'; ?>

<?php require_once("php_includes/header.php"); ?>

<body>
		<div class="bodysection" id="sec1">
			<h1>Add a Book to our Collection!</h1>
			<h3>Use this form to add a new book (or more copies of an existing book).</h3>
			<h4>You may send copies to any of the available library branches listed in the menu below.</h4>
    </div>

		<div id="form-wrapper">
				<form class="centerForm" action="handler_add.php" method="post">

					<h1 class="formTitle">Add a Book</h1>
					<h3>Please enter a value for each item.</h3>

					<fieldset>

						<label class="labelTitle" for="title">Title:</label>
						<input type="text" id="title" name="title" required autofocus maxlength="255">

						<label class="labelTitle" for="author">Author:</label>
						<input type="text" id="author" name="author" required maxlength="255">

						<label class="labelTitle" for="publisher">Select a Publisher:</label>
						<select id="dayPicker" name="publisher" required>
						<?php
							$publishers = $dao->getPublishers();
							foreach($publishers as $p){ ?>
						     	<option value="<?=$p["PubId"]?>"><?=$p["PubName"]?></option>;
						<?php } ?>
						</select>

						<label class="labelTitle" for="branch">Select a Branch:</label>
						<select id="dayPicker" name="branch" required>
						<?php
							$branches = $dao->getBranches();
							foreach($branches as $b){ ?>
						     	<option value="<?=$b['BranchId']?>"><?=$b['BranchName']?></option>
						<?php } ?>
						</select>

						<label class="labelTitle" for="copies"># Copies for this Branch:</label>
						<input type="number" id="copies" name="copies" required min="1">

					</fieldset>
					<button type="submit" name="Button_Pressed">Submit</button>
				</form>
		</div>
</body>

<?php require_once("php_includes/footer.php"); ?>
