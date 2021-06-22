@extends('layouts/main')
@section('sadrzaj')
<div id="browseFilters">
    <div name="" class="mySelect" id="">
        <div id="genreDropdownBtn" class="mySelectBtn"><p>Genre</p><i class="fas fa-caret-down"></i></div>
        <div class="mySelectOptions" id="genreSelect"></div>
    </div>
    <div name="" class="mySelect" id="">
        <div id="sortByDropdownBtn" class="mySelectBtn"><p>Sort by</p><i class="fas fa-caret-down"></i></div>
        <div class="mySelectOptions">
            <div data-option="title" class="mySelectOption sortByOption" style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;"
                 unselectable="on"
                 onselectstart="return false;"
                 onmousedown="return false;">Title</div>
            <div data-option="imdb_rating" class="mySelectOption sortByOption" style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;"
                 unselectable="on"
                 onselectstart="return false;"
                 onmousedown="return false;">Rating</div>
            <div data-option="added_at" class="mySelectOption sortByOption" style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;"
                 unselectable="on"
                 onselectstart="return false;"
                 onmousedown="return false;">Date added</div>
            <div data-option="release_year" class="mySelectOption sortByOption" style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;"
                 unselectable="on"
                 onselectstart="return false;"
                 onmousedown="return false;">Year released</div>
        </div>
    </div>
    <div class="browseButtons">
        <div class="sortDirectionBtn sortAsc" data-option="asc"><i class="fas fa-sort-amount-up-alt"></i></div>
        <div class="sortDirectionBtn sortDesc" data-option="desc"><i class="fas fa-sort-amount-down-alt"></i></div>
    </div>
    <div class="browseRating">
        <div class="chosenRating">0+</div>
        <div class="ratingControls">
            <div class="ratingUp" data-option="plus"><i class="fas fa-plus"></i></div>
            <div class="ratingDown" data-option="minus"><i class="fas fa-minus"></i></div>
        </div>
    </div>
    <button id="browseSubmit">Apply</button>
</div>
<div id="movieGrid">

</div>
<div class="pagination"></div>
@endsection
