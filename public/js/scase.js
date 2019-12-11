// $(document).ready(function(){
//   $("#logwork").click(function(){
//     $("#logwork_form").toggle(500);
//   });
// });

// $(document).ready(function(){
//   $("#show_logworks").click(function(){
//     var id = $("#hidden_task_id").text();
//     $("#logworks_shower").load("/logworks/",id);
//   });
// });

// $(document).ready(function(){
//     $("#q1").click(function(){
//         $("#summery_tab").removeClass("active");
//     });
// });

function removeActiveClass(id) {
    document.getElementById(id).classList.remove('active');
}

//Get the button:
mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

//exel page
$(document).ready(function(){
  $(".tsk").select2({ 
      templateResult: formatSingleResult
  })
  $(".usr").select2({ 
      templateResult: formatSingleResult2
  })
          });
  
  function formatSingleResult(result) {
      var term =$(".tsk").data("select2").dropdown.$search.val();
      var reg = new RegExp(term, 'gi');
      var optionText = result.text;
      var boldTermText = optionText.replace(reg, function(optionText) {return `<b>${optionText}</b>`});
      var $item = $(`<span> ${boldTermText}  </span>`);
      return $item;
  }
  function formatSingleResult2(result) {
      var term =$(".usr").data("select2").dropdown.$search.val();
      var reg = new RegExp(term, 'gi');
      var optionText = result.text;
      var boldTermText = optionText.replace(reg, function(optionText) {return `<b>${optionText}</b>`});
      var $item = $(`<span> ${boldTermText}  </span>`);
      return $item;
  }

  $(document).ready(function(){
    $('#EndDate').datepicker({
      uiLibrary: 'bootstrap4',
      format: 'yyyy-mm-dd'
     });
    $('#StartDate').datepicker({
      uiLibrary: 'bootstrap4',
      format: 'yyyy-mm-dd'
     });
                  });
