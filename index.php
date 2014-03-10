 <?php include_once 'header.php'; ?>
 <title>MobiDev GitHub Browser - Main Page</title>
</head>
<body>
   <div class="wrapper">
      <div class="header">
	 <div class="breadcrump-list">
	    <a href="/">MobiDev GitHub Browser</a> >> Main
	 </div>
	 <div class="search-form-block">
	    <form name="search" action="search.php" method="get">
	       <input placeholder="Search" type="text" name="q"> <br>
	    </form>
	 </div>
      </div>
      <div class="content">
	 <div class="left-side">
	    <?php if(!empty($repository)): ?>
	       <p class="head-line"><?php echo $repository['full_name']; ?></p>
	       <p>
		  <span class="title-repo">Description:</span>
		  <span class="content-repo">
		     <?php echo $repository['description'] ? $repository['description'] : '-'; ?>
		  </span>
	       </p>
	       <div class="clear"></div>
	       <p>
		  <span class="title-repo">watchers:</span>
		  <span class="content-repo">
		     <?php echo $repository['watchers_count'] ? $repository['watchers_count'] : $repository['watchers_count']; ?>
		  </span>
	       </p>
	       <p>
		  <span class="title-repo">forks:</span>
		  <span class="content-repo">
		     <?php echo $repository['forks_count'] ? $repository['forks_count'] : '-'; ?>
		  </span>
	       </p>
	       <p>
		  <span class="title-repo">open issues:</span>
		  <span class="content-repo">
		     <?php echo $repository['open_issues_count'] ? $repository['open_issues_count'] : '-'; ?>
		  </span>
	       </p>
	       <p>
		  <span class="title-repo">homepage:</span>
		  <span class="content-repo">
			   <?php if(!empty($repo['homepage'])): ?>
			   <a href="<?php echo $repo['homepage']; ?>"><?php echo $repo['homepage']; ?></a>
			   <?php else: ?>
				  <span>-<span>
			   <?php endif; ?>
		  </span>
	       </p>
	       <p>
		  <span class="title-repo">GitHub repo:</span>
		  <span class="content-repo"><a href="<?php echo $repository['html_url']; ?>"><?php echo $repository['html_url']; ?></a></span>
	       </p>
	       <p>
		  <span class="title-repo">created at:</span>
		  <span class="content-repo"><?php echo $repository['created_at']; ?></span>
	       </p>
	    <?php else: ?>
	       <p class="error-message">There are no repositories!</p>  
	    <?php endif; ?>
	    
	 </div>
	 <div class="right-side">
	    <p class="head-line">Contributors</p>
	    <?php if(count($contributors) > 0): ?>
	       <?php foreach($contributors as $user): ?>
		  <?php
		     $pdo = Database::connect();
		     $liked = Database::isLaked('user', $user['id']);
		  ?>
		  <p>
		     <a class="user-login" href="user.php?user=<?php echo $user['login']; ?>"><?php echo $user['login']; ?></a>
		     <?php if(!$liked): ?>
                  <a id="user_like_<?php echo $user['id']; ?>" class ="like" href="javascript:void(0);">Like</a>
		     <?php else: ?>
                  <a id="user_unlike_<?php echo $user['id']; ?>" class ="like" href="javascript:void(0);">UnLike</a>
		     <?php endif; ?>
		  </p>
	       <?php endforeach; ?>
	    <?php else: ?>
	       <p class="error-message">There are no contributors in this repository!</p>
	    <?php endif; ?>
	    
	 </div>
      </div>
   </div>
</body>
</html>