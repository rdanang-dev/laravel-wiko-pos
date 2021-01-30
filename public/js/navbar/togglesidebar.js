// solution 1, troubled
// if (window.matchMedia('(max-width: 768px)').matches)
// {
//     sideBarOpen = false;
//     function openSidebar(){
//         $('#menu-toggle').addClass('open');
//         $('#sidebar').addClass('active');
//         $('#content').addClass('active');
//         $('.wrapper').addClass('active');
//         sideBarOpen = true;
//     }

//     function closeSidebar(){
//         $('#menu-toggle').removeClass('open');
//         $('#sidebar').removeClass('active');
//         $('#content').removeClass('active');
//         $('.wrapper').removeClass('active');
//         sideBarOpen = false;
//     }

//     $('#menu-toggle').on('click', function () {
//         openSidebar();
//     });

//     $('#content').on('click', function () {
//         if(sideBarOpen){
//             closeSidebar();
//         }
//     });
// }


// solution 2 troubled
// $('#menu-toggle').click(function(e){
//     e.stopPropagation();
//     $('#menu-toggle').toggleClass('open');
//     $('#sidebar').toggleClass('active');
//     $('.wrapper').toggleClass('active');
//     $('#content').toggleClass('active');
// });

// $('#content').click(function (e){
//     e.stopPropagation();
//     $(this).removeClass('active');
//     $('#sidebar').removeClass('active');
//     $('.wrapper').removeClass('active');
//     $('#menu-toggle').removeClass('open');
// })


// solution 3 rada troubled kalo ga di refresh
// if (window.matchMedia('(min-width: 800px)').matches){
//     $('#menu-toggle').click(function(e){
//         $('#menu-toggle').toggleClass('open');
//         $('#sidebar').toggleClass('active');
//         $('.wrapper').toggleClass('active');
//         $('#content').toggleClass('active');
//     });
// }
// if (window.matchMedia('(max-width: 768px)').matches)
// {
//     $('#menu-toggle').click(function(e){
//         e.stopPropagation();
//         $('#menu-toggle').toggleClass('open');
//         $('#sidebar').toggleClass('active');
//         $('.wrapper').toggleClass('active');
//         $('#content').toggleClass('active');
//     });

//     $('#content').click(function (e){
//         e.stopPropagation();
//         $(this).removeClass('active');
//         $('#sidebar').removeClass('active');
//         $('.wrapper').removeClass('active');
//         $('#menu-toggle').removeClass('open');
//     })
// }


if (window.matchMedia('(max-width: 768px)').matches)
{
    $('#menu-toggle').click(function(e){
        e.stopPropagation();
        $('#menu-toggle').toggleClass('open');
        $('#sidebar').toggleClass('active');
        $('.wrapper').toggleClass('active');
        $('#content').toggleClass('active');
    });

    $('#content').click(function (e){
        e.stopPropagation();
        $(this).removeClass('active');
        $('#sidebar').removeClass('active');
        $('.wrapper').removeClass('active');
        $('#menu-toggle').removeClass('open');
    })
} else {
    $('#menu-toggle').click(function(e){
        $('#sidebar').toggleClass('active');
        $('.wrapper').toggleClass('active');
        $('#content').toggleClass('active');
    });
}
