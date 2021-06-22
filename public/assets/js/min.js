$(document).ready(function(){function t(){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}})}localStorage.getItem("alert")||(alert("Some functionalities are yet to be implemented!"),localStorage.setItem("alert",!0));let e=window.location.pathname,n=e.substring(1,e.length).split("/");function i(){$(".movieThumbnail").hover(function(){$(this).find(".thumbnailSlider").css("opacity","1")},function(){$(this).find(".thumbnailSlider").css("opacity","0")}),$(".card").click(function(){window.location.href=`/movies/show/${this.getAttribute("data-id")}`})}$(".watch-trailer-btn").click(function(){window.open($(this).attr("data-url"),"_blank")}),$(".visit-imdb-btn").click(function(){window.open($(this).attr("data-url"),"_blank")}),i();let a=1;function o(e){t(),$.ajax({url:"/admin/movies/delete",method:"post",dataType:"json",data:{id:e},success:function(t){l(a)},error:function(t){console.log(t)}})}function d(e){t(),$.ajax({url:"/admin/users/delete",method:"post",dataType:"json",data:{id:e},success:function(t){s(a)},error:function(t){console.log(t)}})}function s(t){$.ajax({url:`/api/admin/users/${t}`,method:"get",dataType:"json",success:function(t){let e="",n="";for(let n of t.users)e+=`\n                    <tr>\n                        <td>${n.id}</td>\n                        <td>${n.username}</td>\n                        <td>${n.email}</td>\n                        <td>${n.role_id} </td>\n                        <td>${n.online}</td>\n                        <td><a href="/users/show/${n.id}"><i class="fas fa-info-circle infoBtn"></i></a></td>\n                        <td><i class="fas fa-trash-alt deleteBtn deleteUserBtn" data-id="${n.id}"></i></td>\n                    </tr>`;$("#admin-users-table").html(e);for(let e=0;e<t.pages_needed;e++)n+=`<div class="admin-user-pag" data-page="${e+1}">${e+1}</div>`;$(".pagination").html(n),$(".admin-user-pag").click(function(){s($(this).attr("data-page"))}),$(".deleteUserBtn").click(function(){d($(this).attr("data-id"))})},error:function(t){console.log(t)}})}function l(t){$.ajax({url:`/api/admin/movies/${t}`,method:"get",dataType:"json",success:function(t){let e="",n="";for(let n of t.movies)e+=`\n                    <tr>\n                        <td>${n.imdb_id}</td>\n                        <td>${n.title}</td>\n                        <td><p>${n.review.length>140?n.review.substring(0,140)+"...":n.review.substring(0,140)}</p></td>\n                        <td>${n.type} </td>\n                        <td>${n.imdb_rating}</td>\n                        <td>${n.runtime}</td>\n                        <td>${n.release_year}</td>\n                        <td><a href="/movies/show/${n.imdb_id}"><i class="fas fa-info-circle infoBtn"></i></a></td>\n                        <td><a href="/admin/movies/edit/${n.imdb_id}"><i class="fas fa-edit editBtn"></i></a></td>\n                        <td><i class="fas fa-trash-alt deleteBtn deleteMovieBtn" data-id="${n.imdb_id}"></i></td>\n                    </tr>`;$("#admin-movies-table").html(e);for(let e=0;e<t.pages_needed;e++)n+=`<div class="admin-movie-pag" data-page="${e+1}">${e+1}</div>`;$(".pagination").html(n),$(".admin-movie-pag").click(function(){l($(this).attr("data-page"))}),$(".deleteMovieBtn").click(function(){o($(this).attr("data-id"))})},error:function(t){console.log(t)}})}function c(){$.ajax({url:`/api/comments/get_all/${n[2]}`,method:"get",dataType:"json",success:function(t){let e="";for(let n of t.comments)e+=`\n                    <div class="comment">\n                        <div class="comment-username"><i class="fas fa-comment"></i> ${n.user_username} </div>\n                        <div class="title-comment-top">\n                            <div class="comment-content">\n                                <p> ${n.comment_content} </p>\n                            </div>\n                        </div>\n                        <div class="comment-bottom">\n                            <p> ${n.comment_time} </p>\n                        </div>\n                    </div>\n                    `;$("#movie-comments").html(e)},error:function(t){console.log(t)}})}"admin"==n[0]&&"movies"==n[1]&&l(a),"admin"==n[0]&&"users"==n[1]&&s(a),$("#addMovieBtn").click(function(t){t.preventDefault(),$.ajax({method:"post",url:"http://www.omdbapi.com/?apikey=c59f3948&i="+$("#addMovieId").val(),type:"json",success:function(t){$("#addMovieTitle").val(t.Title),$("#addMoviePosterDefault").val(t.Poster),$("#addMovieRating").val(t.imdbRating),$("#addMovieRuntime").val(t.Runtime),$("#addMovieYear").val(t.Year),$("#addMovieType").val(t.Type),$("#addMovieGenres").val(t.Genre.split(", ").join("/")),$("#addMovieForm").submit()}})}),"movies"==n[0]&&"show"==n[1]&&c(),$("#submit-comment").click(function(e){e.preventDefault(),t(),$.ajax({url:"/api/comments/create",type:"post",dataType:"json",data:{movie_id:$(this).attr("data-movie-id"),user_id:$(this).attr("data-user-id"),text:$("#addCommentTextarea").val()},success:function(t){c(),$("#addCommentTextarea").val("")},error:function(t){console.log(t)}})});let r="",m="imdb_rating",u="asc",f=0,p=16;$("#browseSubmit").click(function(){r=$("#genreSelect").val(),m=$("#sortBySelect").val(),u=$("#sortDirection").val(),f=$("#chooseRating").val(),function e(n,a,o,d,s,l){let c="";t();$.ajax({url:"/api/browse",method:"post",dataType:"json",data:{page:n,genre:a,sort:o,direction:d,rating:s,per_page:l},success:function(t){let n="";for(let e=0;e<t.pages_needed;e++)n+=`<div class="browse-pag" data-id=${e+1}>${e+1}</div>`;$(".pagination").html(n),$(".browse-pag").click(function(){e($(this).attr("data-id"),r,m,u,f,p)});for(let e of t.movies)c+=`\n                    <div class="card">\n                        <div class="image" data-id="${e.imdb_id}">\n                            <img src="${e.poster_url}" alt="poster">\n                            <div class="data">\n                                <p class="thumbnailRating"><span>IMDb</span> ${e.imdb_rating}</p>\n                                <ul class="thumbnailGenres">\n                                <li>${e.genres.join("</li><li>")}</li>\n                                </ul>\n                                <button>Open</button>\n                            </div>\n                        </div>\n                        <p class="thumbnailTitle">${e.title}</p>\n                        <p class="thumbnailYear">${e.release_year}</p>\n                    </div>`;$("#movieGrid").html(c),i()},error:function(t){console.log(t)}})}(a,r,m,u,f,p)}),"browse"==n[0]&&$.ajax({url:"/api/genres",type:"get",dataType:"json",success:function(t){let e='<option value="">All</option>';for(let n of t.genres)e+=`<option value="${n.genre}">${n.genre}</option>`;$("#genreSelect").html(e),$("select").niceSelect()},error:function(t){console.log(t)}}),$("#commentSearch").keyup(function(){!function e(n){$.ajax({url:`/api/comment_search/${n}`,method:"get",type:"json",success:function(i){let a="",o=0;for(let t of i.comments)o++,a+=`\n                    <tr>\n                        <td>${t.comment_id}</td>\n                        <td>${t.comment_content}</td>\n                        <td>${t.user_username}</td>\n                        <td>${t.movie_title}</td>\n                        <td>${t.comment_time}</td>\n                        <td><i class="fas fa-trash-alt deleteBtn deleteCommentBtn" data-id="${t.comment_id}"></i></td>\n                    </tr>\n                    `;0==o&&(a='\n                    <tr>\n                        <td colspan="6">Nema rezultata</td>\n                    </tr>'),$("#admin-comments-table").html(a),$(".deleteCommentBtn").click(function(){t(),$.ajax({url:"/api/comment_delete",method:"post",type:"json",data:{id:$(this).attr("data-id")},success:function(t){console.log(t),e(n)},error:function(t){console.log(t)}})})},error:function(t){console.log(t)}})}($(this).val())});let v=!1;$("#burger").click(function(){v?($("#drawer").slideUp(),v=!1):($("#drawer").slideDown(),v=!0)}),$(window).resize(function(){window.innerWidth>440&&($("#drawer").slideUp(),v=!1)})});