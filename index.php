<?php include 'header.php'; ?>

	<h1 class="banner">Welcome to the Juice Shop!</h1>

	<div class="image-container">
		<img alt="My Logo" src="/images/my_logo.jpg" width="400" />
        <div class="text-overlay">
            <p>We have delicious juice for everyone!</p>
        </div>
		<img alt="Juice" src="/images/drinking.jpg" width="600" />
		<img alt="My Logo" src="/images/my_logo.jpg" width="400" />
	</div>

	<p>Thanks for stopping by the Juice Shop! If you're a returning customer, <a href="/admin/login.php">login here</a>.</p>
	<p>This site is sponsored by <a href="https://www.wctc.edu">www.wctc.edu</a></p>
</body>
</html>

<style>
	.image-container {
		display: flex;
		justify-content: space-between;
		margin-top: 15px;
        position: relative;
	}
    .text-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.8);
    }
    .text-overlay p {
        margin: 0;
        font-size: 36px;
        font-weight: bold;
        color: white;
        text-shadow: 2px 2px 4px #000000;
        text-align: center;
    }
</style>
