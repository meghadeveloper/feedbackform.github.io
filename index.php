<?php
include "Main.php";
$data =  new Main();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Form</title>
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<!-- Styles -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<style>
    .error{
        color: red;
    }
    .success{
        color: green;
    }
.overlay {
  position: fixed; /* Sit on top of the page content */
  display: none; /* Hidden by default */
  width: 100%; /* Full width (cover the whole page) */
  height: 100%; /* Full height (cover the whole page) */
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5); /* Black background with opacity */
  z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
  cursor: pointer; /* Add a pointer on hover */
}
</style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container mt-5">
        <div class="row">
            <div class="card" style="width: 100%">
                <div class="card-header">
                    <h2 class="text-success">Feedback Form</h2>
                </div>
                <div class="card-body">
                    <!-- <div id="msg"></div> -->
                    <div class="alert alert-success" role="alert">
                           
                          </div>
                    <form id="fb_form" method="POST">
                        <div class="form-group">
                            <label for="name">Name</label><span class="error">*</span>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="state">State</label><span class="error">*</span>
                            <select class="form-control" id="state-dropdown" name="state_id">
                                <option value="">Select State</option>
                                <?php
                                //$row=$data->getState();
                                $sql=$data->getState();
                                $cnt=1;
                                while($row=mysqli_fetch_array($sql)){
                                // $result = mysqli_query($conn,"SELECT * FROM states");
                                //     while($row = mysqli_fetch_array($result)) {
                                ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                <?php $cnt=$cnt+1;} ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label><span class="error">*</span>
                            <select class="form-control" id="city-dropdown" name="city_id">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="feedback">Feedback</label><span class="error">*</span>
                            <textarea name="feedback" id="feedback" cols="30" rows="10" class="form-control" placeholder="Please Enter the Feedback"></textarea>
                        </div>
                        <div class="form-group">
                                <button type="submit" class="btn btn-success" name="submit" >Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#city-dropdown').on('change', function() {
            $('#city-dropdown option[value='+this.value+']').attr('selected','true');

        });
         $('#state-dropdown').on('change', function() {
                
                var state_id = this.value;
                $('#state-dropdown option[value='+state_id+']').attr('selected','true');

                $.ajax({
                    url: "citiesbystate.php",
                    type: "POST",
                    cache: false,
                    data: {state_id: state_id},
                    success: function(result)
                    {
                        
                        $("#city-dropdown").html(result);
                    }
                });
            });
    
            $('.alert').hide();
        $(document).ready(function() {
            $('#name').on('click',function()
            {
                $('.alert').hide();
            });
            $('.alert').hide();
            $('#fb_form').validate({
                
                rules:{
                    name:{
                        required:true
                    },
                    state_id :{
                        required:true
                    },
                    city_id:{
                        required:true
                    },
                    feedback:{
                        required:true
                    }
                },
                submitHandler: function(form) {

                    var name = $('#name').val();
                    var stateid = $('#state-dropdown').val();
                    var cityid = $('#city-dropdown').val();
                    var feedback = $('#feedback').val();
                    

	    			$('.overlay').show();
		    		var postData = {name:name,stateid:stateid,cityid:cityid,feedback:feedback};
			    	jQuery.ajax({
                        url: "save.php",
					    type: "POST",
					    data: postData,
					    success: function (data) {
                            $('.alert').show();
						    $('.overlay').hide();
                        
						if(data) {
                            
                            // $('.alert').alert()
							$('.alert').html('<span class="success">Feedback added successfully !!</span>');
                            $('#name').val('');
                            $("#state-dropdown option[value='']").attr('selected', true)
                            $("#city-dropdown option[value='']").attr('selected', true)

                            $('#feedback').val('');
						} else {
                            // $('.alert').close()

							$('.alert').html('<span class="error">Something went wrong. Please try later</span>');
						}
					},
					
				});
			},

            });
            
           
        });
    </script>
</body>
</html>