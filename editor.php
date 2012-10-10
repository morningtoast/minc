<? include_once("minc_setup.php"); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>MINC - Mini CMS</title>
	<meta name="description" content="MINC - Mini CMS Manager for Custom Applications">
	<meta name="viewport" content="width=device-width">
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/css/bootstrap-combined.min.css" rel="stylesheet">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" /></script>
	<script type="text/javascript" src="minc.js" /></script>
	<style>
		textarea#content { font-family:courier,arial,helvetica,sans-serif; }
	</style>
</head>
<body>
	<div class="span10">
		<h1>MINC <small>Mini CMS for Custom Applications</small></h1>
		<p>
			<a href="https://github.com/morningtoast/minc">More details on Github</a>
		</p>
		<form method="post" action="editor.php">
			<label>Slug</label>
			<input type="text" id="contentid" name="contentid" size="25" class="span2"/>
			
			<label>Summary</label>
			<input type="text" id="contentsummary" name="contentsummary" size="30" class="span5" />

			<label>Content - <em>HTML allowed</em></label>
			<textarea id="content" name="content" rows="15" cols="50" class="span6"></textarea>
			<p>
				<input type="submit" name="save" value="Save changes" class="btn btn-primary" /> <a href="editor.php">Reset form</a>
			</p>
		</form>
		<hr />
		<h3>MINC Blocks</h3>
		<? foreach ($minc->list as $a_item) { ?>
		<div>
			<a href="#" data-id="<?= $a_item["id"]; ?>" onclick="preview(this);"><i class="icon-pencil"></i> <strong><?= $a_item["id"]; ?></strong></a> - <?= $a_item["summary"]; ?>
			
			<pre>&lt;? $minc->load("<?= $a_item["id"]; ?>"); ?></pre>
			<p align="right"><a href="editor.php?k=<?= $a_item["id"]; ?>"><i class="icon-trash"></i> Delete</a></p>

		</div>
		<? } ?>
	</div>
</body>
</html>	