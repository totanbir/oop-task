// Most of this code is from the first speakeasy project

var template = function(text) {
  return '<p><input type="checkbox"><i class="glyphicon glyphicon-star"></i><span>' + text + '</span><i class="glyphicon glyphicon-remove"></i></p>';
};

var main = function() {
  $('form').submit(function() {
    var text = $('#todo').val();
    var html = template(text);
    $(".list").append(html);
    $('#todo').attr("value", "");
    return false;
  });

  // must target element present when document loads
  // otherwise, you can't assign events to elements that jquery appends to the DOM
  // that's why we use .list here
  $('.list').on('click', '.glyphicon-star', function(){
    $(this).toggleClass('active');
  })

  // same goes for below
  $('.list').on('click','.glyphicon-remove', function(){
    $(this).closest('p').remove();
  });

// add used in annyang setup
  function add(item){
    var html = template(item);
    $(".list").append(html);
    $('#todo').attr("value", "");
  }
  
// delete item with annyang
  function deleteItem(item){
    var item = item.trim(); 
    var taskList = $('.list').find('span');
    for(i = 0; i < taskList.length; i++){
      var currentItem = $(taskList[i]).html().toLowerCase();
      if(item === currentItem){
        $(taskList[i]).parent().remove(); 
      }
    }
  };

  // annyang : "whatever you hear after 'add' consider input for the add function"
  var commands = {
    'add *term': add, 
    'delete *term': deleteItem,
    'remove *term': deleteItem
  };

  annyang.addCommands(commands);
  annyang.start();

};

$(document).ready(main);