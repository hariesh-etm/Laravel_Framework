<!doctype html>
<html lang="en">
  <head>
    @include('admin.meta_header')
  </head>
  <body>
    <div class="main-container-wkr">
    @include('admin.topnav')
       @include('admin.sidenav')
      <div class="home-section">
      <div class="container-fluid" id="main-content">
        @yield('content')
        </div>



</div>

    <div class="footer" style="background-color: #ddd;">
    Footer
    </div>

    </div>



    <script>
    //   let arrow = document.querySelectorAll(".icon-link1");
    //   for (var i = 0; i < arrow.length; i++) {
    //       arrow[i].addEventListener("click", (e) => {
    //           //let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
    //           let arrowParent = e.target.parentElement.parentElement.parentElement;//selecting main parent of arrow
    //           console.log(e.target.parentElement.parentElement.parentElement);
    //           arrowParent.classList.toggle("showMenu");
    //       });
    //   }
    //   let sidebar = document.querySelector(".sidebar");
    //   let sidebarBtn = document.querySelector(".fa-bars");
    //   console.log(sidebarBtn);
    //   sidebarBtn.addEventListener("click", () => {
    //       sidebar.classList.toggle("close");
    //   });

    //   window.onscroll = function () {
    //       myFunction()
    //   };

    //   var navbar = document.getElementById("navbar");
    //   var sticky = navbar.offsetTop;

    //   function myFunction() {
    //       if (window.pageYOffset >= sticky) {
    //           navbar.classList.add("sticky")
    //       } else {
    //           navbar.classList.remove("sticky");
    //       }
    //   }


            let arrow = document.querySelectorAll(".icon-link1");
            for (var i = 0; i < arrow.length; i++) {
                arrow[i].addEventListener("click", (e) => {
                    if (e.target.tagName == "I") {
                        let arrowParent = e.target.parentElement.parentElement;
                        arrowParent.classList.toggle("showMenu");
                    } else {
                        let arrowParent = e.target.parentElement.parentElement.parentElement;
                        arrowParent.classList.toggle("showMenu");
                    }
                  console.log( e.target.tagName);
                    //let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
                    // let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
                    // console.log(e.target.parentElement.parentElement.parentElement);
                });
            }
            let sidebar = document.querySelector(".sidebar");
            let sidebarBtn = document.querySelector(".fa-bars");
            console.log(sidebarBtn);
            sidebarBtn.addEventListener("click", () => {
                sidebar.classList.toggle("close");
            });

            window.onscroll = function () {
                myFunction()
            };

            var navbar = document.getElementById("navbar");
            var sticky = navbar.offsetTop;

            function myFunction() {
                if (window.pageYOffset >= sticky) {
                    navbar.classList.add("sticky")
                } else {
                    navbar.classList.remove("sticky");
                }
            }

  </script>


 <!-- third party js -->
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net/js/jquery.dataTables.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/datatables.net-select/js/dataTables.select.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/pdfmake/build/pdfmake.min.js"></script>
 <script src="<?=url('/')?>/assets/datatable/libs/pdfmake/build/vfs_fonts.js"></script>
 <!-- third party js ends -->

 <!-- Datatables init -->
 <script src="<?=url('/')?>/assets/datatable/js/datatables.init.js"></script>
  </body>
</html>
