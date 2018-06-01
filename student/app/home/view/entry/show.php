<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
    <style>
        table td{
            color: #5e5e5e;
        }
    </style>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse" style="border-radius: 0">
    <div class="container">
        <a class="navbar-brand" href="index.php" >Student Manager</a>
    </div>
</nav>
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="index.php">返回</a></li>
			<li class="active"><?php echo $student['name']; ?></li>
		</ol>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo $student['name']; ?></h3>
			</div>
			<div class="panel-body" style="padding: 20px">
				<table class="table table-hover">
					<tr>
						<th>性别:<?php echo $student['sex']; ?></th>
						<td>
							
						</td>
					</tr>
					<tr>
						<th>年龄:<?php echo $student['age']; ?></th>
						<td>
							
						</td>
					</tr>
					<tr>
						<th>电话:<?php echo $student['cellphone']; ?></th>
						<td></td>
					</tr>
                    <tr>
                        <th>自我介绍:<?php echo $student['jieshao']; ?></th>
                        <td>
                            <a href=""></a>
                        </td>
                    </tr>
				</table>
			</div>
		</div>
	</div>

    <nav class="navbar navbar-inverse navbar-fixed-bottom">
        <div class="container">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="http://www.houdunwang.com">houdunwang.com</a></li>
                    <li><a href="http://www.nickblog.cn">nickblog.cn</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>

	</body>
</html>