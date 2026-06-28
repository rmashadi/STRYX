<div class="footer">
    <div class="float-right">
        Version <strong>1.0</strong>
    </div>
    <div>
        <strong>STRYX</strong> &mdash; Threat Response &amp; Assessment &copy; <?= date('Y'); ?>
    </div>
</div>
</div>
</div>

<script src="<?= base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/metisMenu/jquery.metisMenu.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>

<script src="<?= base_url('assets/js/inspinia.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/pace/pace.min.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/toastr/toastr.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/select2/select2.full.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/datapicker/bootstrap-datepicker.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/chosen/chosen.jquery.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins/dataTables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/dataTables/dataTables.bootstrap4.min.js') ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js"></script>

<script>
        $(function () {
            $('.datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                sideBySide: true
            });
        });
    </script>

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $(document).ready(function() {
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-bottom-right',
                showMethod: 'slideDown',
                timeOut: 4000
            };
            <?php if ($this->session->flashdata('add')) { ?>

                toastr.success(' Data <?php echo $title; ?> successfully <strong><?= $this->session->flashdata('add'); ?>');

            <?php } else if ($this->session->flashdata('edit')) { ?>

                toastr.info(' Data <?php echo $title; ?> successfully <strong><?= $this->session->flashdata('edit'); ?>');

            <?php } else if ($this->session->flashdata('delete')) { ?>

                toastr.warning(' Data <?php echo $title; ?> successfully <strong><?= $this->session->flashdata('delete'); ?>');

            <?php } else if ($this->session->flashdata('change')) { ?>

                toastr.info('<strong><?= $this->session->flashdata('change'); ?>');

            <?php } ?>

        }, 1300);

    });

    $(document).ready(function() {
        $('.dataTables').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: []

        });

    });
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
        $('.chosen-select').chosen({
            width: "100%"
        });

    })

    //date

    var mem = $('#tanggal .input-group.date').datepicker({
        startView: 1,
        // startDate: '-1d', // jika mau ke tanggal sebelumnya dibuat minus , jika tidak ,jangan dibuat minus,jika hanya tanggal ini saja maka cuku isikan "1d"
        endDate: '1d',
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy"
    });
</script>


<script>
$(document).ready(function() {
    function updateAsetTables(availableAset, selectedAset) {
        var availableAsetHtml = '';
        var selectedAsetHtml = '';

        $.each(availableAset, function(index, aset) {
            availableAsetHtml += `
                <tr data-name="${aset.nama}">
                    <td><input type="checkbox" name="selected_aset[]" value="${aset.id_aset}"></td>
                    <td>${aset.nama}</td>
                </tr>
            `;
        });

        $.each(selectedAset, function(index, aset) {
            selectedAsetHtml += `
                <tr data-name="${aset.nama}">
                    <td><input type="checkbox" name="selected_aset[]" value="${aset.id_aset}" checked></td>
                    <td>${aset.nama}</td>
                </tr>
            `;
        });

        $('#availableAset').html(availableAsetHtml);
        $('#selectedAset').html(selectedAsetHtml);

        updateSelectAllCheckboxes();
    }

    function updateSelectAllCheckboxes() {
        // Cek status checkbox pada Aset Tersedia
        var availableChecked = $('#availableAsetTable tbody input[type="checkbox"]:checked').length;
        var totalAvailable = $('#availableAsetTable tbody input[type="checkbox"]').length;
        $('#select-all-available').prop('checked', availableChecked === totalAvailable && totalAvailable > 0);

        // Cek status checkbox pada Aset Dipilih
        var selectedChecked = $('#selectedAsetTable tbody input[type="checkbox"]:checked').length;
        var totalSelected = $('#selectedAsetTable tbody input[type="checkbox"]').length;
        $('#select-all-selected').prop('checked', selectedChecked === totalSelected && totalSelected > 0);
    }

    function searchTable(searchInput, tableSelector) {
        var searchTerm = searchInput.val().toLowerCase();
        $(tableSelector + ' tbody tr').each(function() {
            var rowText = $(this).data('name').toLowerCase();
            $(this).toggle(rowText.includes(searchTerm));
        });
    }

    $('#user').on('change', function() {
        var userId = $(this).val();
        if (userId) {
            $.ajax({
                url: '<?= base_url('useraset/getAsetByUser'); ?>',
                method: 'POST',
                data: { user_id: userId },
                success: function(response) {
                    var data = JSON.parse(response);
                    updateAsetTables(data.availableAset, data.selectedAset);
                    $('#selectedUser').val(userId);
                    $('#aset-container').show();
                }
            });
        } else {
            $('#aset-container').hide();
        }
    });

    // Checkbox "Pilih Semua" untuk Aset Tersedia
    $('#select-all-available').on('change', function() {
        var isChecked = $(this).prop('checked');
        $('#availableAsetTable tbody input[type="checkbox"]').prop('checked', isChecked).trigger('change');
    });

    // Checkbox "Pilih Semua" untuk Aset Dipilih
    $('#select-all-selected').on('change', function() {
        var isChecked = $(this).prop('checked');
        $('#selectedAsetTable tbody input[type="checkbox"]').prop('checked', isChecked).trigger('change');
    });

    $(document).on('change', '.available-checkbox', function() {
        var selectedRow = $(this).closest('tr');
        if ($(this).is(':checked')) {
            $('#selectedAset').append(selectedRow);
            selectedRow.find('input[type="checkbox"]').removeClass('available-checkbox').addClass('selected-checkbox').prop('checked', true);
        } else {
            $('#availableAset').append(selectedRow);
            selectedRow.find('input[type="checkbox"]').removeClass('selected-checkbox').addClass('available-checkbox').prop('checked', false);
        }

        updateSelectAllCheckboxes();
    });

    $(document).on('change', '.selected-checkbox', function() {
        var selectedRow = $(this).closest('tr');
        if (!$(this).is(':checked')) {
            $('#availableAset').append(selectedRow);
            selectedRow.find('input[type="checkbox"]').removeClass('selected-checkbox').addClass('available-checkbox').prop('checked', false);
        } else {
            $('#selectedAset').append(selectedRow);
            selectedRow.find('input[type="checkbox"]').removeClass('available-checkbox').addClass('selected-checkbox').prop('checked', true);
        }

        updateSelectAllCheckboxes();
    });


    $('#search-available').on('input', function() {
        searchTable($(this), '#availableAsetTable');
    });

    $('#search-selected').on('input', function() {
        searchTable($(this), '#selectedAsetTable');
    });

    $('#userAsetForm').on('submit', function(e) {
        e.preventDefault(); // Mencegah pengiriman formulir secara default

        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                // alert('Otoritas Aset berhasil diperbarui!');
                $('html, body').animate({ scrollTop: 0 }, 'slow');

                var userId = $('#selectedUser').val();
                if (userId) {
                    $.ajax({
                        url: '<?= base_url('useraset/getAsetByUser'); ?>',
                        method: 'POST',
                        data: { user_id: userId },
                        success: function(response) {
                            var data = JSON.parse(response);
                            updateAsetTables(data.availableAset, data.selectedAset);
                        }
                    });
                }
            }
        });
    });
});
</script>


<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('error')): ?>
            var userId = '<?php echo $this->session->flashdata('user_id'); ?>';
            $('#modalEdit' + userId).modal('show');
        <?php endif; ?>
    });
</script>


</body>

</html>