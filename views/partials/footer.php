    </div> <!-- layoutSidenav_content -->
</div> <!-- layoutSidenav -->

<!-- JS Bootstrap & Custom -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/web-2-project/public/js/scripts.js"></script>

<!-- DataTables Script -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script>
    window.addEventListener('DOMContentLoaded', event => {
        const datatablesSimple = document.getElementById('datatablesSimple');
        if (datatablesSimple) {
            new simpleDatatables.DataTable(datatablesSimple);
        }
    });
</script>

</body>

</html>