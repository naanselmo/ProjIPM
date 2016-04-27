var total, lastActiveMenuBeforeSearch;

$(document).ready(function () {
  $(".order-item").click(function (e) {
    addOrder($(this).attr("id") + "-order", $(this).find("#name").text(), $(this).find("#price").text());
  });
  // Load last saved order and update total
  loadOrder();
  updateTotal();

  // Key up event for search bar
  // If dynamic it's true it will search while typing, otherwise it will search on enter.
  dynamic = false;
  $('#search').keyup(function (handler) {
    // When it empties, clear the search no matter what
    if (this.value.length === 0) {
      search('');
      return;
    }
    // If its not dynamic wait for user to press enter to make the search
    if (dynamic || handler.keyCode == 13)
      search(this.value);
  });

  // Add change listener to sort select.
  $(".sort-select").change(function (event) {
    // Get the id of the section where the select that fired the event is.
    var section_id = $(this).parents('.order-section').attr("id");
    // Get the selected value.
    var selected_value = $(this).val();
    // Fetch the arguments of the sort functions.
    var args = selected_value.split(";");
    var type = args[0];
    var asc = parseInt(args[1]);

    // Sort based on the parameters fetched.
    switch (type){
      case 'price':
        sortByPrice(section_id, asc);
        break;
      case 'name':
        sortByName(section_id, asc);
    }
  });
});

$(document).on("click", ".cart-add", function (e) {
  addOrder($(this).parents(".order").attr("id"));
});

$(document).on("click", ".cart-remove", function (e) {
  removeOrder($(this).parents(".order").attr("id"));
});

function addOrder(id, name, price) {
  var selector = "#" + id;
  if ($(selector).length) {
    var count = $(selector).find("#count");
    $(selector).find("#count").text(Number(count.text()) + 1);
  } else {
    var clone = $("#blank-order").clone();
    clone.attr("id", id);
    clone.find("#name").text(name);
    clone.find("#price").text(price);
    clone.appendTo("#orders");
  }
  updateTotal();
  saveOrder();
}

function removeOrder(id) {
  var selector = "#" + id;
  var count = $(selector).find("#count");
  if (count.text() > 1) {
    count.text(Number(count.text()) - 1);
  } else {
    $(selector).remove();
  }
  updateTotal();
  saveOrder();
}

/**
 * Removes all orders from cart except the blank-order.
 */
function clearOrders() {
  $('.orders').children().each(function () {
    var order_id = $(this).attr('id');
    if (order_id != 'blank-order') {
      $(this).remove();
    }
  });
  updateTotal();
  saveOrder();
}

/**
 * Updates the total variable based on the count and price of all items in the list that are not the blank-order item.
 */
function updateTotal() {
  var total = 0;
  $('.orders').children().each(function () {
    var order_id = $(this).attr('id');
    if (order_id != 'blank-order') {
      var count = parseInt($(this).find("#count").text());
      var price = parseInt($(this).find("#price").text());
      total += (count * price);
    }
  });
  setTotal(total);
}

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
  if (!$("#foods").hasClass("hidden")) {
    $("#foods").addClass("hidden");
  }
  if (!$("#drinks").hasClass("hidden")) {
    $("#drinks").addClass("hidden");
  }
  if (!$("#others").hasClass("hidden")) {
    $("#others").addClass("hidden");
  }

  // Hide search results.
  hideSearchResults();
}

function showFoods() {
  // Change the highlight to foods menu
  $('.active-option').removeClass('active-option');
  $('#foods-option').addClass('active-option');

  // Change to the foods menu
  if (!$("#main").hasClass("hidden")) {
    $("#main").addClass("hidden");
  }
  if ($("#foods").hasClass("hidden")) {
    $("#foods").removeClass("hidden");
  }
  if (!$("#drinks").hasClass("hidden")) {
    $("#drinks").addClass("hidden");
  }
  if (!$("#others").hasClass("hidden")) {
    $("#others").addClass("hidden");
  }

  // Hide search rsults.
  hideSearchResults();
}

function showDrinks() {
  // Change the highlight to drinks menu
  $('.active-option').removeClass('active-option');
  $('#drinks-option').addClass('active-option');

  // Change to the drinks menu
  if (!$("#main").hasClass("hidden")) {
    $("#main").addClass("hidden");
  }
  if (!$("#foods").hasClass("hidden")) {
    $("#foods").addClass("hidden");
  }
  if ($("#drinks").hasClass("hidden")) {
    $("#drinks").removeClass("hidden");
  }
  if (!$("#others").hasClass("hidden")) {
    $("#others").addClass("hidden");
  }

  // Hide search results.
  hideSearchResults();
}

function showOthers() {
  // Change the highlight to others menu
  $('.active-option').removeClass('active-option');
  $('#others-option').addClass('active-option');

  // Change to the other menu
  if (!$("#main").hasClass("hidden")) {
    $("#main").addClass("hidden");
  }
  if (!$("#foods").hasClass("hidden")) {
    $("#foods").addClass("hidden");
  }
  if (!$("#drinks").hasClass("hidden")) {
    $("#drinks").addClass("hidden");
  }
  if ($("#others").hasClass("hidden")) {
    $("#others").removeClass("hidden");
  }

  // Hide search results.
  hideSearchResults();
}

/**
 * Show the search results menu, and saves the last menu active for restore.
 */
function showSearchResults() {
  // Save the last order-menu not hidden.
  lastActiveMenuBeforeSearch = $('.order-menu').not('.hidden');

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
      case 'drinks':
        showDrinks();
        break;
      case 'foods':
        showFoods();
        break;
      case 'others':
        showOthers();
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
 * Saves an order to the local storage.
 */
function saveOrder() {
  localStorage.setItem('order_state', $('#orders').html());
}

/**
 * Loads an order from the local storage.
 */
function loadOrder() {
  var loaded_html = localStorage.getItem('order_state');
  // Check if loaded order list exists and has blank-order id somewhere
  if (loaded_html !== null && loaded_html.indexOf('blank-order') > -1) {
    $('#orders').html(loaded_html);
  } else {
    console.log('Invalid list loaded. Resetting...');
  }
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
    searchMenu.children('.order-item-wrapper').remove();

    // Search results, filter duplicates and append a clone of them with the same events to the search-results menu.
    var order_items = $('.order-item');
    var filteredIds = {};
    order_items.filter(function () {
      var id = $(this).attr('id');
      // If id is duplicate don't accept it
      if (filteredIds.hasOwnProperty(id))
        return false;

      // If the name in lowercase contains the search string in lowercase, add it to the ids array and accept it.
      if ($(this).find('.order-text #name').text().toLowerCase().indexOf(search.toLowerCase()) > -1) {
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
 * Sorts all order-sections by name.
 * @param order_section_id The id of the section to order.
 * @param asc Either 1 or -1. 1 means sorted by asc order. -1 means sorted by desc order.
 */
function sortByName(order_section_id, asc) {
  $('#'+order_section_id).each(function () {
    $(this).children('.order-item-wrapper').sort(function (a, b) {
      var name_a = $(a).find('.order-item #name').text();
      var name_b = $(b).find('.order-item #name').text();
      return name_a.localeCompare(name_b) * asc;
    }).detach().appendTo($(this));
  });
}

/**
 * Sorts all order-sections by price.
 * @param order_section_id The id of the section to order.
 * @param asc Either 1 or -1. 1 means sorted by asc order. -1 means sorted by desc order.
 */
function sortByPrice(order_section_id, asc) {
  $('#'+order_section_id).each(function () {
    $(this).children('.order-item-wrapper').sort(function (a, b) {
      var price_a = $(a).find('.order-item #price').text();
      var price_b = $(b).find('.order-item #price').text();
      price_a = parseInt(price_a.slice(0, -1));
      price_b = parseInt(price_b.slice(0, -1));
      return (price_a - price_b) * asc;
    }).detach().appendTo($(this));
  });
}
