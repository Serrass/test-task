<?php include_once 'header.php'; ?>
<title>MobiDev GitHub Browser - User Profile</title>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="breadcrump-list">
                <a href="/">MobiDev GitHub Browser</a> >> User
            </div>
        </div>
        <div class="search-form-block">
            <form name="search" action="search.php" method="get">
               <input placeholder="Search" type="text" name="q" value="<?php echo !empty($search) ? $search : ''; ?>"> <br>
            </form>
        </div>
        <div class="content">
            <?php if(!empty($user)): ?>
            <?php
                $pdo = Database::connect();
                $liked = Database::isLaked('user', $user['id']);
            ?>
            <div class="user-block-info">
                <div class="user-avatar">
                    <img src="<?php echo $user['avatar_url']; ?>" />
                    <?php if(!$liked): ?>
                        <a id="user_like_<?php echo $user['id']; ?>" class ="like" href="javascript:void(0);">Like</a>
                    <?php else: ?>
                        <a id="user_unlike_<?php echo $user['id']; ?>" class ="like" href="javascript:void(0);">UnLike</a>
                    <?php endif; ?>
                </div>
                <div class="user-block">
                    <p class="head-line"><?php echo $user['name']; ?></p>
                    <p class="profile-user-name">
                        <span><?php echo $user['login']; ?></span>
                    </p>
                    <p>
                        <span  class="title-repo">Company:</span>
                        <span><?php echo $user['company'] ? $user['company'] : '- <br />'; ?></span>
                    </p>
                    <p>
                        <span  class="title-repo">Blog:</span>
                        <span>
                            <?php $link = $user['blog'] ? $user['blog'] : ''; ?>
                            <a href="<?php echo $link; ?>"><?php echo $user['blog'] ? $user['blog'] : '- <br />';?></a>
                        </span>
                    </p>
                    <p>
                        <span  class="title-repo">Followers:</span>
                        <span><?php echo $user['followers'] ? $user['followers'] : '- <br />';; ?></span>
                    </p>
                </div>
                
            </div>
            <?php else: ?>
                <p class="error-message">User not found!</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>