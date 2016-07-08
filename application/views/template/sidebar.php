<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('fullname')?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Logged In</a>
            </div>
        </div>
        <!-- search form 
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>-->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li id="menu_dashboard" class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('dashboard1') ?>"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                    <li><a href="<?php echo site_url('dashboard2') ?>"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                </ul>
            </li>
            <li id="menu_inventory" class="treeview">
                <a href="<?php echo site_url('inventory')?>">
                    <i class="fa fa-files-o"></i>
                    <span>Inventaris</span>
                </a>
                
            </li>
			<li id="menu_cashier" class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Kasir</span>
                </a>
				<ul id="child_menu_cashier" class="treeview-menu">
                    <li id="child_menu_cashier_buat_order"><a href="<?php echo site_url('cashier')?>"><i class="fa fa-circle-o"></i>Buat Order</a></li>
                    <li id="child_menu_cashier_daftar_order"><a href="<?php echo site_url('cashier/list_invoice') ?>"><i class="fa fa-circle-o"></i>Daftar Order</a></li>
                </ul>
            </li>
			<li id="menu_report" class="treeview">
                <a href="<?php echo site_url('#')?>">
					<i class="fa fa-files-o"></i> <span>Laporan</span><i class="fa fa-angle-left pull-right"></i>
                </a>       
				<ul id="child_menu_report" class="treeview-menu">
                    <li id="child_menu_report_laporan_shift"><a href="<?php echo site_url('#') ?>"><i class="fa fa-circle-o"></i>Laporan Shift</a></li>
                    <li id="child_menu_report_laporan_harian"><a href="<?php echo site_url('#') ?>"><i class="fa fa-circle-o"></i>Laporan Harian</a></li>
                </ul>
            </li>
			<li id="menu_user" class="treeview hide">
                <a href="<?php echo site_url('#')?>">
					<i class="fa fa-files-o"></i> <span>Pengguna</span><i class="fa fa-angle-left pull-right"></i>
                </a>       
				<ul id="child_menu_user" class="treeview-menu">
                    <li id="child_menu_report_daftar_user"><a href="<?php echo site_url('user') ?>"><i class="fa fa-circle-o"></i>Daftar Pengguna</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
