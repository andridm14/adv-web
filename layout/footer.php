<!-- Footer Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded-top p-4">
        <div class="container">
            <div class="text-center text-sm">
                Advisor & Service
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<!-- font awesome -->
<script src="https://kit.fontawesome.com/3e14c363ff.js" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/chart/chart.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
<script src="js/script.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.bootstrap5.min.js"></script>
<script>
    // datatables
    $(document).ready(function() {
        $('#tableIndex').DataTable();
        $('#serTable').DataTable();
        $('#myTables').DataTable();
        $('#tableDetail').DataTable();
        $('#TablePgj').DataTable();
        $('#TableSaran').DataTable();
        $('#tablePkb').DataTable();
        $('#kenTable').DataTable();
    });

    //title
    let docTitle = document.title;
    window.addEventListener("blur", () => {
        document.title = " Come On Back 🚗";
    })
    window.addEventListener("focus", () => {
        document.title = docTitle;
    })
</script>
</body>

</html>