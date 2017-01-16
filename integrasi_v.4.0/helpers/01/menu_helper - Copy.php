<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('sidemenu'))
{
	function sidemenu($active=""){
		$CI =& get_instance();
		$CI->load->library('session');
		$CI->load->library('auth');
		$CI->load->model('menu_model', 'menu', true);
		$CI->load->model('menu_admin_model', 'menu_admin', true);
		
		$is_logged_admin = $CI->session->userdata('is_logged_admin');
		$admin_tamu['username'] 	= 'umum';
		$admin_tamu['nama']			= 'PENGGUNA UMUM';
		$admin_tamu['level_kode'] 	= 17;
		
		$admin_log = ($is_logged_admin)?$is_logged_admin:$admin_tamu;
		
		if ($admin_log['username'] == 'noname'){
			if ($CI->menu->count_all(array('menu.menu_level'=>'1', 'menu.menu_status'=>'A')) > 0){
				foreach($CI->menu->grid_all('menu.menu_kode AS kode, menu.menu_url AS url, menu.menu_nama AS nama, menu.menu_deskripsi AS deskripsi, menu.menu_icon AS icon, menu.menu_subkode AS subkode', 'menu_urutan', 'ASC', '', '', array('menu.menu_level'=>'1', 'menu.menu_status'=>'A')) as $row){
					if ($active == $row->kode){
						echo "<li class=\"start active open\">";
						if ($CI->menu->count_all(array('menu.menu_level'=>'2', 'menu.menu_subkode'=>$row->kode, 'menu.menu_status'=>'A')) > 0){
							$url = ($row->url == "#")?"javascript:;":site_url($row->url);
							echo "<a href=\"" . $url . "\">";
								echo "<i class=\"" . $row->icon . "\"></i>";
								echo "<span class=\"title\">" . $row->nama . "</span>";
								echo "<span class=\"arrow \"></span>";
							echo "</a>";
							echo "<ul class=\"sub-menu\">";
							foreach($CI->menu->grid_all('menu.menu_kode AS kode, menu.menu_url AS url, menu.menu_nama AS nama, menu.menu_deskripsi AS deskripsi, menu.menu_icon AS icon, menu.menu_subkode AS subkode', 'menu_urutan', 'ASC', '', '', array('menu.menu_level'=>'2', 'menu.menu_subkode'=>$row->kode, 'menu.menu_status'=>'A')) as $row2){
								$url2 = ($row2->url == "#")?"javascript:;":site_url($row2->url);
								echo "<li>";
									echo "<a href=\"" . $url2 . "\">";
									echo "<i class=\"" . $row2->icon . "\"></i> " . $row2->nama . "</a>";
								echo "</li>";
							}
							echo "</ul>";
						} else {
							$url = ($row->url == "#")?"javascript:;":site_url($row->url);
							echo "<a href=\"" . $url . "\">";
								echo "<i class=\"" . $row->icon . "\"></i>";
								echo "<span class=\"title\">" . $row->nama . "</span>";
								echo "<span class=\"selected\"></span>";
							echo "</a>";
						}
						echo "</li>";
					} else {
						if ($CI->menu->count_all(array('menu.menu_kode'=>$active, 'menu.menu_level'=>'2', 'menu.menu_subkode'=>$row->kode, 'menu.menu_status'=>'A')) > 0){
							echo "<li class=\"start active open\">";
								$url = ($row->url == "#")?"javascript:;":site_url($row->url);
								echo "<a href=\"" . $url . "\">";
									echo "<i class=\"" . $row->icon . "\"></i>";
									echo "<span class=\"title\">" . $row->nama . "</span>";
									echo "<span class=\"arrow \"></span>";
								echo "</a>";
								echo "<ul class=\"sub-menu\">";
								foreach($CI->menu->grid_all('menu.menu_kode AS kode, menu.menu_url AS url, menu.menu_nama AS nama, menu.menu_deskripsi AS deskripsi, menu.menu_icon AS icon, menu.menu_subkode AS subkode', 'menu_urutan', 'ASC', '', '', array('menu.menu_level'=>'2', 'menu.menu_subkode'=>$row->kode, 'menu.menu_status'=>'A')) as $row2){
									$url2 = ($row2->url == "#")?"javascript:;":site_url($row2->url);
									if ($row2->kode == $active){
										echo "<li class=\"active\">";
											echo "<a href=\"" . $url2 . "\">";
											echo "<i class=\"" . $row2->icon . "\"></i> " . $row2->nama . "</a>";
										echo "</li>";
									} else {
										echo "<li>";
											echo "<a href=\"" . $url2 . "\">";
											echo "<i class=\"" . $row2->icon . "\"></i> " . $row2->nama . "</a>";
										echo "</li>";
									}
								}
								echo "</ul>";
							echo "</li>";
						} else {
							echo "<li class=\"\">";
							if ($CI->menu->count_all(array('menu.menu_level'=>'2', 'menu.menu_subkode'=>$row->kode, 'menu.menu_status'=>'A')) > 0){
								$url = ($row->url == "#")?"javascript:;":site_url($row->url);
								echo "<a href=\"" . $url . "\">";
									echo "<i class=\"" . $row->icon . "\"></i>";
									echo "<span class=\"title\">" . $row->nama . "</span>";
									echo "<span class=\"arrow \"></span>";
								echo "</a>";
								echo "<ul class=\"sub-menu\">";
								foreach($CI->menu->grid_all('menu.menu_kode AS kode, menu.menu_url AS url, menu.menu_nama AS nama, menu.menu_deskripsi AS deskripsi, menu.menu_icon AS icon, menu.menu_subkode AS subkode', 'menu_urutan', 'ASC', '', '', array('menu.menu_level'=>'2', 'menu.menu_subkode'=>$row->kode, 'menu.menu_status'=>'A')) as $row2){
									$url2 = ($row2->url == "#")?"javascript:;":site_url($row2->url);
									echo "<li>";
										echo "<a href=\"" . $url2 . "\">";
										echo "<i class=\"" . $row2->icon . "\"></i> " . $row2->nama . "</a>";
									echo "</li>";
								}
								echo "</ul>";
							} else {
								$url = ($row->url == "#")?"javascript:;":site_url($row->url);
								echo "<a href=\"" . $url . "\">";
									echo "<i class=\"" . $row->icon . "\"></i>";
									echo "<span class=\"title\">" . $row->nama . "</span>";
								echo "</a>";
							}
							echo "</li>";
						}
					} 
				}
			}
// batas 1
		} else {
			if ($CI->menu_admin->count_all(array('menu.menu_level'=>'1', 'menu.menu_status'=>'A', 'admin_level.admin_level_kode'=>$admin_log['level_kode'])) > 0){
				foreach($CI->menu_admin->grid_all('menu.menu_kode AS kode, menu.menu_url AS url, menu.menu_nama AS nama, menu.menu_deskripsi AS deskripsi, menu.menu_icon AS icon, menu.menu_subkode AS subkode', 'menu_urutan', 'ASC', '', '', array('menu.menu_level'=>'1', 'menu.menu_status'=>'A', 'admin_level.admin_level_kode'=>$admin_log['level_kode'])) as $row){
					if ($active == $row->kode){
						echo "<li class=\"start active open\">";
						if ($CI->menu_admin->count_all(array('menu.menu_level'=>'2', 'menu.menu_subkode'=>$row->kode, 'menu.menu_status'=>'A', 'admin_level.admin_level_kode'=>$admin_log['level_kode'])) > 0){
							$url = ($row->url == "#")?"javascript:;":site_url($row->url);
							echo "<a href=\"" . $url . "\">";
								echo "<i class=\"" . $row->icon . "\"></i>";
								echo "<span class=\"title\">" . $row->nama . " a</span>";
							echo "</a>";
							echo "<ul class=\"sub-menu\">";
							foreach($CI->menu_admin->grid_all('menu.menu_kode AS kode, menu.menu_url AS url, menu.menu_nama AS nama, menu.menu_deskripsi AS deskripsi, menu.menu_icon AS icon, menu.menu_subkode AS subkode', 'menu_urutan', 'ASC', '', '', array('menu.menu_level'=>'2', 'menu.menu_subkode'=>$row->kode, 'menu.menu_status'=>'A', 'admin_level.admin_level_kode'=>$admin_log['level_kode'])) as $row2){
								$url2 = ($row2->url == "#")?"javascript:;":site_url($row2->url);
								echo "<li>";
									echo "<a href=\"" . $url2 . "\">";
									echo "<i class=\"" . $row2->icon . "\"></i> " . $row2->nama . " aa</a>";
								echo "</li>";
							}
							echo "</ul>";
						} else {
							$url = ($row->url == "#")?"javascript:;":site_url($row->url);
							echo "<a href=\"" . $url . "\">";
								echo "<i class=\"material-icons\">" . $row->icon . "</i>";
								echo "<span class=\"title\">" . $row->nama . " b</span>";
								echo "<span class=\"selected\"></span>";
							echo "</a>";
						}
						echo "</li>";
					} else {
						if ($CI->menu_admin->count_all(array('menu.menu_kode'=>$active, 'menu.menu_level'=>'2', 'menu.menu_subkode'=>$row->kode, 'menu.menu_status'=>'A', 'admin_level.admin_level_kode'=>$admin_log['level_kode'])) > 0){
							echo "<li class=\"active\">";
								$url = ($row->url == "#")?"javascript:;":site_url($row->url);
								echo "<a href=\"" . $url . "\" class=\"menu-toggle\">";
									echo "<i class=\"material-icons\">" . $row->icon . "</i>";
									echo "<span class=\"title\">" . $row->nama . " c</span>";
								echo "</a>";
								echo "<ul class=\"ml-menu\">";
								foreach($CI->menu_admin->grid_all('menu.menu_kode AS kode, menu.menu_url AS url, menu.menu_nama AS nama, menu.menu_deskripsi AS deskripsi, menu.menu_icon AS icon, menu.menu_subkode AS subkode', 'menu_urutan', 'ASC', '', '', array('menu.menu_level'=>'2', 'menu.menu_subkode'=>$row->kode, 'menu.menu_status'=>'A', 'admin_level.admin_level_kode'=>$admin_log['level_kode'])) as $row2){
									$url2 = ($row2->url == "#")?"javascript:;":site_url($row2->url);
									if ($row2->kode == $active){
										echo "<li class=\"active\">";
											echo "<a href=\"" . $url2 . "\">";
											echo "<i class=\"" . $row2->icon . "\"></i> " . $row2->nama . " bb</a>";
										echo "</li>";
									} else {
										echo "<li>";
											echo "<a href=\"" . $url2 . "\">";
											echo "<i class=\"" . $row2->icon . "\"></i> " . $row2->nama . " cc</a>";
										echo "</li>";
									}
								}
								echo "</ul>";
							echo "</li>";
// batas 2
						} else {
							if ($CI->menu_admin->count_all(array('menu.menu_level'=>'2', 'menu.menu_subkode'=>$row->kode, 'menu.menu_status'=>'A', 'admin_level.admin_level_kode'=>$admin_log['level_kode'])) > 0){
								$url = ($row->url == "#")?"javascript:;":site_url($row->url);
								echo "<a href=\"" . $url . "\" class=\"menu-toggle\">";
									echo "<i class=\"material-icons\">" . $row->icon . "</i>";
									echo "<span class=\"title\">" . $row->nama . " d</span>";
								echo "</a>";
								echo "<ul class=\"ml-menu\">";
								foreach($CI->menu_admin->grid_all('menu.menu_kode AS kode, menu.menu_url AS url, menu.menu_nama AS nama, menu.menu_deskripsi AS deskripsi, menu.menu_icon AS icon, menu.menu_subkode AS subkode', 'menu_urutan', 'ASC', '', '', array('menu.menu_level'=>'2', 'menu.menu_subkode'=>$row->kode, 'menu.menu_status'=>'A', 'admin_level.admin_level_kode'=>$admin_log['level_kode'])) as $row2){
									$url2 = ($row2->url == "#")?"javascript:;":site_url($row2->url);
									echo "<li>";
										echo "<a href=\"" . $url2 . "\">";
										echo "<i class=\"material-icons\">" . $row2->icon . "</i> " . $row2->nama . " dd</a>";
									echo "</li>";
								}
								echo "</ul>";
							} else {
								$url = ($row->url == "#")?"javascript:;":site_url($row->url);
								echo "<a href=\"" . $url . "\">";
									echo "<i class=\"material-icons\">" . $row->icon . "</i>";
									echo "<span class=\"title\">" . $row->nama . " e</span>";
								echo "</a>";
							}
						}
					} 
				}
			}
		}
	}	
}

