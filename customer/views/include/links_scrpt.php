<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="la la-chevron-up"></i></a>
<!-- Jquery js-->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap js-->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Ionicons js-->
<script src="../assets/plugins/ionicons/ionicons.js"></script>
<!-- Moment js -->
<script src="../assets/plugins/moment/moment.js"></script>
<!-- P-scroll js -->
<script src="../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../assets/plugins/perfect-scrollbar/p-scroll.js"></script>
<!-- Rating js-->
<script src="../assets/plugins/rating/jquery.rating-stars.js"></script>
<script src="../assets/plugins/rating/jquery.barrating.js"></script>
<!-- Custom Scroll bar Js-->
<script src="../assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- eva-icons js -->
<script src="../assets/js/eva-icons.min.js"></script>
<!-- Sidebar js -->
<script src="../assets/plugins/side-menu/sidemenu.js"></script>
<!-- Right-sidebar js -->
<script src="../assets/plugins/sidebar/sidebar.js"></script>
<script src="../assets/plugins/sidebar/sidebar-custom.js"></script>
<!-- Sticky js-->
<script src="../assets/js/sticky.js"></script>
<!-- Chart.bundle js -->
<script src="../assets/plugins/chart.js/Chart.bundle.min.js"></script>
<!-- Select2.min js -->
<script src="../assets/plugins/select2/js/select2.min.js"></script>
<script src="../assets/js/select2.js"></script>
<!-- Custom js-->
<script src="../assets/js/custom.js"></script>
<!-- Switcher js -->
<script src="../assets/switcher/js/switcher.js"></script>
<script>
   document.getElementById("searchButton").addEventListener("click", function() {
       searchMenuItems();
   });
   
   document.getElementById("searchInput").addEventListener("keyup", function(event) {
       if (event.key === "Enter") {
           searchMenuItems();
       }
   });
   
   
   function searchMenuItems() {
       var input = document.getElementById("searchInput").value.toLowerCase();
       var menuItems = document.querySelectorAll(".side-menu__label");
   
       menuItems.forEach(function(item) {
           var menuItemText = item.textContent.toLowerCase();
           var menuItemParent = item.parentElement.parentElement;
           if (menuItemText.includes(input)) {
               menuItemParent.style.display = "block";
           } else {
               menuItemParent.style.display = "none";
           }
       });
   }
   document.getElementById("mobileSearchButton").addEventListener("click", function() {
    searchMobileMenuItems();
   });
   
   document.getElementById("mobileSearchInput").addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
        searchMobileMenuItems();
    }
   });
   
   function searchMobileMenuItems() {
    var input = document.getElementById("mobileSearchInput").value.toLowerCase();
    var menuItems = document.querySelectorAll(".side-menu__label");
   
    menuItems.forEach(function(item) {
        var menuItemText = item.textContent.toLowerCase();
        var menuItemParent = item.parentElement.parentElement;
        if (menuItemText.includes(input)) {
            menuItemParent.style.display = "block";
        } else {
            menuItemParent.style.display = "none";
        }
    });
   }
</script>