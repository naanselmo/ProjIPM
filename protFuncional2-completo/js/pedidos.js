$(document).ready(function () {
  $(".order-item").click(function(e) {
    addOrder($(this).attr("id") + "-order", $(this).find("#name").text(), $(this).find("#price").text());
  });
  loadOrder();
});

$(document).on("click",".cart-add",function(e){
  addOrder($(this).parents(".order").attr("id"));
});

$(document).on("click",".cart-remove",function(e){
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

function showMain() {
  if($("#main").hasClass("hidden")){
      $("#main").removeClass("hidden");
  }
  if(!$("#foods").hasClass("hidden")){
      $("#foods").addClass("hidden");
  }
  if(!$("#drinks").hasClass("hidden")){
      $("#drinks").addClass("hidden");
  }
  if(!$("#others").hasClass("hidden")){
      $("#others").addClass("hidden");
  }
}

function showFoods() {
  if(!$("#main").hasClass("hidden")){
      $("#main").addClass("hidden");
  }
  if($("#foods").hasClass("hidden")){
      $("#foods").removeClass("hidden");
  }
  if(!$("#drinks").hasClass("hidden")){
      $("#drinks").addClass("hidden");
  }
  if(!$("#others").hasClass("hidden")){
      $("#others").addClass("hidden");
  }
}

function showDrinks() {
  if(!$("#main").hasClass("hidden")){
      $("#main").addClass("hidden");
  }
  if(!$("#foods").hasClass("hidden")){
      $("#foods").addClass("hidden");
  }
  if($("#drinks").hasClass("hidden")){
      $("#drinks").removeClass("hidden");
  }
  if(!$("#others").hasClass("hidden")){
      $("#others").addClass("hidden");
  }
}

function showOthers() {
  if(!$("#main").hasClass("hidden")){
      $("#main").addClass("hidden");
  }
  if(!$("#foods").hasClass("hidden")){
      $("#foods").addClass("hidden");
  }
  if(!$("#drinks").hasClass("hidden")){
      $("#drinks").addClass("hidden");
  }
  if($("#others").hasClass("hidden")){
      $("#others").removeClass("hidden");
  }
}

function saveOrder(){
  localStorage.setItem('order_state', $('#orders').html());
}

function loadOrder(){
  $('#orders').html(localStorage.getItem('order_state'));
}
