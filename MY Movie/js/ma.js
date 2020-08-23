$(document).ready(function () {
    $.ajax({
        url: "islogged.php",
        success: function (data) {
            var result = data;
            console.log(result);

            if (result == "yes") {
                $("#loginToAdd").hide(function () {
                    $("#saveMovie").css("display", "block");
                });
            } else if (result == "no") {
                $("#saveMovie").hide(function () {
                    $("#loginToAdd").css("display", "block");
                });
            }
        },
    });

    var movie_id = $("#movie_id").val();
    $.ajax({
        type: "post",
        url: "isSaved.php",
        data: { movie_id: movie_id },
        success: function (data) {
            var result = data;
            console.log(result);

            if (result == "exists") {
                $("#loginToAdd").hide(function () {
                    $("#savemovies").css("display", "block");
                });
                console.log(result);
            } else if (result == "doesn't exits") {
                $("#savemovies").hide(function () {
                    $("#loginToAdd").css("display", "block");
                });
            } else if (result == "error checking") {
                console.log(result);
            }
        },
    });

    $("#loginUser").submit(function (event) {
        var username = $("#username").val();
        var password = $("#password").val();

        loginUser(username, password);
        var result = "";
    });
});

function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function display() {
    let result = `
	<h2  class="text-center mt-5"   value = "fdfdff" >dffdf</h2>
	<div class="row" style="margin-bottom: 15px;"> 
		<div class="col-md-4">
			<img width='350' height='500'  src =" " class="thumbnail">
			<div id="message"> </div>
		</div>  

		<div class="col-md-8" >
			<ul class="list-group"> 
				<li id = "genre"  class="list-group-item"><strong>Genre: </strong>dfdfdffdf</li>                           
				<li id = "release" class="list-group-item"><strong>Released:</strong>5320</li>
				<li id = "actors" class="list-group-item"><strong>Actors: </strong>$dffdfdd</li> 
				<li id = writer"  class="list-group-item"><strong>Writer: </strong>dffdf</li>
				<li id = "rating" class="list-group-item"><strong>IMDB Rating: </strong>5</li>
				<li id = "rated"  class="list-group-item"><strong>Rated: </strong>4</li>
				<li id = "plot"   class="list-group-item "><strong>Plot </strong><h5 class="font-weight-light">
				dfkjjvkdfvbkjfdbkjdbfkvbkdfjbvkdfbvhdfbvhdfbvkdfbvkjdfbvkjdf  </h5> </li>

				<button class="btn btn-outline-success list-group-item" type="button" 
					id="loginToAdd" data-toggle="modal" data-target="#myModal"> Login Here 
				</button> 
				 
				<input class= "btn btn-outline-success list-group-item" id="saveMovie" style="display:none;"
					onclick="setFavMovie()" type="submit" name="saveamovie" value = " Add To Favorites"/>  
					   
				</button><input class= "btn btn-outline-danger list-group-item"  style="display:none;"  
					id = "deleteFav"   id="deletefavorite"  name = "deleteFav" type="submit" value="Delete Movie" />  

				

				<!-- The Modal -->
				<div class="modal fade" id="myModal">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<!-- Modal body -->
							<div class="modal-body">

								<form class="form-signin" id="loginUser" name="form1" autocomplete="on" method="post" action="" >
									<div class="col-lg-12 text-center ">
										<h1 style="font-family:Lucida Console">Login</h1>
									</div> 

									<div class="form-label-group">
										<input type="text" class="form-control" placeholder="Username" name="username"
											id="username" value="" required autofocus />
									</div>

									<div class="form-label-group">
										<input type="password" class="form-control" placeholder="Password" name="password"
											id="password" required="" />
									</div>

									<input class="form-label-group" type="checkbox" onclick="myFunction()">Show Password 

									<button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign
										in</button>

									<p class="mt-4 text-muted"> New to site?
										<a href="registration.php"> Create Account </a>
									</p>
								</form> 

								<div id="message"> </div>

							</div>

						</div>
					</div>
				</div>

				<a class= 'btn btn-primary' id="imdbId" href="http://imdb.com/title/sdds" target="_blank" >View IMDB</a> 
				 
				<input type="hidden" id ="movie_id" name ="movie_id" value="tt1670399@">
			
			</ul>
 
		</div> 

	</div>    
	`;
    document.querySelector("#movie").innerHTML = result;
}

function loginUser(username, password) {
    console.log(username);
    $.ajax({
        method: "post",
        url: "login2.php",
        data: {
            username: username,
            password: password,
        },
    }).done(function (data) {
        var result = data;
        console.log(result);
        var str = "";

        if (result == 0) {
            str = ` 
				<div class="alert alert-danger alert-dismissible fade show col-lg-6 " id="alertmsg">  
					<button type="button" class="close" data-dismiss="alert">&times;</button>  
					<h3><strong>Error:</strong> Invalid Username Or Password. </h3>
				</div>
			`;
        } else if (result == 2) {
            $_SESSION["status"] = "Pending";
            str = ` 
				<div class="alert alert-warning alert-dismissible fade show col-lg-6" id="alertmsg"> 
					<button type="button" class="close" data-dismiss="alert">&times;</button> 
					<h3><strong>Error:</strong>your account is not approved</h3> 
				</div>
			`;
        } else if (result == 3) {
            $_SESSION["status"] = "Rejected";
            str = ` 
                <div class="alert alert-danger alert-dismissible fade show col-lg-6" id="alertmsg"> 
            		<button type="button" class="close" data-dismiss="alert">&times;</button> 
             		<h3><strong>Error:</strong> Your ACCOUNT HAS Been REJECTED!! </h3> 
				</div>
			`;
        } else if (result == 4) {
            str = ` 
				<div class="alert alert-danger alert-dismissible fade show col-lg-6" id="alertmsg"> ';
             		<button type="button" class="close" data-dismiss="alert">&times;</button>
             		<h3><strong>Error:</strong> UNKNOWN ERROR HAS OCCURRED PLEASE TRY AGAIN. </h3>
			 	</div>
			`;
        } else {
            str = ` 
				<div class='alert alert-success col-lg-6' id='alertmsg'> <h1> Welcome Back ${data} 
					<i class='fa-smile'></i></h1> 
				</div>
			`;
            $("#deleteFav").hide(function () {
                $("#saveMovie").css("display", "block");
            });
        }
        $("#message").html(str);
    });
}
