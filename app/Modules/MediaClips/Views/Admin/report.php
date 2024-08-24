<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Report Generator</h4>

            </div>
            <div class="card-body">

                <?php
                echo form_open(current_url())
                ?>
                <table class="table">
                    <tr>
                        <th>Category</th>
                        <th>Date From</th>
                        <th>Date To</th>
                        <th>Media House</th>
                        <th>Client</th>
                        <th>Action</th>
                    </tr>

                    <tr>
                        <td>
                            <?php
                            $categories = [1 => 'All Categories', 2 => 'Media Clips', 3 => 'Print Media'];
                            echo form_dropdown('category', $categories, '', 'class="form-control select2"') ?>
                        </td>

                        <td>
                            <input type="date" name="from" class="form-control">
                        </td>
                        <td>
                            <input type="date" name="to" class="form-control">
                        </td>
                        <td>
                            <?php
                            echo form_dropdown('media_house', ['' => 'All Media Houses'] +  $mediahouses, '', 'class="form-control select2"') ?>
                        </td>

                        <td>
                            <?php
                            echo form_dropdown('client', ['' => 'All Clients'] +  $clients, '', 'class="form-control select2"') ?>
                        </td>

                        <td>
                            <button class="btn btn-primary btn-sm" id="filter"><i data-feather="search" class="icon-lg"></i></button>
                            <button class="btn btn-success btn-sm"><i data-feather="printer" class="icon-lg"></i></button>
                            <button class="btn btn-warning btn-sm" id="excel" type="button"><i data-feather="file" class="icon-lg"></i></button>
                        </td>
                    </tr>
                </table>

                <?php echo form_close() ?>

                <table id="reports" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Title</th>
                            <th>Media House</th>
                            <th>Slot</th>
                            <th>Duration</th>
                            <th>..</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


<script>
    $(document).ready(function() {
        var table = $('#reports').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('AjaxDataSources/media_clips/FetchReport') ?>",
                "type": "POST",
                "data": function(d) {
                    d.category = $('select[name="category"]').val();
                    d.from = $('input[name="from"]').val();
                    d.to = $('input[name="to"]').val();
                    d.media_house = $('select[name="media_house"]').val();
                    d.client = $('select[name="client"]').val();
                }
            },
            "columns": [{
                    "data": null
                }, // This will be for the index/serial number
                {
                    "data": "date"
                },
                {
                    "data": "client"
                },
                {
                    "data": "title"
                },
                {
                    "data": "media"
                },
                {
                    "data": "slot"
                },
                {
                    "data": "duration"
                },
                {
                    "data": null,
                    "orderable": false,
                    "searchable": false,
                    "render": function(data, type, row) {
                        return `
                        <a href="<?= base_url('admin/media_clips/view/') ?>${row.id}" class="btn btn-primary btn-sm">View</a>
                    `;
                    },
                    "className": "text-end"
                }
            ],
            "order": [
                [1, 'asc']
            ], // Sort by Date
            "columnDefs": [{
                "targets": 0,
                "render": function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // Add row numbering
                }
            }]
        });

        $('#filter').on('click', function(e) {
            e.preventDefault();
            table.ajax.reload();
        });
    });


    // data export and create csv
    document.getElementById('excel').addEventListener('click', function() {
        // Get filter values from the form (you might need to adjust the selectors)
        const category = document.querySelector('[name="category"]').value;
        const from = document.querySelector('[name="from"]').value;
        const to = document.querySelector('[name="to"]').value;
        const mediaHouse = document.querySelector('[name="media_house"]').value;
        const client = document.querySelector('[name="client"]').value;

        // Create a form to submit the data
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= base_url('AjaxDataSources/media_clips/ExportReportCSV') ?>'; // Adjust the URL accordingly

        // Add form fields
        const fields = {
            category,
            from,
            to,
            media_house: mediaHouse,
            client
        };
        for (const name in fields) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = name;
            input.value = fields[name];
            form.appendChild(input);
        }

        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    });
</script>

<?php echo $this->endSection(); ?>