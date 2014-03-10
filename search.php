 <?php include_once 'header.php'; ?>
 <title>MobiDev GitHub Browser - Search</title>
</head>
<body>
   <div class="wrapper">
      <div class="header">
	 <div class="breadcrump-list">
	    <a href="/">MobiDev GitHub Browser</a> >> Search
	 </div>
	 <div class="search-form-block">
	    <form name="search" action="search.php" method="get">
	       <input placeholder="Search" type="text" name="q" value="<?php echo !empty($search) ? $search : ''; ?>"> <br>
	    </form>
	 </div>
      </div>
      <div class="content">
	    <?php if(isset($searchRepos['repositories']) and count($searchRepos['repositories']) > 0): ?>
        <p class="head-line">For search item "<?php echo $search; ?>" found</p>
            <?php foreach($searchRepos['repositories'] as $repo): ?>
            <?php
                $repItem = $client->api('repo')->show($repo['username'], $repo['name']);
                $pdo = Database::connect();
                $liked = Database::isLaked('repo', $repItem['id']);
            ?>
            <?php $getParams = '?user=' . $repo['username'] . '&repo=' . $repo['name']?>
            <div class="search-repo">
                <div class="search-repo-headerinfo">
                    <a class="search-repo-name" href="/<?php echo $getParams; ?>"><?php echo $repo['name']; ?></a>
                    <br />
                    <span>homepage:<span>
                    <?php if(!empty($repo['homepage'])): ?>
                        <a class="search-repo-homepage" href="<?php echo $repo['homepage']; ?>"><?php echo $repo['homepage']; ?></a>
                    <?php else: ?>
                         <span>-<span>
                    <?php endif; ?>
                    <br />
                    <span>owner:<span>
                    <a class="search-repo-owner" href="user.php?user=<?php echo $repo['username']; ?>"><?php echo $repo['username']; ?></a>
                </div>
                <div class="search-repo-description">
                    <p><?php echo $repo['description'] ? $repo['description'] : 'No Description'; ?></p>
                </div>
                <div class="clear"></div>
                <div class="search-repo-infom-block">
                    <span class="search-repo-watchers">Watchers: <?php echo $repo['watchers'] ? $repo['watchers'] : 'No watchers'; ?></span>
                    <span class="search-repo-forks">forks: <?php echo $repo['forks'] ? $repo['forks'] : 'No forks'; ?></span>
                </div>
                
                <?php if(!$liked): ?>
                    <a id="repo_like_<?php echo $repItem['id']; ?>" class ="like" href="javascript:void(0);">Like</a>
                <?php else: ?>
                    <a id="repo_unlike_<?php echo $repItem['id']; ?>" class ="like" href="javascript:void(0);">UnLike</a>
                <?php endif; ?>
                
            </div>    
		  
            <?php endforeach; ?>
	    <?php else: ?>
	       <p class="error-message">There are no repositories in search result!</p>
	    <?php endif; ?>
	 </div>
      </div>
   </div>
</body>
</html>