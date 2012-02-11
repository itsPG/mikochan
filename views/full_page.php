<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<? foreach ($query as $i): ?>
	<span class="push_name">
		<?=$i->name?></span>：<span class="push_msg"><?=$i->msg?><br />
	</span>
<? endforeach; ?>