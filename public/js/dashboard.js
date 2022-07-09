$(document).ready(function(){
    $('#sidebar').css('height', $(window).height() - $('#navbar').height() - 16);
    $('#sidebarBtn').click(function(){
        $('.sidebar').toggleClass('fliph');
    });
});
