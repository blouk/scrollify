<html>
  <head>
    <title>Scrollify</title>
    <link href='http://fonts.googleapis.com/css?family=Muli:400,300italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
    <body>
    <h1>Scrollify</h1>
    <h2>Upload your video</h2>
    <form id="scrollify_upload_video_form" method="post" enctype="multipart/form-data">
      <input type="file" name="scrollify_video" id="scrollify_video_input"/>
    </form>
    <button id="scrollify_btn_upload">Upload</button>
    <div id="result_img"></div>
    <script src="js/lib/jquery-1.10.1.min.js"></script>
    <script src="js/scrollify.js"></script>
  </body>
</html>
