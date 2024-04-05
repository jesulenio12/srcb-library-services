<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- School Seal -->
<link rel="icon" type="image/png" href="images/logo.png"/>
<!-- bootstrap 3.0.2 -->
<link href="styles/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="styles/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="styles/admin/css/all.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="styles/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<!-- select dropdown css -->
<style>
	.size-a-19 {
		width: 100%;
		height: 36px !important;
	}
</style>

<body class="skin-blue" onload="print()">
            <aside class="right-side">
                <section class="content">
                        <div class="col-xs-12">
                            <div class="box box-primary">
								<div class="box-header">
									<center>
										<h3 class="box-title">Book Report</h3>   
									</center>
                                </div><!-- /.box-header -->
                                    <table class="table table-bordered table-hover" id="articles">
                                        <thead>
                                            <tr>
												<th>Accession No.</th>
												<th>Call No.</th>
												<th>ISBN</th>
												<th>Book Section</th>
												<th>Title</th>
                                                <th>Author</th>
												<th>Publisher</th>
												<th>Date Published</th>
												<th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 
												$books = DB:: getInstance()->query("SELECT * FROM books WHERE status='0'");
                                                if($books->results() > 0){
												foreach($books->results() as $books){ ?>
														<tr>
															<td><?php echo $books->bookAccession ; ?></td>
															<td><?php echo $books->callNumber ; ?></td>
															<td><?php echo $books->isbn ; ?></td>
															<td><?php echo $books->bookSection ; ?></td>
															<td><?php echo $books->bookTitle ; ?></td>
															<td><?php echo $books->author ; ?></td>
															<td><?php echo $books->publisher ; ?></td>
															<td><?php echo $books->datePublished ; ?></td>
															<td align="center">
																<!-- Updated code Sept-18-22-->
																<?php if($books->is_borrowed == 1){?>
																	<span class="label label-danger"> Not Available</span>
																<?php }else{?>
																	<span class="label label-success"> Available</span>
																<?php }?>
																
															    <!-- Updated code Sept-18-22-->
															</td>
														</tr>
												<?php 	
													}
												}
										
											?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
								<button type="" class="btn btn-success btn-sm" style="width: 100%;" onclick="window.Location.replace('BookList.php');"> Cancel Printing </button>	
                        </div><!-- /.col -->
                    </div><!-- /.row (main row) -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->