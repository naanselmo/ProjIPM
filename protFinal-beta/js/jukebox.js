var total, lastActiveMenuBeforeSearch;

$(document).ready(function () {
  $(".song-item").click(function (e) {
    addPlaylist($(this).attr("id") + "-song", $(this).find("#name").text(), $(this).find("#author").text());
  });

  // Load last saved playlist
  loadPlaylist();
  sortPlaylistByVotesAscendant();

  // Key up event for search bar
  // If dynamic it's true it will search while typing, otherwise it will search on enter.
  dynamic = true;
  $('#search').keyup(function (handler) {
    // When it empties, clear the search no matter what
    if (this.value.length === 0) {
      search('');
      return;
    }
    // If its not dynamic wait for user to press enter to make the search
    else if (dynamic || handler.keyCode == 13)
      search(this.value);
  });

  // Add change listener to sort select.
  $(".sort-select").change(function (event) {
    // Get the id of the menu where the select that fired the event is.
    var section_id = $(this).parents('.song-menu').attr("id");
    // Get the selected value.
    var selected_value = $(this).val();
    // Fetch the arguments of the sort functions.
    var args = selected_value.split(";");
    var type = args[0];
    var asc = parseInt(args[1]);

    // Sort based on the parameters fetched.
    switch (type){
      case 'name':
        sortByName(section_id, asc);
        break;
      case 'author':
        sortByAuthor(section_id, asc);
        break;
      case 'date':
        sortByDate(section_id, asc);
    }
  });
});

$(document).on("click", ".fa-thumbs-o-down", function (e) {
  $(this).removeClass("fa-thumbs-o-down");
  $(this).addClass("fa-thumbs-down");
  thumbsDown($(this).parents(".playlist-item").attr("id"));
});

$(document).on("click", ".fa-thumbs-down", function (e) {
  $(this).removeClass("fa-thumbs-down");
  $(this).addClass("fa-thumbs-o-down");
  addScore($(this).parents(".playlist-item").attr("id"));
});

$(document).on("click", ".fa-thumbs-o-up", function (e) {
  $(this).removeClass("fa-thumbs-o-up");
  $(this).addClass("fa-thumbs-up");
  thumbsUp($(this).parents(".playlist-item").attr("id"));
});

$(document).on("click", ".fa-thumbs-up", function (e) {
  $(this).removeClass("fa-thumbs-up");
  $(this).addClass("fa-thumbs-o-up");
  removeScore($(this).parents(".playlist-item").attr("id"));
});

function thumbsUp(id, name, author) {
  addScore(id, name, author);

  var selector = "#" + id;
  var thumbsDown = $(selector).find(".fa-thumbs-down");
  console.log(thumbsDown);
  if (thumbsDown.length) {
    thumbsDown.removeClass("fa-thumbs-down");
    thumbsDown.addClass("fa-thumbs-o-down");
    addScore(id, name, author);
  }
}

function thumbsDown(id, name, author) {
  removeScore(id, name, author);

  var selector = "#" + id;
  var thumbsUp = $(selector).find(".fa-thumbs-up");
  if (thumbsUp.length) {
    thumbsUp.removeClass("fa-thumbs-up");
    thumbsUp.addClass("fa-thumbs-o-up");
    removeScore(id, name, author);
  }
}

function addPlaylist(id, name, author) {
  var selector = "#" + id;

  if ($(selector).length === 0) {
    addScore(id, name, author);
  } else {
    var thumbsUp = $(selector).find("#thumbs-up");
    if (thumbsUp.hasClass("fa-thumbs-o-up")) {
      thumbsUp.removeClass("fa-thumbs-o-up");
      thumbsUp.addClass("fa-thumbs-up");
      thumbsUp($(this).parents(".playlist-item").attr("id"));
    }
  }
}

function addScore(id, name, author) {
  var selector = "#" + id;
  if ($(selector).length) {
    var score = $(selector).find("#score");
    $(selector).find("#score").text(Number(score.text()) + 1);
  } else {
    var clone = $("#blank-song").clone();
    clone.attr("id", id);
    if (name.length >= 18) {
      clone.find("#name").text(name.substring(0, 15) + "...");
    } else {
      clone.find("#name").text(name);
    }
    if (author.length >= 13) {
      clone.find("#author").text(author.substring(0, 10) + "...");
    } else {
      clone.find("#author").text(author);
    }
    clone.appendTo("#playlist");
  }
  sortPlaylistByVotesAscendant();
  savePlaylist();
}

function removeScore(id) {
  var selector = "#" + id;
  var score = $(selector).find("#score");
  if (score.text() > 0) {
    score.text(Number(score.text()) - 1);
  } else {
    $(selector).remove();
  }
  sortPlaylistByVotesAscendant();
  savePlaylist();
}

function showMain() {
  // Change the highlight to main menu
  $('.active-option').removeClass('active-option');
  $('#main-option').addClass('active-option');

  // Change to the classic menu
  if ($("#main").hasClass("hidden")) {
    $("#main").removeClass("hidden");
  }
  if (!$("#classic").hasClass("hidden")) {
    $("#classic").addClass("hidden");
  }
  if (!$("#rock").hasClass("hidden")) {
    $("#rock").addClass("hidden");
  }
  if (!$("#punk").hasClass("hidden")) {
    $("#punk").addClass("hidden");
  }
  if (!$("#pop").hasClass("hidden")) {
    $("#pop").addClass("hidden");
  }

  // Hide search results.
  hideSearchResults();
}

function showClassic() {
  // Change the highlight to singleplayer menu
  $('.active-option').removeClass('active-option');
  $('#classic-option').addClass('active-option');

  // Change to the classic menu
  if (!$("#main").hasClass("hidden")) {
    $("#main").addClass("hidden");
  }
  if ($("#classic").hasClass("hidden")) {
    $("#classic").removeClass("hidden");
  }
  if (!$("#rock").hasClass("hidden")) {
    $("#rock").addClass("hidden");
  }
  if (!$("#punk").hasClass("hidden")) {
    $("#punk").addClass("hidden");
  }
  if (!$("#pop").hasClass("hidden")) {
    $("#pop").addClass("hidden");
  }

  // Hide search rsults.
  hideSearchResults();
}

function showRock() {
  // Change the highlight to singleplayer menu
  $('.active-option').removeClass('active-option');
  $('#rock-option').addClass('active-option');

  // Change to the rock menu
  if (!$("#main").hasClass("hidden")) {
    $("#main").addClass("hidden");
  }
  if (!$("#classic").hasClass("hidden")) {
    $("#classic").addClass("hidden");
  }
  if ($("#rock").hasClass("hidden")) {
    $("#rock").removeClass("hidden");
  }
  if (!$("#punk").hasClass("hidden")) {
    $("#punk").addClass("hidden");
  }
  if (!$("#pop").hasClass("hidden")) {
    $("#pop").addClass("hidden");
  }

  // Hide search rsults.
  hideSearchResults();
}

function showPunk() {
  // Change the highlight to singleplayer menu
  $('.active-option').removeClass('active-option');
  $('#punk-option').addClass('active-option');

  // Change to the punk menu
  if (!$("#main").hasClass("hidden")) {
    $("#main").addClass("hidden");
  }
  if (!$("#classic").hasClass("hidden")) {
    $("#classic").addClass("hidden");
  }
  if (!$("#rock").hasClass("hidden")) {
    $("#rock").addClass("hidden");
  }
  if ($("#punk").hasClass("hidden")) {
    $("#punk").removeClass("hidden");
  }
  if (!$("#pop").hasClass("hidden")) {
    $("#pop").addClass("hidden");
  }

  // Hide search rsults.
  hideSearchResults();
}

function showPop() {
  // Change the highlight to singleplayer menu
  $('.active-option').removeClass('active-option');
  $('#pop-option').addClass('active-option');

  // Change to the pop menu
  if (!$("#main").hasClass("hidden")) {
    $("#main").addClass("hidden");
  }
  if (!$("#classic").hasClass("hidden")) {
    $("#classic").addClass("hidden");
  }
  if (!$("#rock").hasClass("hidden")) {
    $("#rock").addClass("hidden");
  }
  if (!$("#punk").hasClass("hidden")) {
    $("#punk").addClass("hidden");
  }
  if ($("#pop").hasClass("hidden")) {
    $("#pop").removeClass("hidden");
  }

  // Hide search rsults.
  hideSearchResults();
}

/**
 * Show the search results menu, and saves the last menu active for restore.
 */
function showSearchResults() {
  // Save the last song-menu not hidden.
  var temp = $('.song-menu').not('.hidden').not("#search-results");

  if (temp.length !== 0) {
    lastActiveMenuBeforeSearch = temp;

    console.log(lastActiveMenuBeforeSearch);

    // Hide it.
    lastActiveMenuBeforeSearch.addClass('hidden');
    // Hide the active option.
    $('.active-option').removeClass('active-option');

    // Make the search results menu visible.
    $('#search-results').removeClass('hidden');
  }
}

/**
 * Restores from search result.
 */
function restoreFromSearch() {
  // Restores only if search menu is visible.
  if (!$('#search-results').hasClass('hidden')) {
    // Get the id of the last active menu before search.
    var lastActiveMenuBeforeSearchId = lastActiveMenuBeforeSearch.attr('id');
    // Switch all the ids and show the correct menu for that id.
    switch (lastActiveMenuBeforeSearchId) {
      case 'main':
        showMain();
        break;
      case 'classic':
        showClassic();
        break;
      case 'rock':
        showRock();
        break;
      case 'punk':
        showPunk();
        break;
      case 'pop':
        showPop();
        break;
    }
  }
}

/**
 * Hides the search results.
 */
function hideSearchResults() {
  // Hide the search results menu.
  $('#search-results').addClass('hidden');
}

/**
 * Shows search results for the given search input. If search('') is called clears the results and goes back to the last menu active.
 * Ignores case.
 */
function search(search) {
  if (search !== '') {
    // If people are searching...
    searchMenu = $('#search-results');

    // Clear last search
    searchMenu.children('.song-item-wrapper').remove();

    // Search results, filter duplicates and append a clone of them with the same events to the search-results menu.
    var song_items = $('.song-item');
    var filteredIds = {};
    song_items.filter(function () {
      var id = $(this).attr('id');
      // If id is duplicate don't accept it
      if (filteredIds.hasOwnProperty(id))
        return false;

      // If the name in lowercase contains the search string in lowercase, add it to the ids array and accept it.
      if ($(this).find('.song-text #name').text().toLowerCase().indexOf(search.toLowerCase()) > -1) {
        filteredIds[id] = true;
        return true;
      }
    }).parent().clone(true, true).appendTo(searchMenu);

    // Show the search results
    showSearchResults();
  } else {
    // If people are not searching, restore from search.
    restoreFromSearch();
  }
}

/**
 * Sorts all song-sections by name within a given song-menu.
 * @param song_menu_id The id of the menu to order.
 * @param asc Either 1 or -1. 1 means sorted by asc order. -1 means sorted by desc order.
 */
function sortByName(song_menu_id, asc) {
  var childrenAndSelf = $('#' + song_menu_id).children('.song-section').andSelf().filter('.song-section');
  childrenAndSelf.each(function () {
    $(this).children('.song-item-wrapper').sort(function (a, b) {
      var name_a = $(a).find('.song-item #name').text();
      var name_b = $(b).find('.song-item #name').text();
      return name_a.localeCompare(name_b) * asc;
    }).detach().appendTo($(this));
  });
}

/**
 * Sorts all song-sections by author within a given song-menu.
 * @param song_menu_id The id of the menu to order.
 * @param asc Either 1 or -1. 1 means sorted by asc order. -1 means sorted by desc order.
 */
function sortByAuthor(song_menu_id, asc) {
  var childrenAndSelf = $('#' + song_menu_id).children('.song-section').andSelf().filter('.song-section');
  childrenAndSelf.each(function () {
    $(this).children('.song-item-wrapper').sort(function (a, b) {
      var name_a = $(a).find('.song-item #author').text();
      var name_b = $(b).find('.song-item #author').text();
      return name_a.localeCompare(name_b) * asc;
    }).detach().appendTo($(this));
  });
}

/**
 * Sorts all song-sections by date within a given song-menu.
 * @param song_menu_id The id of the menu to order.
 * @param asc Either 1 or -1. 1 means sorted by asc order. -1 means sorted by desc order.
 */
function sortByDate(song_menu_id, asc) {
  var childrenAndSelf = $('#' + song_menu_id).children('.song-section').andSelf().filter('.song-section');
  childrenAndSelf.each(function () {
    $(this).children('.song-item-wrapper').sort(function (a, b) {
      var name_a = $(a).find('.song-item #date').text();
      var name_b = $(b).find('.song-item #date').text();
      return name_a.localeCompare(name_b) * asc;
    }).detach().appendTo($(this));
  });
}

/**
 * Sorts the playlist by votes, in ascendant way.
 */
function sortPlaylistByVotesAscendant(){
  var playlist = $('.playlist');
  playlist.children('.playlist-item').sort(function (a, b) {
    var name_a = $(a).find('#score').text();
    var name_b = $(b).find('#score').text();
    return name_a.localeCompare(name_b) * -1;
  }).detach().appendTo(playlist);
}

/**
 * Saves the playlist to the local storage.
 */
function savePlaylist() {
  localStorage.setItem('playlist_state', $('#playlist').html());
}

/**
 * Loads the playlist from the local storage.
 */
function loadPlaylist() {
  var loaded_html = localStorage.getItem('playlist_state');
  // Check if loaded order list exists and has blank-order id somewhere
  if (loaded_html !== null && loaded_html.indexOf('blank-song') > -1) {
    $('#playlist').html(loaded_html);
  } else {
    console.log('Invalid list loaded. Resetting...');
    // Make some random votes
    loadRandomVotes(randomInt(2, 5), 5);
  }
}

/**
 * Loads random votes
 * @param number of songs.
 * @param maxVotes Maximum numbers of vote a song can have.
 */
function loadRandomVotes(number, maxVotes){
  $('.song-item').sort(function(){
    return Math.round(Math.random())-0.5
  }).slice(0, number).each(function () {
      var id = $(this).attr("id") + "-song";
      var name = $(this).find("#name").text();
      var author = $(this).find("#author").text();
      // Add as many score as requested
      for(var i = 0; i < randomInt(0, maxVotes); i++){
        addScore(id, author, name);
      }
      // Remove the thumbs up
      var element = $('#'+id).find("#thumbs-up");
      element.removeClass("fa-thumbs-up");
      element.addClass("fa-thumbs-o-up");
  });
  sortPlaylistByVotesAscendant();
}

/**
 * Finds a random int
 * @param min value
 * @param max value
 * @returns {number} generated number
 */
function randomInt(min,max)
{
  return Math.floor(Math.random()*(max-min+1)+min);
}