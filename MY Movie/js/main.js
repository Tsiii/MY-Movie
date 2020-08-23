$(document).ready(function () {
    $("#loginUser").submit(function (event) {
        var username = $("#username").val();
        var password = $("#password").val();

        loginUser(username, password);
        var result = "";
    });

    var apikey = "698ec1ac";

    $("#movieForm").submit(function (event) {
        event.preventDefault();

        var homo = $("#movie").val();
        var year = $("#year").val();
        var page = $("#page").val();

        getMovies(homo, year, page);
        var result = "";
    });

    $("#movieSearch").submit(function (event) {
        event.preventDefault();

        var movie_title = $("#movie_title").val();
        getFavMovie(movie_title);
        var resultSearch = "";
    });

    $("#movieminiSearch").submit(function (event) {
        event.preventDefault();

        var movie_title = $("#movie_minititle").val();

        getFavMovie(movie_title);
        var resultSearch = "";
    });
});

(function ($) {
    /* Preloader
     * -------------------------------------------------- */
    var clPreloader = function () {
        $("html").addClass("cl-preload");

        $(window).on("load", function () {
            //force page scroll position to top at page refresh
            $("html, body").animate({ scrollTop: 0 }, "normal");

            // will first fade out the loading animation
            $("#loader").fadeOut("slow", function () {
                // will fade out the whole DIV that covers the website.
                $("#preloader").delay(300).fadeOut("slow");
            });

            // for hero content animations
            $("html").removeClass("cl-preload");
            $("html").addClass("cl-loaded");
        });
    };

    /* Back to Top
     * ------------------------------------------------------ */
    var clBackToTop = function () {
        var pxShow = 250, // height on which the button will show
            fadeInTime = 400, // how slow/fast you want the button to show
            fadeOutTime = 400, // how slow/fast you want the button to hide
            scrollSpeed = 300, // how slow/fast you want the button to scroll to top. can be a value, 'slow', 'normal' or 'fast'
            goTopButton = $(".go-top");

        // Show or hide the sticky footer button
        $(window).on("scroll", function () {
            if ($(window).scrollTop() >= pxShow) {
                goTopButton.fadeIn(fadeInTime);
            } else {
                goTopButton.fadeOut(fadeOutTime);
            }
        });
    };

    /* Initialize
     * ------------------------------------------------------ */
    (function ssInit() {
        clPreloader();
        clBackToTop();
    })();
})(jQuery);

function showPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function getMovies(homo, year, page) {
    var apikey = "698ec1ac";

    axios
        .get(
            "http://www.omdbapi.com/?s=" +
                homo +
                "&y=" +
                year +
                "&page=" +
                page +
                "&apikey=698ec1ac"
        )
        .catch(function (error) {
            if (error.response) {
                result = `<h1>Sorry: ${error.response.data} </h1> 
					<h1 class="text-danger" >Sorry: ${error.response.status}</h1> 
					<h1 class="text-danger" >Sorry: ${error.response.headers}</h1> 
			    `;
            } else {
                result = `<h1  class="text-danger" >Sorry: The request was made but no response was received 
                             Check Your Internet Connection Please</h1> 
				`;
            }
            $("#show").html(result);
        })
        .then((data) => {
            result = "";

            if (data.data.Error) {
                result = `<h1  class="text-danger text-center ">Sorry: ${data.data.Error}</h1> 
            `;
                $("#show").html(result);
            } else {
                var movies = data.data.Search;
                let result = "";

                for (i = 0; i < movies.length; i++) {
                    result += `     
                    <div class="col-sm-4 py-2">
                        <div class="card-group">
                            <div class= "card" >
                                <img class= "card-img-top"  width='400' height='400' src="${movies[i].Poster}" alt = "image of ${movies[i].Title}"> 
                                <a class = 'btn btn-primary'  href = "#" onclick="movieSelected('${movies[i].imdbID}')" class="btn btn-primary" >Movie Details</a>
                            </div>
                        </div>
                    </div> 
				    `;
                }
                $("#show").html(result);
            }
        })
        .catch((err) => {
            result = `<h1><span class='colored-text'>Oops!</span> Something went wrong and we couldn't send your message</h1>`;
            console.log(err);
            $("#show").html(result);
        });
}

function movieSelected(id) {
    sessionStorage.setItem("movieId", id);
    window.location = "movie.php";
    return false;
}

function getMovie() {
    let movieId = sessionStorage.getItem("movieId");
    axios
        .get(
            "http://www.omdbapi.com/?i=" +
                movieId +
                "&plot=full" +
                "&apikey=698ec1ac"
        )
        .then((response) => {
            let movie = response.data;

            title = movie.Title;
            image = movie.Poster;
            poster = movie.Poster;
            imdbId = movie.imdbID;

            var movieId = sessionStorage.getItem("movieId");

            console.log(movieId);

            $.ajax({
                type: "post",
                url: "isSaved.php",
                data: { movieId: movieId },
                success: function (data) {
                    var result = data;
                    console.log(result);

                    if (result == "exists") {
                        $("#loginToAdd").hide(function () {
                            $("#savemovies").css("display", "block");
                        });
                        console.log(result);
                        $("#savemovies").hide(function () {
                            $("#deleteFav").css("display", "block");
                        });
                    } else if (result == "doesn't exits") {
                        $("#savemovies").hide(function () {
                            $("#loginToAdd").css("display", "block");
                        });
                    } else if (result == "error checking") {
                        console.log(result);
                    }
                },
            });

            $.ajax({
                url: "islogged.php",
                success: function (data) {
                    var result = data;
                    console.log(result);

                    if (result == "yes") {
                        $("#loginToAdd").hide(function () {
                            $("#savemovies").css("display", "block");
                        });
                        console.log(result);
                    } else if (result == "no") {
                        $("#savemovies").hide(function () {
                            $("#loginToAdd").css("display", "block");
                        });

                        console.log(result);
                    }
                },
            });

            let result = `
                <h2  class="text-center mt-5"   value = "${movie.Title}" >${movie.Title}</h2>
                <div class="row" style="margin-bottom: 15px;"> 
                    <div class="col-md-4">
                        <img width='350' height='500'  src ="${movie.Poster}" class="thumbnail">
                        <div id="message"> </div>
                    </div>  

                    <div class="col-md-8" >
                        <ul class="list-group"> 
                            <li id = "genre"  class="list-group-item"><strong>Genre: </strong>${movie.Genre}</li>                           
                            <li id = "release" class="list-group-item"><strong>Released:</strong>${movie.Released}</li>
                            <li id = "actors" class="list-group-item"><strong>Actors: </strong>${movie.Actors}</li> 
                            <li id = writer"  class="list-group-item"><strong>Writer: </strong>${movie.Writer}</li>
                            <li id = "rating" class="list-group-item"><strong>IMDB Rating: </strong>${movie.imdbRating}</li>
                            <li id = "rated"  class="list-group-item"><strong>Rated: </strong>${movie.Rated}</li>
                            <li id = "plot"   class="list-group-item "><strong>Plot </strong><h5 class="font-weight-light">${movie.Plot} </h5> </li>
                  
                            <button class="btn btn-outline-success list-group-item" type="button" 
                                id="loginToAdd" data-toggle="modal" data-target="#myModal"  >Login Here 
                            </button>  

                            <button class="btn btn-outline-success list-group-item" type="button" 
                                id="savemovies" onclick="setFavMovie()" name="saveamovie">Add To Favorites 
                            </button> 
    
                            </button><input class= "btn btn-outline-danger list-group-item"  style="display:none;"  id = "deleteFav" onclick="deleteFavMovie('${movie.imdbID}')" id="deletefavorite"  name = "deleteFav" type="submit" value="Delete Movie" />  

                             
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
 
                                            <form id="loginUser" class="form-signin" autocomplete="on" method="post" >
                                                
                                                <div class="col-lg-12 text-center ">
                                                    <h1 style="font-family:Lucida Console">Login</h1>
                                                </div>
 
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control" placeholder="Username" name="username"
                                                        id="username" required autofocus />
                                                </div>

                                                <div class="form-label-group">
                                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                                        id="password" required="" />
                                                </div>

                                                <input class="form-label-group" type="checkbox" onclick="showPassword()">Show Password 
 
                                                <button class="btn btn-lg btn-primary btn-block" type="submit" id="signin" onclick="loginUser()" name="signin">
                                                    Sign in
                                                </button> 

                                                <p class="mt-4 text-muted"> New to site?
                                                    <a href="registration.php"> Create Account </a>
                                                </p>
                                            </form> 

                                            <div id="message"> </div>

                                        </div>

                                    </div>
                                </div>
                            </div> 

                            <a class= 'btn btn-primary' id="imdbId" href="http://imdb.com/title/${movie.imdbID}" target="_blank" >View IMDB</a> 
                            
                       
                        </ul>

                        <input type="hidden" id ="movie_image" name ="movie_image" value="${movie.Poster}">
                        <input type="hidden" id ="movie_title" name ="movie_title" value="${movie.Title}">
                        <input type="hidden" id ="movie_id"    name ="movie_id"    value="${movie.imdbID}">
                           


                        <input type="hidden" id ="movieId" name ="movie_id">
                        
                    </div> 
  
                </div>    
            `;
            document.querySelector("#movie").innerHTML = result;

            document.querySelector("#movieId").innerHTML = movieId;

            localStorage.setItem("title", title);
            localStorage.setItem("poster", poster);
            localStorage.setItem("imdbId", imdbId);

            window.localStorage.clear();
        })
        .catch((err) => {
            console.log(err);
            result = `<h1><span class='colored-text'>Oops!</span> Something went wrong and we couldn't send your message</h1>`;
            $("#movie").html(result);
        });
}

function getFavMovies() {
    axios.get("getrecords.php").then((data) => {
        var movies = data.data;
        let result = "";

        if (movies == 0) {
            result = `<h1 style="text-align:center;margin-left: 25%;margin-top: 5%; " >No Favorites Yet , 
                    <a style="color:#2b8440;" href="index.php" >Take Me Home</a></h1>
            `;
            $("#footer").css("display", "none");
        }

        for (i = 0; i < movies.length; i++) {
            result += ` 
                <div class="col-sm-3" style='padding-top:15px; padding-bottom:15px';>
                    <div class="card" id="${movies[i].movie_id}"> 
                        <img class="card-img-top" name="movie_image" src = "${movies[i].movie_image}" alt = "image of ${movies[i].movie_title}"  >
                        <input type="hidden" id ="movie_image" name ="movie_image" value="${movies[i].movie_image}"/> 
                        
                        <div class="overlay">     
                                <i class="fa fa-heart" data-toggle="tooltip" data-placement="right" ></i>	 
                        </div> 

                        <div class= "card-body"> 
                            <h5 class="card-title" name="movie_title" >${movies[i].movie_title}</h5>
                            <input type="hidden"  id ="movie_title" name ="movie_title" value="${movies[i].movie_title}"/>
                        </div>  
                        
                        <input type="hidden" id ="movie_id" name ="movie_id" value="${movies[i].movie_id}"/>
                        <a class='btn btn-primary' name="movie_id" onclick="movieSelected('${movies[i].movie_id}')">Movie Details</a>
                        
                        <input class= "btn btn-danger" id="deleteFav" onclick="deleteFavMovie()"  type="submit" name="deleteFav" value="Delete Movie" />  
                        <input class= "btn btn-success" id="saveMovie" onclick="setFavMovie()" style="display:none;" type="submit" name="saveamovie" value = " Add To Favorites "/>  
                        
                    </div>
                </div>
 
                <div style="color:pink" id="message"></div> 
                <div style="color:pink" id="messageD"></div>  
            `;
        }
        $("#records").html(result);
    });
}

function getFavMovie(movie_title) {
    $.ajax({
        method: "post",
        url: "getrecord.php",
        data: {
            movie_title: movie_title,
        },
    }).done(function (data) {
        var result = JSON.parse(data);
        var movies = result;

        let resultSearch = "";

        if (movies.length == 0) {
            resultSearch = `<h2 class="text-align:center" style="color:white;">No such movie in  Favorites Yet ,<h2> `;

            $("#recordSearch")
                .html(resultSearch)
                .css("display", "block-inline");
        }
        $("#searchResult").css("display", "block");
        for (i = 0; i < movies.length; i++) {
            resultSearch += ` 
                <div class="col-sm-3" style='padding-top:15px; padding-bottom:15px';>
                    <div class="card" id="${movies[i].movie_id}"> 
                        <img class="card-img-top" name="movie_image" src = "${movies[i].movie_image}" alt = "image of ${movies[i].movie_title}">
                        <input type="hidden" id ="movie_image" name ="movie_image" value="${movies[i].movie_image}"/>
                        
                        <div class= "card-body"> 
                            <h5 class="card-title" name="movie_title" >${movies[i].movie_title}</h5>
                            <input type="hidden"  id ="movie_title" name ="movie_title" value="${movies[i].movie_title}"/>
                        </div> 
                    
                        <input type="hidden" id ="movie_id" name ="movie_id" value="${movies[i].movie_id}"/>
                    
                        <a class='btn btn-primary' name="movie_id" onclick="movieSelected('${movies[i].movie_id}')"  >Movie Details</a>
                        
                        <input class= "btn btn-success" id="saveMovie" onclick="setFavMovie()"  type="submit" name="saveamovie" value = " Add To  "/>  
                        <input class= "btn btn-danger" id="deleteFav" onclick="deleteFavMovie('${movies[i].movie_id}')" style="display:none;" type="submit" name="deleteFav" value="Delete Movie" />  
                            
                    </div>
                </div> 
                
                <h1>
                    <div style="color:pink" id="message"></div>
                    <div style="color:pink" id="messageD"></div>
                </h1>
            `;
        }
        $("#recordSearch").html(resultSearch).css("display", "flex");
    });
}

function loginUser() {
    var username = $("#username").val();
    var password = $("#password").val();
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
				<div class="alert alert-danger alert-dismissible fade show col-lg-6" id="alertmsg">
             		<button type="button" class="close" data-dismiss="alert">&times;</button>
             		<h3><strong>Error:</strong> UNKNOWN ERROR HAS OCCURRED PLEASE TRY AGAIN. </h3>
			 	</div>
			`;
        } else {
            str = ` 
				<div class='alert alert-success col-md-6' id='alertmsg'> <h1> Welcome Back ${data} 
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

function setFavMovie(movie_title, movie_image, movie_id) {
    var movie_id = $("#movie_id").val();
    var movie_title = $("#movie_title").val();
    var movie_image = $("#movie_image").val();

    $.ajax({
        method: "post",
        url: "saverecords.php",
        data: {
            movie_title: movie_title,
            movie_image: movie_image,
            movie_id: movie_id,
        },
    }).done(function (data) {
        var result = data;
        var str = "";

        if (result == 1) {
            str = "<h4 class='col-md-12 text-primary'>Added to Fav Movie.</h4>";
            $("#savemovies").hide(function () {
                $("#deleteFav").css("display", "block");
            });
        } else if (result == 2) {
            str =
                "<h4 class='col-md-12 text-warning' >Movie could not be saved. Please try again</h4>";
        } else if (result == 3) {
            str = "<h4 class='col-md-12 text-danger' >Movie already Exist</h4>";
            $("#savemovies").hide(function () {
                $("#deleteFav").css("display", "block");
                $("#removefav")
                    .replaceAll("#savemovies")
                    .css("display", "block");
            });
        } else if (result == 5) {
            str =
                "<h4 class='col-md-12 text-warning'> You Need To Login First.<br> </h4>";
            $("#savemovies").hide(function () {
                $("#logintoAdd").css("display", "block");
            });
        } else {
            str = "<h4 class='col-md-12 text-danger'> error</h4>";
            console.log(str);
        }
        $("#message").html(str);
    });
}

function deleteFavMovie(movie_id) {
    $.ajax({
        method: "post",
        url: "deleterecord.php",
        data: {
            movie_id: movie_id,
        },
        success: function (data) {},
    }).done(function (data) {
        let result = data;
        var str = "";
        if (result == 1) {
            $("#deleteFav").hide(function () {
                $("#savemovies").css("display", "block");
            });
            str = "<h4 class='col-md-12'> Movie Deleted successfully</h4>";
        } else if (result == 2) {
            str = "<h4 class='col-md-12'> Movie Doesn't Exist </h4>";
        } else if (result == 3) {
            str =
                "<h4 class='col-md-12'> Movie Deleted could not be Deleted. Please try again</h4>";
        }
        $("#message").html(str).hide(3000);
    });
}
