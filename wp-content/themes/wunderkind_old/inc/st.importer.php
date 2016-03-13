<?php

if(!function_exists('st_show_importer_page'))
{
	function st_show_importer_page()
	{
		global $st_textdomain;


		

		if(isset($_REQUEST['st_start_import']) and $_REQUEST['st_start_import'])
		{
			include get_template_directory().'/inc/importer/st.importer.php';
			if(class_exists('STImporter'))
			{
				echo "<br><br><div class='updated'>";
				STImporter::init();
				echo "</div>";
			}
		}

		if(isset($_REQUEST['st_import_success']) and $_REQUEST['st_import_success'])
		{
			update_option('st_turnoff_importer',1);
			?>
			</br>
			</br>
			<?php
		}

		if(!get_option('st_turnoff_importer' ))
		{
			?>
			</br>
			</br>
			<div class="updated">
				<p><?php _e('Import All Demo Content With One-Click',$st_textdomain) ?></p>
				<p class="submit">
					<a href="<?php echo admin_url('admin.php?page=st-importer&st_start_import=1')?>" class="button"><?php _e('Import Now',$st_textdomain)?></a>
				</p>
				<p><?php _e('Make sure you backup everything before Import',$st_textdomain)?>.</p>
			</div>
			<?php
		}else
		{
			?>
			</br>
			</br>
			<div class="updated">
					<p><?php echo __('Demo Content had imported successfully',$st_textdomain) ?></p>
			</div>
			<?php
		}
	}
}

if(!function_exists('st_add_importer_menu'))
{
	function st_add_importer_menu()
	{
		add_menu_page('ST Importer','ST Impoter','manage_options','st-importer','st_show_importer_page','',63 );
	}
}
function my_custom_menu_page()
{
	echo 1;
}

add_action('admin_menu','st_add_importer_menu');

