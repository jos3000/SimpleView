<html>
    <head>
        <title><?php echo $this->retrieve('title'); ?></title>
    </head>
    <body>
        <div id="header"><h1><?php echo $this->retrieve('title'); ?></div>
    
        <div id="content"><?php echo $this->retrieve('content'); ?></div>

        <div id="sidebar"><?php echo $this->retrieve('sidebar'); ?></div>

</html>
