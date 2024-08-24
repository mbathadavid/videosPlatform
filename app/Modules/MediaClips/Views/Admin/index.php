<?php echo $this->extend('layouts/admin/default'); ?>
<?php echo $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Media Clips</h4>

            </div>
            <div class="card-body">

              

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
        $('#reports').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= base_url('AjaxDataSources/media_clips/FetchReport') ?>",
                "type": "POST"
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
                            <a href="<?= base_url('admin/media_clips/view/') ?>${row.id}" class="btn btn-primary btn-sm">View
                            </a>
                           
                        `;
                    },
                    "className": "text-end"
                }
            ],
            "order": [
                [1, 'asc']
            ], // Sort by Admission Number
            "columnDefs": [{
                "targets": 0,
                "render": function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // Add row numbering
                }
            }]
        });
    });
</script>

<?php echo $this->endSection(); ?>