<!DOCTYPE html>
<html>
<head>
   <meta charset=utf-8 />
   <title>LeoPlay</title>
   <link href="https://vjs.zencdn.net/7.8.3/video-js.css" rel="stylesheet">
   <script src="https://vjs.zencdn.net/7.8.3/video.js"></script>
   <script src="https://unpkg.com/@silvermine/videojs-quality-selector@1.2.4/dist/js/silvermine-videojs-quality-selector.min.js"></script>
   <link href="https://unpkg.com/@silvermine/videojs-quality-selector@1.2.4/dist/css/quality-selector.css" rel="stylesheet">
</head>
<body>
   <video id="LeoPlay" class="video-js vjs-default-skin" controls preload="auto" data-setup='{"fluid": true}'>
<?=$sources?>
   </video>

   <script>
      videojs("LeoPlay", {}, function() {
         var player = this;
         player.controlBar.addChild('QualitySelector');
      });
   </script>

</body>
</html>