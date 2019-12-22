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

    $(document).ready(function() {
       $("#auto-disapper").delay(2500).fadeOut();
    });

// Show more activites
$(document).ready(function(){

    var _token = $('input[name="_token"]').val();

    // These two conditions are necessary to get the id from the path correctly
    // at first time after load page.
    if (window.location.href.indexOf('user/') !=-1) 
    { // if it is user page 
        loadUserActivitiesData('', _token);
    }
    else if (window.location.href.indexOf('task/') !=-1)  
    { // if it is task page
        loadTaskActivitiesData('', _token);
    }

// Show more user activites button
    function loadUserActivitiesData( date="", _token)
    {
        var id = window.location.href.substring(window.location.href.indexOf('user/')+5);
        
        //////////
        // $.ajax function:
        // url : Specifies the URL to send the request to.
        // data: Specifies data to be sent to the server
        // success(result,status,xhr): A function to be run when the request succeeds
        $.ajax({
            url:"/user/"+id+"/load_user_activities_data",
            method:"POST",
            data:{updated_at:date, _token:_token},
            success:function(coming_data)
            {
                $('#load_more_user_activities_button').remove();
                $('#post_user_activities').append(coming_data);
            }
        })
    }

    $(document).on('click', '#load_more_user_activities_button', function(){
        var date = $(this).data("updated_at");
        $('#load_more_user_activities_button').html('<b>Loading...</b>');
        loadUserActivitiesData(date, _token);
    });

    // Show more task activites button
    function loadTaskActivitiesData( date="", _token)
    {
        var id = window.location.href.substring(window.location.href.indexOf('task/')+5);

        //////////
        // $.ajax function:
        // url : Specifies the URL to send the request to.
        // data: Specifies data to be sent to the server
        // success(result,status,xhr): A function to be run when the request succeeds
        $.ajax({
            url:"/task/"+id+"/load_task_activities_data",
            method:"POST", 
            data:{updated_at:date, _token:_token},
            success:function(coming_data)
            {
                $('#load_more_task_activities_button').remove();
                $('#post_task_activities').append(coming_data);
            }
        })
    }

    $(document).on('click', '#load_more_task_activities_button', function(){
        var date = $(this).data("updated_at");
        $('#load_more_task_activities_button').html('<b>Loading...</b>');
        loadTaskActivitiesData(date, _token);
    });

    // $('.tsk').select2();
});
