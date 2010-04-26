Title of page
<?php $this->store('title'); ?>

<ul>
    <li><?php echo $_['example1'];?></li>
    <li><?php echo $_['example2'];?></li>
</ul>

<?php echo $this->include('inner_1'); ?>

<?php $this->store('body'); ?>

Sidebar text

<?php $this->store('sidebar'); ?>

<?php echo $this->include('layout_1'); ?>
