<?php
		$this->load_langfile('inside/global.php');
	$this->load_langfile('inside/admin.php');
	$this->load_template('header.php');
	
?>

						<div id="settings">
						<div id="settings_left">
							<?php $this->load_template('admin_leftmenu.php') ?>
						</div>
						<div id="settings_right">
							<div class="ttl">
								<div class="ttl2">
									<h3>دسته ها</h3>
								</div>
							</div>
					<? if($D->error){?>
						<?= errorbox('خطا',$D->error_msg)?>
						<?}?>
							<? if($D->submit){?>
						<?= okbox('انجام شد',$D->submit_msg)?>
						<?}?>
							<div class="greygrad" style="margin-top:5px;">
								<div class="greygrad2">
									<div class="greygrad3" style="padding-top:0px;">
									<?if($D->tab == 'add'){?>
								<script type="text/javascript">
			inv_lines	= 0;
			function invform_line_add() {
				var tb	= d.getElementById("invite_table");
				if( !tb ){ return; }
				var tr	= tb.getElementsByTagName("TR");
				if( !tr || tr.length == 0 ) { return; }
				tr	= tr[0];
				tr	= tr.cloneNode(true);
				var i;
				var inp	= tr.getElementsByTagName("INPUT");
				for(i=0; i<inp.length; i++) {
					inp[i].value	= "";
				}
				inp	= tr.getElementsByTagName("SELECT");
				for(i=0; i<inp.length; i++) {
					inp[i].selectedIndex	= 0;
				}
				tb.appendChild(tr);
				inv_lines	++;
			}
			function invform_line_del(confirm_msg) {
				if( inv_lines <= 1 ) { return; }
				var tb	= d.getElementById("invite_table");
				if( !tb ){ return; }
				var tr	= tb.getElementsByTagName("TR");
				if( !tr || tr.length == 0 ) { return; }
				var i, inp;
				for(i=tr.length-1; i>=0; i--) {
					inp	= tr[i].getElementsByTagName("INPUT");
					if(inp.length==2 && inp[0].value=="" && inp[1].value=="") {
						tb.removeChild(tr[i]);
						inv_lines	--;
						return;
					}
				}
				if(confirm_msg && !confirm(confirm_msg)) {
					return;
				}
				tb.removeChild(tr[tr.length-1]);
				inv_lines	--;
			}
		</script>
		<script type="text/javascript">
									inv_lines ++; 
								</script>		
	<form method="post" action="<?= $C->SITE_URL?>admin/happends">

	<table id="setform" cellspacing="5">
			<tbody id="invite_table" class="invtbl_emldmns_<?= count($C->EMAIL_DOMAINS) ?>">
								

<tr>
<td ><input type="hidden" name="sh[]" value="" class="setinp" style="width:100px; padding:3px;" maxlength="100" /></td>
<td>نام رویداد</td>
<td><input  type="text" placeholder="نام رویداد" name="title[]" value="" class="setinp" style="width:140px; padding:3px;text-align:left;direction:ltr" maxlength="100" /></td>
<td>توضیحات رویداد</td>
<td><textarea   placeholder="توضیحات رویداد" name="about[]"  class="setinp" style="width:140px; padding:3px;text-align:left;direction:ltr" maxlength="100" ></textarea></td>

<td>تاریخ رویداد</td>
<td>
											<select name="day[]" class="setselect" style="width:50px;">
											<?php foreach($D->menu_d as $k=>$v) { ?>
											<option value="<?= $k ?>"><?= $v ?></option>
											<?php } ?>
											</select>
											<select name="month[]" class="setselect" style="width:80px;">
											<?php foreach($D->menu_m as $k=>$v) { ?>
											<option value="<?= $k ?>"><?= $v ?></option>
											<?php } ?>
											</select>
											<select name="year[]" class="setselect" style="width:56px;">
											<?php foreach($D->menu_y as $k=>$v) { ?>
											<option <?=$v == pdate('Y')?'selected="selected"':'' ?> value="<?= $v ?>"><?= $v ?></option>
											<?php } ?>
											</select>
										</td>


</tr>
</tbody>


</table>
<hr><br>
<table>
<tr>
<td>
<a href="javascript:;" onclick="invform_line_add();" onfocus="this.blur();" class="addaline">افزودن</a>
<a href="javascript:;" onclick="invform_line_del();" onfocus="this.blur();" class="remaline">کاستن</a>
</td>
<td><input type="submit" name="add" value="ذخیره" style="padding:4px; font-weight:bold;"/></td>
</tr>
</table>
</form>

<hr><br>
<table id="setform" cellspacing="5">
	<form method="post" action="<?= $C->SITE_URL?>admin/cats">
								
<? if(!empty($D->s)) {?>
    	<script>

function toggle(source,w) {
  checkboxes = document.getElementsByName(w);

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
	<tr>
<td>
<input type="checkbox"   onclick="toggle(this,'del[]')" name="del" value="1"  />
</td>
<td><input type="submit" name="del_b" value="حذف" style="padding:4px; font-weight:bold;"/></td>
<td>

</td>

<td></td>
<td></td>
<td></td>
</tr>	
<? foreach($D->s as $s){ ?>
	
<tr>
<td>
<input type="checkbox"   name="del[]" value="<?= $s->id?>"  />
</td>

<td>نام</td>
<td><input disabled type="text" placeholder="نام رویداد" name="" value="<?=$s->title?>" class="setinp" style="width:140px; padding:3px;text-align:left;direction:ltr" maxlength="100" /></td>
<td>توضیحات</td>
<td><textarea  disabled placeholder="توضیحات رویداد" name=""  class="setinp" style="resize:none;width:140px; padding:3px;text-align:left;direction:ltr" maxlength="100" ><?=$s->about?></textarea></td>

<td>تاریخ</td>
<td>
											<select name="" class="setselect" style="width:50px;">
											<?php foreach($D->menu_d as $k=>$v) { ?>
											<option <?= $v == $s->day ?'selected="selected"':'' ?>  value="<?= $k ?>"><?= $v ?></option>
											<?php } ?>
											</select>
											<select name="" class="setselect" style="width:80px;">
											<?php foreach($D->menu_m as $k=>$v) { ?>
											<option <?=$k == $s->month  ?'selected="selected"':'' ?> value="<?= $k ?>"><?= $v ?></option>
											<?php } ?>
											</select>
											<select name="" class="setselect" style="width:56px;">
											<?php foreach($D->menu_y as $k=>$v) { ?>
											<option <?=$v == $s->year ?'selected="selected"':'' ?> value="<?= $v ?>"><?= $v ?></option>
											<?php } ?>
											</select>
										</td>

<td><b><a href="<?= $C->SITE_URL?>admin/happends/tab:edit/id:<?=$s->id?>" >ویرایش</a></b></td>
</tr>

<? }}?>
</form>
</table>






					<? }elseif($D->tab == 'edit'){?>		


<form method="post" action="<?= $C->SITE_URL?>admin/happends/tab:edit/id:<?=$D->r->id?>">
	<table id="setform" cellspacing="5">
			
								
	
<tr>


<td>نام</td>
<td><input  type="text" placeholder="نام رویداد" name="title" value="<?=$D->r->title?>" class="setinp" style="width:140px; padding:3px;text-align:left;direction:ltr" maxlength="100" /></td>
<td>توضیحات</td>
<td><textarea   placeholder="توضیحات رویداد" name="about"  class="setinp" style="resize:none;width:140px; padding:3px;text-align:left;direction:ltr" maxlength="100" ><?=$D->r->about?></textarea></td>

<td>تاریخ</td>
<td>
											<select name="day" class="setselect" style="width:50px;">
											<?php foreach($D->menu_d as $k=>$v) { ?>
											<option <?= $v == $D->r->day ?'selected="selected"':'' ?>  value="<?= $k ?>"><?= $v ?></option>
											<?php } ?>
											</select>
											<select name="month" class="setselect" style="width:80px;">
											<?php foreach($D->menu_m as $k=>$v) { ?>
											<option <?=$k == $D->r->month  ?'selected="selected"':'' ?> value="<?= $k ?>"><?= $v ?></option>
											<?php } ?>
											</select>
											<select name="year" class="setselect" style="width:56px;">
											<?php foreach($D->menu_y as $k=>$v) { ?>
											<option <?=$v == $D->r->year ?'selected="selected"':'' ?> value="<?= $v ?>"><?= $v ?></option>
											<?php } ?>
											</select>
										</td>


</tr>



<td><input type="submit" name="edit" value="ذخیره" style="padding:4px; font-weight:bold;"/></td>
</tr>



</table>

</form>





<?}?>					
							
									</div>
								</div>
							</div>
							
						</div>
					</div>
<?php
	
	$this->load_template('footer.php');
	
?>