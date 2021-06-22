$(document).ready(function(){

    let genreDropdownOpen = false;
    let sortByDropdownOpen = false;

    $('#genreDropdownBtn').click(function(){
       if(genreDropdownOpen){
           $(this).parent().find('.mySelectOptions').hide();
           genreDropdownOpen = false;
       }else {
           $(this).parent().find('.mySelectOptions').show();
           genreDropdownOpen = true;
       }
    });

    $('#sortByDropdownBtn').click(function(){
        if(sortByDropdownOpen){
            $(this).parent().find('.mySelectOptions').hide();
            sortByDropdownOpen = false;
        }else {
            $(this).parent().find('.mySelectOptions').show();
            sortByDropdownOpen = true;
        }
    });

    $('.sortByOption').click(function(){
        $(this).parent().parent().find('.mySelectBtn').find('p').text($(this).text());
        $(this).parent().hide();
        chosen_sort = $(this).attr('data-option');
        sortByDropdownOpen = false;
    });

    $('.sortDirectionBtn').click(function (){
        chosen_direction = $(this).attr('data-option');
    });

    let chosenRating = 0;

    $('.ratingControls').find('div').click(function(){
        if($(this).attr('data-option') == 'plus' && chosenRating < 9){
            chosenRating++;
        }
        if($(this).attr('data-option') == 'minus' && chosenRating > 0){
            chosenRating--;
        }
        $('.chosenRating').text(chosenRating + '+');
        chosen_rating = chosenRating;
    });

    if(!localStorage.getItem("alert")){
        alert("Some functionalities are yet to be implemented!");
        localStorage.setItem("alert", true);
    }

    function ajaxSetup() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    let filePath = window.location.pathname;
    let filePathArr = filePath.substring(1, filePath.length).split("/");

    $(".card").click(function(){
        window.location.href = `/movies/show/${this.getAttribute("data-id")}`;
    });

    function thumbnailHover() {
        $(".card").click(function(){
            window.location.href = `/movies/show/${this.getAttribute("data-id")}`;
        });
    }

    $(".watch-trailer-btn").click(function(){
        window.open(
            $(this).attr("data-url"),
            '_blank'
          );
    });

    $(".visit-imdb-btn").click(function(){
        window.open(
            $(this).attr("data-url"),
            '_blank'
          );
    });

    let current_page = 1;

    function deleteMovie(movie_id) {
        ajaxSetup();
        $.ajax({
            url: '/admin/movies/delete',
            method: 'post',
            dataType: 'json',
            data: {
                id: movie_id
            },
            success: function(response){
                fillAdminMovieTable(current_page);
            },
            error: function(jqXHR){
                console.log(jqXHR);
            }
        });
    }

    function deleteUser(user_id) {
        ajaxSetup();
        $.ajax({
            url: '/admin/users/delete',
            method: 'post',
            dataType: 'json',
            data: {
                id: user_id
            },
            success: function(response){
                fillAdminUserTable(current_page);
            },
            error: function(jqXHR){
                console.log(jqXHR);
            }
        });
    }

    function fillAdminUserTable(current_page) {
        $.ajax({
            url: `/api/admin/users/${current_page}`,
            method: "get",
            dataType: "json",
            success: function(response) {
                let ispis = "";
                let paginationIspis = "";

                for(let x of response.users){
                    ispis += `
                    <tr>
                        <td>${x.id}</td>
                        <td>${x.username}</td>
                        <td>${x.email}</td>
                        <td>${x.role_id} </td>
                        <td>${x.online}</td>
                        <td><a href="/users/show/${x.id}"><i class="fas fa-info-circle infoBtn"></i></a></td>
                        <td><i class="fas fa-trash-alt deleteBtn deleteUserBtn" data-id="${x.id}"></i></td>
                    </tr>`;
                }
                $("#admin-users-table").html(ispis);
                for(let i = 0; i < response.pages_needed; i++) {
                    paginationIspis += `<div class="admin-user-pag" data-page="${i + 1}">${i + 1}</div>`;
                }
                $(".pagination").html(paginationIspis);
                $(".admin-user-pag").click(function(){
                    fillAdminUserTable($(this).attr("data-page"));
                });
                $(".deleteUserBtn").click(function(){
                    deleteUser($(this).attr("data-id"));
                });
            },
            error: function(jqXHR) {
                console.log(jqXHR);
            }
        });
    }


    function fillAdminMovieTable(current_page) {
        $.ajax({
            url: `/api/admin/movies/${current_page}`,
            method: "get",
            dataType: "json",
            success: function(response) {
                let ispis = "";
                let paginationIspis = "";

                for(let x of response.movies){
                    ispis += `
                    <tr>
                        <td>${x.imdb_id}</td>
                        <td>${x.title}</td>
                        <td><p>${x.review.length > 140 ? x.review.substring(0, 140) + "..." : x.review.substring(0, 140)}</p></td>
                        <td>${x.type} </td>
                        <td>${x.imdb_rating}</td>
                        <td>${x.runtime}</td>
                        <td>${x.release_year}</td>
                        <td><a href="/movies/show/${x.imdb_id}"><i class="fas fa-info-circle infoBtn"></i></a></td>
                        <td><a href="/admin/movies/edit/${x.imdb_id}"><i class="fas fa-edit editBtn"></i></a></td>
                        <td><i class="fas fa-trash-alt deleteBtn deleteMovieBtn" data-id="${x.imdb_id}"></i></td>
                    </tr>`;
                }
                $("#admin-movies-table").html(ispis);
                for(let i = 0; i < response.pages_needed; i++) {
                    paginationIspis += `<div class="admin-movie-pag" data-page="${i + 1}">${i + 1}</div>`;
                }
                $(".pagination").html(paginationIspis);
                $(".admin-movie-pag").click(function(){
                    fillAdminMovieTable($(this).attr("data-page"));
                });
                $(".deleteMovieBtn").click(function(){
                    deleteMovie($(this).attr("data-id"));
                });
            },
            error: function(jqXHR) {
                console.log(jqXHR);
            }
        });
    }

    if(filePathArr[0] == "admin" && filePathArr[1] == "movies") {
        fillAdminMovieTable(current_page);
    }

    if(filePathArr[0] == "admin" && filePathArr[1] == "users") {
        fillAdminUserTable(current_page);
    }

    $("#addMovieBtn").click(function(e){
        e.preventDefault();
        //Ajax kontaktira API i dodeljuje vrednosti skrivenim input poljima u formi
        $.ajax({
            method: "get",
            url: "http://www.omdbapi.com/?apikey=c59f3948&i=" + $("#addMovieId").val(),
            type: "json",
            success: function(data){
                $("#addMovieTitle").val(data.Title);
                $("#addMoviePosterDefault").val(data.Poster);
                $("#addMovieRating").val(data.imdbRating);
                $("#addMovieRuntime").val(data.Runtime);
                $("#addMovieYear").val(data.Year);
                $("#addMovieType").val(data.Type);
                $("#addMovieGenres").val(data.Genre.split(", ").join("/"));
                $("#addMovieForm").submit();
            },
            error: function(jqXHR){
                console.log(jqXHR);
            }
        });

    });

    function get_comments() {
        let movie_id = $("#movie_id").val();
        $.ajax({
            url: `/api/comments/get_all/${movie_id}`,
            method: 'get',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                let ispis = "";
                for(let x of response.comments) {
                    ispis += `
                    <div class="comment">
                        <div class="comment-username"><i class="fas fa-comment"></i> ${x.author_username} </div>
                        <div class="title-comment-top">
                            <div class="comment-content">
                                <p> ${x.text} </p>
                            </div>
                        </div>
                        <div class="comment-bottom">
                            <p> ${x.created_at} </p>
                        </div>
                    </div>
                    `;
                }

                $("#movie-comments").html(ispis);
            },
            error: function(jqXHR) {
                console.log(jqXHR);
            }
        });
    }

    if(filePathArr[0] == "movies" && filePathArr[1] == "show") {
        get_comments();
    }

    $("#submit-comment").click(function(e){
        e.preventDefault();
        ajaxSetup();
        $.ajax({
            url: '/api/comments/create',
            type: 'post',
            dataType: 'json',
            data: {
                movie_id: $(this).attr("data-movie-id"),
                user_id: $(this).attr("data-user-id"),
                text: $("#addCommentTextarea").val()
            },
            success: function(response) {
                get_comments();
                $("#addCommentTextarea").val("");
            },
            error: function(jqXHR) {
                console.log(jqXHR);
            }
        });
    });

    let chosen_genre = "";
    let chosen_sort = "title";
    let chosen_direction = "asc";
    let chosen_rating = 0;
    let items_per_page = 16;

    $("#browseSubmit").click(function(){
        fillBrowse(current_page, chosen_genre, chosen_sort, chosen_direction, chosen_rating, items_per_page);
    });

    function fillBrowse(page, genre, sort, direction, rating, per_page) {
        let ispis = "";
        ajaxSetup();
        $.ajax({
            url: `/api/browse`,
            method: 'post',
            dataType: 'json',
            data: {
                page: page,
                genre: genre,
                sort: sort,
                direction: direction,
                rating: rating,
                per_page: per_page
            },
            success: function(response) {
                let paginationIspis = "";
                for(let i = 0; i < response.pages_needed; i++) {
                    paginationIspis += `<div class="browse-pag" data-id=${i + 1}>${i + 1}</div>`;
                }
                $(".pagination").html(paginationIspis);
                $(".browse-pag").click(function(){
                    fillBrowse($(this).attr('data-id'), chosen_genre, chosen_sort, chosen_direction, chosen_rating, items_per_page);
                });
                for(let x of response.movies) {
                    ispis += `
                    <div class="card" data-id="${x.imdb_id}">
                        <div class="image">
                            <img src="${x.poster_url}" alt="poster">
                            <div class="data">
                                <p class="thumbnailRating"><span>IMDb</span> ${x.imdb_rating}</p>
                                <ul class="thumbnailGenres">
                                <li>${x.genres.join("</li><li>")}</li>
                                </ul>
                                <button>Open</button>
                            </div>
                        </div>
                        <p class="thumbnailTitle">${x.title}</p>
                        <p class="thumbnailYear">${x.release_year}</p>
                    </div>`;
                }
                $("#movieGrid").html(ispis);
                thumbnailHover();
            },
            error: function(jqXHR) {
                console.log(jqXHR);
            }
        });
    }

    if(filePathArr[0] == "browse") {
        $.ajax({
            url: "/api/genres",
            type: "get",
            dataType: "json",
            success: function(response) {
                let output = `
                <div data-option="" class="mySelectOption genreOption" style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;"
                     unselectable="on"
                     onselectstart="return false;"
                     onmousedown="return false;">All</div>
                `;
                for(let x of response.genres) {
                    output += `
                    <div data-option="${x.genre}" class="mySelectOption genreOption" style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;"
                     unselectable="on"
                     onselectstart="return false;"
                     onmousedown="return false;">${x.genre}</div>`;
                }
                $("#genreSelect").html(output);
                $('.genreOption').click(function(){
                    $(this).parent().parent().find('.mySelectBtn').find('p').text($(this).text());
                    $(this).parent().hide();
                    chosen_genre = $(this).attr('data-option');
                    console.log(chosen_genre);
                    genreDropdownOpen = false;
                });
            },
            error: function(jqXHR) {
                console.log(jqXHR);
            }
        });
        fillBrowse(current_page, chosen_genre, chosen_sort, chosen_direction, chosen_rating, 16);
    }

    /*ADMIN OVERVIEW*/
    /*if(filePathArr[0] == "admin" && filePathArr[1] == "overview") {
        google.charts.load('current', {'packages':['corechart']});

        let niz = [
            ['Genre', 'Number of movies']
        ];

        $.ajax({
            url: '/api/pie/genres',
            type: 'get',
            dataType: 'json',
            success: function(response) {
                for(let x of response.result) {
                    niz.push([x.genre, x.number]);
                }
                drawChart(niz);
            },
            error: function(jqXHR) {
                console.log(jqXHR);
            }
        });

        function drawChart(arr) {
            var data = google.visualization.arrayToDataTable([...arr]);

            var options = {
                title: 'Number of movies per genre',
                is3D: true,
                animation: {"startup": true}
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    }*/

    function searchComments(text) {
        $.ajax({
            url: `/api/comment_search/${text}`,
            method: 'get',
            type: 'json',
            success: function(response) {
                let ispis = "";
                let comment_count = 0;
                for(let x of response.comments){
                    comment_count++;
                    ispis += `
                    <tr>
                        <td>${x.comment_id}</td>
                        <td>${x.comment_content}</td>
                        <td>${x.user_username}</td>
                        <td>${x.movie_title}</td>
                        <td>${x.comment_time}</td>
                        <td><i class="fas fa-trash-alt deleteBtn deleteCommentBtn" data-id="${x.comment_id}"></i></td>
                    </tr>
                    `;
                }
                if(comment_count == 0) {
                    ispis = `
                    <tr>
                        <td colspan="6">Nema rezultata</td>
                    </tr>`;
                }
                $("#admin-comments-table").html(ispis);
                $(".deleteCommentBtn").click(function(){
                    ajaxSetup();
                    $.ajax({
                        url: '/api/comment_delete',
                        method: 'post',
                        type: 'json',
                        data: {
                            id: $(this).attr('data-id')
                        },
                        success: function(response) {
                            console.log(response);
                            searchComments(text);
                        },
                        error: function(jqXHR){
                            console.log(jqXHR);
                        }
                    });
                });
            },
            error: function(jqXHR){
                console.log(jqXHR);
            }
        });
    }

    $("#commentSearch").keyup(function(){
        searchComments($(this).val());
    });

    let drawerOut = false;
    $("#burger").click(function(){
        if(drawerOut){
            $("#drawer").slideUp();
            drawerOut = false;
        }else {
            $("#drawer").slideDown();
            drawerOut = true;
        }
    });

    $(window).resize(function(){
        if(window.innerWidth > 440){
            $("#drawer").slideUp();
            drawerOut = false;
        }
    });

});
