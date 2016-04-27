$(document).ready(function () {
  $(".order-item").click(function(e) {
    addOrder($(this).attr("id") + "-order", $(this).find("#name").text(), $(this).find("#price").text());
  });
  // Load last saved order
  loadOrder();

  // Key up event for search bar
  // If dynamic it's true it will search while typing, otherwise it will search on enter.
  dynamic = false;
  $('#search').keyup(function (handler) {
    // When it empties, clear the search no matter what
    if (this.value.length == 0) {
      search('');
      return;
    }
    // If its not dynamic wait for user to press enter to make the search
    if (dynamic || handler.keyCode == 13)
      search(this.value);
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
  if($(selector).length) {
    var count = $(selector).find("#count");
    $(selector).find("#count").text(Number(count.text()) + 1);
  } else {
    var clone = $("#blank-order").clone();
    clone.attr("id", id);
    clone.find("#name").text(name);
    clone.find("#price").text(price);
    clone.appendTo("#orders");
  }
  saveOrder();
}

function removeOrder(id) {
  var selector = "#" + id;
  var count = $(selector).find("#count");
  if(count.text() > 1) {
    count.text(Number(count.text()) - 1);
  } else {
    $(selector).remove();
  }
  saveOrder();
}

/**
 * Removes all orders from cart except the blank-order.
 */
function clearOrders(){
  $('.orders').children().each(function(){
    var order_id = $(this).attr('id');
    if (order_id != 'blank-order'){
      $(this).remove();
    }
  });
  saveOrder();
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
  $('#orders').html(localStorage.getItem('order_state'));
}

/**
 * Hides the items that don't contain as name the text given. Ignores case.
 */
function search(search) {
  var order_items = $('.order-item');
  order_items.parent().hide();
  order_items.filter(function () {
    return $(this).find('.order-text #name').text().toLowerCase().indexOf(search.toLowerCase()) > -1;
  }).parent().show();
}

/**
 * Sorts all order-sections by name.
 * @param asc Either 1 or -1. 1 means sorted by asc order. -1 means sorted by desc order.
 */
function sortByName(asc) {
  $('.order-section').each(function () {
    $(this).children('.order-item-wrapper').sort(function (a, b) {
      var name_a = $(a).find('.order-item #name').text();
      var name_b = $(b).find('.order-item #name').text();
      return name_a.localeCompare(name_b) * asc;
    }).detach().appendTo($(this));
  });
}

/**
 * Sorts all order-sections by price.
 * @param asc Either 1 or -1. 1 means sorted by asc order. -1 means sorted by desc order.
 */
function sortByPrice(asc) {
  $('.order-section').each(function () {
    $(this).children('.order-item-wrapper').sort(function (a, b) {
      var price_a = $(a).find('.order-item #price').text();
      var price_b = $(b).find('.order-item #price').text();
      price_a = parseInt(price_a.slice(0, -1));
      price_b = parseInt(price_b.slice(0, -1));
      return (price_a - price_b) * asc;
    }).detach().appendTo($(this));
  });
}
