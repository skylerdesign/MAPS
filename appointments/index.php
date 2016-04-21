<?php include($_SERVER['DOCUMENT_ROOT']."/bouncer.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/parts/header.php"); ?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            
            <?php include($_SERVER['DOCUMENT_ROOT']."/parts/topnav.php"); ?>

            <?php include($_SERVER['DOCUMENT_ROOT']."/parts/sidebar.php"); ?>
            
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Appointments</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
	            	<div class="pull-right">
		            	<p><a href="/appointments/add.php" class="btn btn-info">Add New Appointment</a></p>
	            	</div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
	                
	                
	                <div class="page-header">

						<div class="pull-right form-inline">
							<div class="btn-group">
								<button class="btn btn-primary" data-calendar-nav="prev">&lt;&lt; Prev</button>
								<button class="btn" data-calendar-nav="today">Today</button>
								<button class="btn btn-primary" data-calendar-nav="next">Next &gt;&gt;</button>
							</div>
							<div class="btn-group">
								<button class="btn btn-warning" data-calendar-view="year">Year</button>
								<button class="btn btn-warning active" data-calendar-view="month">Month</button>
								<button class="btn btn-warning" data-calendar-view="week">Week</button>
								<button class="btn btn-warning" data-calendar-view="day">Day</button>
							</div>
						</div>
				
						<h3></h3>
					</div>
                   
                   <div id="calendar"></div>
                   
                                      
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include($_SERVER['DOCUMENT_ROOT']."/parts/footer.php"); ?>
