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