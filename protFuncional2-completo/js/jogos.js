var total, lastActiveMenuBeforeSearch;

$(document).ready(function () {
  // Key up event for search bar
  // If dynamic it's true it will search while typing, otherwise it will search on enter.
  dynamic = true;
  $('#search').keyup(function (handler) {
    // When it empties, clear the search no matter what
    if (this.value.length === 0) {
      search('');
      hideSearchResults();
      return;
    }
    // If its not dynamic wait for user to press enter to make the search
    else if (dynamic || handler.keyCode == 13)
      search(this.value);
  });

  // Add change listener to sort select.
  $(".sort-select").change(function (event) {
    // Get the id of the section where the select that fired the event is.
    var section_id = $(this).parents('.games-section').attr("id");
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
    }
  });
});

/**
 * Sets the total variable to the given one.
 * @param t New total value.
 */
function setTotal(t) {
  total = t;
  console.log(total);
}

function showMain() {
  // Change the highlight to main menu
  $('.active-option').removeClass('active-option');
  $('#main-option').addClass('active-option');

  // Change to the main menu
  if ($("#main").hasClass("hidden")) {
    $("#main").removeClass("hidden");
  }
  if (!$("#singleplayer").hasClass("hidden")) {
    $("#singleplayer").addClass("hidden");
  }
  if (!$("#multiplayer").hasClass("hidden")) {
    $("#multiplayer").addClass("hidden");
  }

  // Hide search results.
  hideSearchResults();
}

function showSingleplayer() {
  // Change the highlight to singleplayer menu
  $('.active-option').removeClass('active-option');
  $('#singleplayer-option').addClass('active-option');

  // Change to the singleplayer menu
  if (!$("#main").hasClass("hidden")) {
    $("#main").addClass("hidden");
  }
  if ($("#singleplayer").hasClass("hidden")) {
    $("#singleplayer").removeClass("hidden");
  }
  if (!$("#multiplayer").hasClass("hidden")) {
    $("#multiplayer").addClass("hidden");
  }

  // Hide search rsults.
  hideSearchResults();
}

function showMultiplayer() {
  // Change the highlight to multiplayer menu
  $('.active-option').removeClass('active-option');
  $('#multiplayer-option').addClass('active-option');

  // Change to the multiplayer menu
  if (!$("#main").hasClass("hidden")) {
    $("#main").addClass("hidden");
  }
  if (!$("#singleplayer").hasClass("hidden")) {
    $("#singleplayer").addClass("hidden");
  }
  if ($("#multiplayer").hasClass("hidden")) {
    $("#multiplayer").removeClass("hidden");
  }

  // Hide search results.
  hideSearchResults();
}

/**
 * Show the search results menu, and saves the last menu active for restore.
 */
function showSearchResults() {
  // Save the last game-menu not hidden.
  lastActiveMenuBeforeSearch = $('.game-menu').not('.hidden');

  // Hide it.
  lastActiveMenuBeforeSearch.addClass('hidden');
  // Hide the active option.
  $('.active-option').removeClass('active-option');

  // Make the search results menu visible.
  $('#search-results').removeClass('hidden');
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
      case 'multiplayer':
        showMultiplayer();
        break;
      case 'singleplayer':
        showSingleplayer();
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
    searchMenu.children('.game-item-wrapper').remove();

    // Search results, filter duplicates and append a clone of them with the same events to the search-results menu.
    var game_items = $('.game-item');
    var filteredIds = {};
    game_items.filter(function () {
      var id = $(this).attr('id');
      // If id is duplicate don't accept it
      if (filteredIds.hasOwnProperty(id))
        return false;

      // If the name in lowercase contains the search string in lowercase, add it to the ids array and accept it.
      if ($(this).find('.game-text #name').text().toLowerCase().indexOf(search.toLowerCase()) > -1) {
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
 * Sorts all game-sections by name.
 * @param game_section_id The id of the section to order.
 * @param asc Either 1 or -1. 1 means sorted by asc order. -1 means sorted by desc order.
 */
function sortByName(game_section_id, asc) {
  $('#'+game_section_id).each(function () {
    $(this).children('.game-item-wrapper').sort(function (a, b) {
      var name_a = $(a).find('.game-item #name').text();
      var name_b = $(b).find('.game-item #name').text();
      return name_a.localeCompare(name_b) * asc;
    }).detach().appendTo($(this));
  });
}
