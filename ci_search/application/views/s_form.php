
 <?php echo validation_errors(); ?>
<?=form_open('s_engine/search');?>
 <?php echo "Search:" ?>
<?php $search = array('name'=>'title','id'=>'title','value'=>'');?>
<?=form_input($search);?>
<input type=submit value='Search'/>
</p>
<?=form_close();?>

