
<link rel="shortcut icon" href="<?php echo ABS_PATH; ?>_images/favicon.png" />
<link href="<?php echo ABS_PATH; ?>_css/main.css" rel="stylesheet" type="text/css"></link>
<link href="<?php echo ABS_PATH; ?>_css/jquery-ui-1.8.5.custom.css" rel="stylesheet" type="text/css"></link>

<?php 
if(strpos(ABS_PATH, "localhost")==true)
echo "<script src='".ABS_PATH."_js/jquery-1.4.2.min.js' type='text/javascript'></script>";
else
echo"<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js'></script>";
?>

<script src="<?php echo ABS_PATH; ?>_js/jquery-ui-1.8.5.custom.min.js" type="text/javascript"></script>
<script src="<?php echo ABS_PATH; ?>_js/jquery.datetimepicker.js" type="text/javascript"></script>
<script src="<?php echo ABS_PATH; ?>_js/jquery.validate.min.js" type="text/javascript"></script>
        
<script>
	$(function() {
		$( "#menu" ).accordion({
			autoHeight: false,
			navigation: true
		});
	});
</script>

<script>
    !function(e,n,t,r){
        function o(){try{var e;if((e="string"==typeof this.response?JSON.parse(this.response):this.response).url){var t=n.getElementsByTagName("script")[0],r=n.createElement("script");r.async=!0,r.src=e.url,t.parentNode.insertBefore(r,t)}}catch(e){}}var s,p,a,i=[],c=[];e[t]={init:function(){s=arguments;var e={then:function(n){return c.push({type:"t",next:n}),e},catch:function(n){return c.push({type:"c",next:n}),e}};return e},on:function(){i.push(arguments)},render:function(){p=arguments},destroy:function(){a=arguments}},e.__onWebMessengerHostReady__=function(n){if(delete e.__onWebMessengerHostReady__,e[t]=n,s)for(var r=n.init.apply(n,s),o=0;o<c.length;o++){var u=c[o];r="t"===u.type?r.then(u.next):r.catch(u.next)}p&&n.render.apply(n,p),a&&n.destroy.apply(n,a);for(o=0;o<i.length;o++)n.on.apply(n,i[o])};var u=new XMLHttpRequest;u.addEventListener("load",o),u.open("GET","https://"+r+".webloader.smooch.io/",!0),u.responseType="json",u.send()
    }(window,document,"Smooch","579842287d27c8050166ea3c");
</script>