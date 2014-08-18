<?php
	include '../init.php';
	$page = ($_GET['page'] == null) ? 1 : $_GET['page'];
	$size = ($_GET['size'] == null) ? 5 : $_GET['size'];
	
	$userService = Factory::getInstance("UserService");
	$userlist = $userService->findUserList($page, $size);
	$count = $userService->countUserList();
	$pageCount = ($count % $size == 0) ? $count / $size : floor($count / $size) + 1; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<title>book list</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
#tb table {
	margin: 0px auto;
}
</style>
</head>
<body>
	<div id="tb">
		<table border="1px">
			<tbody>
				<tr>
					<th>id</th>
					<th>username</th>
					<th>password</th>
					<th>sex</th>
					<th>birthday</th>
					<th>profession</th>
					<th>view</th>
				</tr>
    			<?php 
    				foreach ($userlist as $user){
						?>
					<tr>
					<td><?php echo $user->id; ?></td>
					<td><?php echo $user->username; ?></td>
					<td><?php echo $user->password; ?></td>
					<td><?php echo $user->sex; ?></td>
					<td><?php echo $user->birthday; ?></td>
					<td><?php echo $user->profession; ?></td>
					<td><a href="javascript:;" <?php echo "onclick='javascript:getContent($user->id);'";?>>查看</a></td>
					</tr>
				<?php 
					}
						?>
    		</tbody>
		</table>
		<div>
    			<?php if($page>1){ echo '<a href="?page=' . ($page - 1) . '&size=' . $size . '">' . '上一页</a>'; } ?>
    			第<?php echo $page; ?>页   共<?php echo $pageCount; ?>页
    			<?php if($page<$pageCount){ echo '<a href="?page=' . ($page + 1) . '&size=' . $size . '">' . '下一页</a>'; } ?>
    	</div>
	</div>
	<br />
	<div id="content">
	</div>
</body>
</html>
<script type="text/javascript">
	function getContent(id){
		if(window.ActiveXObject) //如果这个对象存在就是IE浏览器，如果不是就不是IE的
	    { 
		    xmlHttpRequest = new ActiveXObject("Microsoft.XMLHTTP"); 
	    }
	    else if(window.XMLHttpRequest)  //除IE外的其他浏览器实现
	    {
	        xmlHttpRequest = new XMLHttpRequest();
	    }
	    if(null != xmlHttpRequest){
	        xmlHttpRequest.open("POST","UserDetail.php",true);
            xmlHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            xmlHttpRequest.onreadystatechange = function(){
        		if(xmlHttpRequest.readyState == 4) //状态4：处理完了响应也来了
        	    {
        	         if(xmlHttpRequest.status == 200) //服务端运行正常响应
        	         {
            	        
        		        var ct = document.getElementById("content");
        		        var rst = eval("("+xmlHttpRequest.responseText+")" );
        		        ct.innerHTML = ('id = ' + rst.data.id + ' username = ' + rst.data.username + ' profession = ' + rst.data.profession );
        	         }
        	    }
            }
            var param = '{"id":'+ id +'}';
            xmlHttpRequest.send(param);
	    }
	}
</script>