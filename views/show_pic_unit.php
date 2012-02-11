<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<? $this->load->helper(array('html')); ?>
<table  border="0">
	<tr>
		<? foreach ($k as $i): ?>
			<td style="width:200px" class="post_img2">
				<span class="post_name"><?=$i->name?></span><br />
				<span class="post_msg"><?=$i->msg?></span>
			</td>
		<? endforeach; ?>
    </tr>
	<tr>
		<? foreach ($k as $i): ?>
			<td style="width:200px" class="post_img2">
				<?
					$dir_name = pathinfo($i->pic, PATHINFO_DIRNAME);
					$file_name = pathinfo($i->pic, PATHINFO_FILENAME);
					$ext_name = pathinfo($i->pic, PATHINFO_EXTENSION);
					$pic2 = $file_name.'_s.'.$ext_name;
				?>
				<a href="<?=base_url('pic/'.$i->pic)?>" class="post_img_a">
					<img src="<?=base_url('pic/'.$pic2)?>" class="post_img" />
				</a>
			</td>
		<? endforeach; ?>
    </tr>
</table>