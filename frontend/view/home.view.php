<?php 

require('../template/header.html');
require('../template/footer.html');

?>

<div class="container">
	<div class="main-content">
		<div class="row">
			<div class="col-md-8 column1">
				<h2 class="search_title">Search Please?</h2>
				<form class="form-group" method="post" action="../controller/home.php">
					<input class="form-control form-control-lg" type="text" placeholder="What will you be searching for today?" name="search">
				</form>
			</div>
			<div class="col-md-4 column2">
				<div class="profile">
					<h1><span id="username"><?php echo $_SESSION['username']; ?></span></h1>
					<span class="name"><?php echo $_SESSION['firstname'] . ' ' .$_SESSION['lastname']; ?></span>

					<!--Log Out-->
					<form method="post" action="../controller/home.php">
						<input type="submit" class="logout btn btn-outline-danger btn-sm" name='logout' value="Log out">
					</form>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 column1">
				<h2 id="activity_title">Activity Feed</h2>
				<?php foreach (activity_show() as $key => $message) : ?>
					<p class="activity_feed"><?php echo $message['user_name'] . " " . $message['activity'] . " " .$message['object']; ?></p>
				<?php endforeach; ?>
			</div>
			<div class="col-md-4 column2">
				<div class="row">
					<?php if (empty(friends_show($_SESSION['id']))) : ?>
					<div class="col-md-12 friends_list">
						<h2><span id="friends">Friends List</span></h2>
						<h3>User has no friends...</h3>
					</div>
					<?php else: ?>
					<div class="col-md-12 friends_list">
						<h2><span id="friends">Friends List</span></h2>
						<?php foreach (friends_show($_SESSION['id']) as $friend => $name) : ?>			
							<div class="row">
								<div class="col-md-6 friends-name">
									<form method="POST" action="../controller/friends_profile.php">
										<input type="hidden"  class="name" name="friends_id" value="<?php echo $name['id']; ?>">
										<input type="hidden" class="name" name="friends_username" value="<?php echo $name['username']; ?>">
										<input type="hidden" class="name" name="friends_firstname" value="<?php echo $name['firstname']; ?>">
										<input type="hidden" class="name" name="friends_lastname" value="<?php echo $name['lastname']; ?>">
										<button type="submit" class="btn btn-outline-success" role="button" value="friends_name"><?php echo $name['username']; ?></button>
									</form>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="row">
					<div class="col-md-12 user_search">
						<form class="form-group" method="POST" action="../controller/home.php">
							<input class="form-control form-control-lg" type="text" placeholder="Search for people" name="user_search">
							<input class="btn btn-default my-2 my-sm-2" type="submit" value="Search">
						</form>
					</div>
				</div>
				<?php if (empty(beer_show($_SESSION['id']))) : ?>
				<div class="row">
					<div class="col-md-12 favorite_list">
						<h2><span id="favorite">Favorite List</span></h2>			
						<h3>User doesn't like beers.....</h3>
					</div>
				</div>
				<?php else : ?>
				<div class="row">
					<div class="col-md-12 favorite_list">
						<h2><span id="favorite">Favorite List</span></h2>
						<div class="row">
							<div class="col-md-6">
							<?php foreach (beer_show($_SESSION['id']) as $beers => $name) : ?>	
								<form method="POST" action="../controller/home.php">
									<input type="hidden"  name="beer_name" value="<?php echo $name['beer_name']; ?>">
									<button type="submit" class="btn btn-outline-success beer_name" role="button"><?php echo $name['beer_name']; ?></button>
								</form>
							<?php endforeach; ?>
							</div>
							<div class="col-md-6">
							<?php foreach (beer_show($_SESSION['id']) as $beers => $name) : ?>	
								<form method="POST" action="../controller/beer_remove.php">
									<input type="hidden"  name="beer_remove" value="<?php echo $name['beer_name']; ?>">
									<input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
									<button type="submit" class="btn btn-outline-danger beer_name" role="button">Delete</button>
								</form>
							<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
