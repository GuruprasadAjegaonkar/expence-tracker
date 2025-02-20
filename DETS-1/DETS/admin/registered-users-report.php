<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['detsadminid']==0)) {
  header('location:logout.php');
  } else{
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker | Registered Users Report</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home hidden-print"></em>
				</a></li>
				<li class="active hidden-print">Registered Users Report</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Registered Users Report</div>
					<div class="panel-body">
						<div class="col-md-8">
							<form role="form" method="post"  name="bwdatesreport">
								<div class="form-group hidden-print">
									<label>From Date</label>
									<input class="form-control hidden-print" type="date"  id="fromdate" name="fromdate" required="true">
								</div>
								<div class="form-group hidden-print">
									<label>To Date</label>
									<input class="form-control hidden-print" type="date"  id="todate" name="todate" required="true">
								</div>
								
				
							
								
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary hidden-print" name="submit">Submit</button>
								</div>
								
								
								</div>
								
							</form>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->


<?php if(isset($_POST['submit'])){?>
		<div class="col-lg-12">
<?php
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
?>


<h5 align="center" style="color:blue"> All Registered Users from  <?php echo $fdate?> to <?php echo $tdate?></h5>

<hr />
  <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Mobile Number</th>
                  <th>Registration Date</th>
                  <th class="hidden-print">Action</th>
                </tr>
              </thead>
              <?php
              
$ret=mysqli_query($con,"select * from tbluser where date(RegDate) between '$fdate' and '$tdate'");
$cnt=1;
$row=mysqli_num_rows($ret);
if($row>0){
while ($row=mysqli_fetch_array($ret)) {

?>
              <tbody>
                <tr>
                  <td><?php echo $cnt;?></td>
              <td><?php  echo $row['FullName'];?></td>
                  <td><?php  echo $row['Email'];?></td>
                  <td><?php  echo $row['MobileNumber'];?></td>
                  <td><?php  echo $row['RegDate'];?></td>
                  <td class="hidden-print"><a  href="edit-users.php?editid=<?php echo $row['ID'];?>" target="_blank">Edit</a> |<a href="manage-expense.php?delid=<?php echo $row['ID'];?>" onClick="return confirm('Are you sure?')" style="text-decoration:none;font-size:16px;color:rgba(255,0,4,1.00);">Delete</a> | <a href="user-expense-details.php?uid=<?php echo $row['ID'];?>&&name=<?php echo $row['FullName'];?>" target="_blank">Expense Details</a>
                </tr>
                <?php 
$cnt=$cnt+1;
} } else{?>
		<tr>
		<td colspan="3" style="color:red;">No Record Found</td>
	</tr>
<?php } ?>
               
              </tbody>
            </table>
		</div>
		<input type="submit" class="btn btn-primary hidden-print"  onclick="window.print()" value="Print">
</div>

<?php } ?>


			<?php include_once('includes/footer.php');?>
		</div><!-- /.row -->
	</div><!--/.main-->
	
<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart.min.js"></script>
	<script src="../js/chart-data.js"></script>
	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/custom.js"></script>
</body>
</html>
<?php } ?>
