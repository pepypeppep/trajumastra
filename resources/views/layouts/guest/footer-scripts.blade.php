<script src='assets/libs/choices.js/public/assets/scripts/choices.min.js'></script>
<script src="assets/libs/@popperjs/core/umd/popper.min.js"></script>
<script src="assets/libs/tippy.js/tippy-bundle.umd.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/prismjs/prism.js"></script>
<script src="assets/libs/lucide/umd/lucide.js"></script>
<script src="assets/js/tailwick.bundle.js"></script>
<script src="assets/libs/swiper/swiper-bundle.min.js"></script>
<script src="assets/libs/aos/aos.js"></script>

<script src="assets/js/pages/landing-product.init.js"></script>


<script src="assets/js/datatables/jquery-3.7.0.js"></script>
<script src="assets/js/datatables/data-tables.min.js"></script>
<script src="assets/js/datatables/data-tables.tailwindcss.min.js"></script>
<script>
    $(document).ready(function() {
        new DataTable('.dataTables', {
            language: {
                searchPlaceholder: "Cari",
                search: "Cari",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                infoFiltered: "(Difilter dari _MAX_ entri)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya",
                },
            },
        });
    });
</script>
