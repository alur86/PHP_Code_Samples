  <h2><?='Search:';?></h2>
<?=form_open('search');?>
<?php $search = array('name'=>'title','id'=>'title','value'=>'');?>
<?=form_input($search);?>
<input type=submit value='Search'/>
</p>
<?=form_close();?>
