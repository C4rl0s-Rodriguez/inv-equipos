var forms = document.querySelectorAll('.needs-validation');

//Inicializando Toast (avisos)
var Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 2000
});

$(window).resize(function(){//Correccion
    setTimeout(() => {
        $('#tablareg').DataTable()
        .columns.adjust()
        .responsive.recalc();
      }, 100);
    
})

// Codigo Menu Lateral
let contMain = $("#main-cont-reg");
let sidebar = $("#side-nav");
let btnMenu = $(".custom-btn-menu");
let overlay = $(".sidenav-overlay");


btnMenu.on('click', function(){
    sidebar.toggleClass("extend-nav");
    overlay.toggleClass("active-overlay");
    //contMain.toggleClass("margin-main");
});
overlay.on('click', function(){
    sidebar.toggleClass("extend-nav");
    overlay.toggleClass("active-overlay");
    //contMain.toggleClass("margin-main");
});

$(".sbr-links").on("click", function(){
    sidebar.toggleClass("extend-nav");
    overlay.toggleClass("active-overlay");
    //contMain.toggleClass("margin-main");
})
/* $("#sbar-op").on("click", function(){
    if($(window).width() < 768){
        sidebar.classList.toggle("extend-main");
        overlay.classList.toggle("active-overlay");
    } 
}) */